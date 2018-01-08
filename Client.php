<?
	namespace Telegram;

	use CURLFile;
	use ErrorException;
	use Exception;
	use RuntimeException;
	use stdClass;
	use Telegram\Method\BaseMethod;
	use Telegram\Model\Object\Message;
	use Telegram\Model\Response\CallbackQuery;
	use Telegram\Model\Response\InlineQuery;
	use Telegram\Utils\Logger;

	class Client {

		/** @var string */
		private $mBotSecret;

		/** @var string */
		private $mApiUrl;

		/**
		 * Data received from php://input
		 * @var mixed
		 */
		private $mData;

		/** @var Logger|null */
		private $mLogger = null;

		const BASE_URL = "https://api.telegram.org/bot%s/";

		/**
		 * Client constructor.
		 * @param $botSecret
		 */
		public function __construct($botSecret) {
			$this->mBotSecret = $botSecret;
			$this->mApiUrl = sprintf(self::BASE_URL, $this->mBotSecret);
		}

		/**
		 * Perform method as single HTTP-request
		 * @param BaseMethod $method
		 * @return stdClass
		 * @throws Exception
		 */
		public function performSingleMethod(BaseMethod $method) {
			$parameters = $method->getParams();

			if (!is_string($method->getMethod())) {
				throw new InvalidParamException("Method name must be a string");
			};

			if (!$parameters) {
				$parameters = [];
			} else if (!is_array($parameters) && !is_object($parameters)) {
				throw new InvalidParamException("Parameters must be an array");
			}

			$parameters["method"] = $method->getMethod();

			$handle = curl_init($this->mApiUrl);
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($handle, CURLOPT_TIMEOUT, 60);
			curl_setopt($handle, CURLOPT_POST, 1);
			if ($this->hasFile($parameters)) {
				curl_setopt($handle, CURLOPT_POSTFIELDS, $parameters);
			} else {
				curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
				curl_setopt($handle, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
			}

			$response = curl_exec($handle);

			$this->mLogger->log(Logger::LOG_MODE_API_RESULT, "API", [
				"Method" => $method->getMethod(),
				"Params" => http_build_query($parameters),
				"Response" => $response
			]);

			if ($response === false) {
				$errno = curl_errno($handle);
				$error = curl_error($handle);
				curl_close($handle);
				throw new RuntimeException("Curl returned error $errno: $error");
			}

			$httpCode = (int) curl_getinfo($handle, CURLINFO_HTTP_CODE);
			curl_close($handle);

			if ($httpCode >= 500) {
				throw new RuntimeException("Telegram API respond with " . $httpCode . " HTTP code");
			} elseif ($httpCode !== 200) {
				throw new RuntimeException("Telegram API respond with " . $httpCode . " HTTP code and reason: " . $response);
			};


			$response = json_decode($response);
			if (!$response->ok) {
				throw new ErrorException(json_encode($response));
			}

			return $method instanceof IMethodParsable
				? $method->parseResponse($response->result)
				: $response->result;
		}

		/**
		 * Perform method as webhook
		 * @param BaseMethod $method
		 * @return bool
		 */
		public function performHookMethod(BaseMethod $method) {
			$parameters = $method->getParams();
			if (!is_string($method->getMethod())) {
				throw new InvalidParamException("Method name must be a string");
			}

			if (!$parameters) {
				$parameters = [];
			} else if (!is_array($parameters)) {
				throw new InvalidParamException("Parameters must be an array");
			}

			if ($this->hasFile($parameters)) {
				throw new InvalidParamException("File can not be sent on webhook");
			}

			$parameters["method"] = $method->getMethod();

			header("Content-Type: application/json");
			echo json_encode($parameters);
			return true;
		}

		/**
		 * Checks if params contains file. Check for multipart/form-data enable.
		 * @param array $params
		 * @return boolean
		 */
		private function hasFile($params) {
			foreach ($params as $value) {
				if ($value && $value instanceof CURLFile) {
					return true;
				}
			}
			return false;
		}

		/**
		 * Read input stream
		 * @return boolean
		 * @throws Exception
		 */
		private function read() {
			if (!$this->mData) {
				$content = file_get_contents("php://input");

				$this->mLogger && $this->mLogger->log(Logger::LOG_MODE_INCLUDE_RAW, Logger::TYPE_RAW, ["json" => $content]);

				$update = json_decode($content);

				if (!$update) {
					throw new Exception("Can not get update");
				}

				$this->mData = $update;
			}

			return true;
		}

		/**
		 * Set listener for Message
		 * @param callable $callable
		 * @return bool
		 * @throws Exception
		 */
		public function onMessage($callable) {
			$this->read();

			if (isset($this->mData->message)) {
				$message = new Message($this->mData->message);
				$callable($this, $message);

				if ($this->mLogger) {
					$d = [
						"Chat" => "@" . $message->getChat()->getUsername() . " (#" . $message->getChat()->getId() . ")",
						"From" => "@" . $message->getFrom()->getUsername() . " (#" . $message->getFrom()->getId() . ")",
						"FN/LN" => $message->getFrom()->getFullName(),
						"Date" => date("d.m H:i:s", $message->getDate()),
						"Text" => $message->getText()
					];

					if ($d["Chat"] == $d["From"]) {
						unset($d["From"]);
					}

					$this->mLogger->log(Logger::LOG_MODE_MESSAGE, Logger::TYPE_MESSAGE, $d);
				}
			}

			return true;
		}

		/**
		 * Set listener for callback query
		 * @param callable $callable
		 * @return boolean
		 * @throws Exception
		 */
		public function onCallbackQuery($callable) {
			$this->read();

			if (isset($this->mData->callback_query)) {
				$query = new CallbackQuery($this->mData->callback_query);
				$callable($this, $query);
				$this->mLogger && $this->mLogger->log(Logger::LOG_MODE_CALLBACK_QUERY, Logger::TYPE_CALLBACK, [
					"From" => "@" . $query->getFrom()->getUsername(),
					"FN/LN" => $query->getFrom()->getFullName(),
					"Date" => date("d.m H:i:s"),
					"Data" => $query->getData()
				]);
			}

			return true;
		}

		/**
		 * Set listener for inline query
		 * @param callable $callable
		 * @return boolean
		 * @throws Exception
		 */
		public function onInlineQuery($callable) {
			$this->read();

			if (isset($this->mData->inline_query)) {
				$query = new InlineQuery($this->mData->inline_query);
				$callable($this, $query);
				$this->mLogger && $this->mLogger->log(Logger::LOG_MODE_CALLBACK_QUERY, Logger::TYPE_INLINE, [
					"From" => "@" . $query->getFrom()->getUsername(),
					"FN/LN" => $query->getFrom()->getFullName(),
					"Query" => $query->getQuery()
				]);
			}

			return true;
		}

		/**
		 * Set logger file
		 * @param Logger $logger
		 * @return $this
		 */
		public function setLogger($logger) {
			$this->mLogger = $logger;
			return $this;
		}


		/**
		 * Make link for download document
		 * @param IFile $document
		 * @return string
		 */
		public function getDocumentDownloadUrl($document) {
			return "https://api.telegram.org/file/bot" . $this->mBotSecret . "/" . $document->getPath();
		}

	}