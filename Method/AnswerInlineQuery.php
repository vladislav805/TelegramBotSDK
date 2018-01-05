<?

	namespace Telegram\Method;

	class AnswerInlineQuery extends BaseMethod {

		/** @var string */
		private $queryId;

		/** @var array[] */
		private $results = [];

		/** @var int */
		private $cacheTime = 0;

		/** @var boolean */
		private $isPersonal = false;

		/** @var boolean */
		private $nextOffset = null;

		/**
		 * AnswerInlineQuery constructor.
		 * @param string $queryId
		 * @param array[] $results
		 */
		public function __construct($queryId, $results = []) {
			$this->queryId = $queryId;
			$this->results = $results;
		}

		/**
		 * @return string
		 */
		public function getMethod() {
			return "answerInlineQuery";
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
		 * @param array[] $results
		 */
		public function setResults($results) {
			$this->results = $results;
		}

		/**
		 * @param int $cacheTime
		 */
		public function setCacheTime($cacheTime) {
			$this->cacheTime = $cacheTime;
		}

		/**
		 * @param boolean $isPersonal
		 */
		public function setIsPersonal($isPersonal) {
			$this->isPersonal = $isPersonal;
		}

		/**
		 * @param boolean $nextOffset
		 */
		public function setNextOffset($nextOffset) {
			$this->nextOffset = $nextOffset;
		}

		/**
		 * @return array
		 */
		public function getParams() {
			$res = [
				"results" => $this->results,
				"inline_query_id" => $this->queryId,
				"cache_time" => $this->cacheTime,
				"is_personal" => $this->isPersonal
			];

			if ($this->nextOffset) {
				$res["next_offset"] = $this->nextOffset;
			}

			return $res;
		}

	}