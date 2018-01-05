<?
	namespace Telegram\Method;

	class AnswerCallbackQuery extends BaseMethod {

		/** @var string */
		private $queryId;

		/** @var string */
		private $text;

		/** @var boolean */
		private $showAlert = false;

		/** @var string */
		private $url;

		/** @var int */
		private $cacheTime = 0;

		/**
		 * AnswerCallbackQuery constructor.
		 * @param string $queryId
		 */
		public function __construct($queryId) {
			$this->queryId = $queryId;
		}

		/**
		 * @return string
		 */
		public function getMethod() {
			return "answerCallbackQuery";
		}

		/**
		 * @return string
		 */
		public function getQueryId() {
			return $this->queryId;
		}

		/**
		 * @return int
		 */
		public function getCacheTime() {
			return $this->cacheTime;
		}

		/**
		 * @return string
		 */
		public function getUrl() {
			return $this->url;
		}

		/**
		 * @return string
		 */
		public function getText() {
			return $this->text;
		}

		/**
		 * @return array
		 */
		public function getParams() {
			$res = [ "query_callback_id" => $this->queryId, "show_alert" => $this->showAlert, "cache_time" => $this->cacheTime ];
			if ($this->text) {
				$res["text"] = $this->text;
			}
			if ($this->url) {
				$res["url"] = $this->url;
			}
			return $res;
		}

	}