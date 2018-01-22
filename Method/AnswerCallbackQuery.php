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
		public function __construct($queryId, $text) {
			$this->queryId = $queryId;
			$this->text = $text;
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
		 * @param string $text
		 * @return AnswerCallbackQuery
		 */
		public function setText($text) {
			$this->text = $text;
			return $this;
		}

		/**
		 * @param boolean $showAlert
		 * @return AnswerCallbackQuery
		 */
		public function setShowAlert($showAlert) {
			$this->showAlert = $showAlert;
			return $this;
		}

		/**
		 * @param string $url
		 * @return AnswerCallbackQuery
		 */
		public function setUrl($url) {
			$this->url = $url;
			return $this;
		}

		/**
		 * @param int $cacheTime
		 * @return AnswerCallbackQuery
		 */
		public function setCacheTime($cacheTime) {
			$this->cacheTime = $cacheTime;
			return $this;
		}

		/**
		 * @return array
		 */
		public function getParams() {
			$res = [
				"callback_query_id" => $this->queryId,
				"show_alert" => $this->showAlert,
				"cache_time" => $this->cacheTime,
				"text" => $this->text
			];

			if ($this->url) {
				$res["url"] = $this->url;
			}
			return $res;
		}

	}