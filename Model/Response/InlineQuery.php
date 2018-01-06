<?

	namespace Telegram\Model\Response;

	use Telegram\Model\Chat;

	class InlineQuery {

		/** @var string */
		private $queryId;

		/** @var string */
		private $query;

		/** @var Chat */
		private $from;

		/** @var string */
		private $offset;

		/**
		 * CallbackQuery constructor.
		 * @param $q
		 * @internal param $callback_query
		 */
		public function __construct($q) {
			$this->queryId = $q->id;
			$this->query = $q->query;
			$this->from = Chat::parse($q->from);
			$this->offset = $q->offset;
		}

		/**
		 * @return int
		 */
		public function getId() {
			return $this->queryId;
		}

		/**
		 * @return string
		 */
		public function getQuery() {
			return $this->query;
		}

		/**
		 * @return Chat
		 */
		public function getFrom() {
			return $this->from;
		}

		/**
		 * @return string
		 */
		public function getQueryId() {
			return $this->queryId;
		}

	}