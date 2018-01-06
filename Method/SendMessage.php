<?

	namespace Telegram\Method;

	use Telegram\IMethodParsable;
	use Telegram\Model\Object\Message;

	class SendMessage extends SendMethod implements IMethodParsable {

		public function __construct($chatId, $text = null) {
			parent::__construct($chatId, $text);
		}

		public function getMethod() {
			return "sendMessage";
		}

		public function getText() {
			return $this->text;
		}

		public function getParams() {
			$res = [ "chat_id" => $this->chatId, "text" => $this->text ];
			if ($this->replyMarkUp) {
				$res["reply_markup"] = $this->replyMarkUp;
			}
			if ($this->parseMode) {
				$res["parse_mode"] = $this->parseMode;
			}
			if ($this->disableWebPagePreview) {
				$res["disable_web_page_preview"]= $this->disableWebPagePreview;
			}
			return $res;
		}

		/**
		 * Parse response from API to objects
		 * @param object $result
		 * @return Message
		 */
		public function parseResponse($result) {
			return new Message($result->result);
		}
	}