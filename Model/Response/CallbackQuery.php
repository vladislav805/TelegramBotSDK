<?

	namespace Telegram\Model\Response;

	use Telegram\Model\Chat;
	use Telegram\Model\Object\Message;

	class CallbackQuery {

		/** @var string */
		private $queryId;

		/** @var string */
		private $data;

		/** @var string */
		private $chatInstance;

		/** @var Chat */
		private $from;

		/** @var Message */
		private $message;

		/**
		 * CallbackQuery constructor.
		 * @param $q
		 * @internal param $callback_query
		 */
		public function __construct($q) {
			$this->queryId = $q->id;
			$this->data = $q->data;
			$this->chatInstance = $q->chat_instance;
			$this->from = Chat::parse($q->from);
			$this->message = new Message($q->message);
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
		public function getData() {
			return $this->data;
		}

		/**
		 * @return Chat
		 */
		public function getFrom() {
			return $this->from;
		}

		/**
		 * @return Message
		 */
		public function getMessage() {
			return $this->message;
		}

		/**
		 * @return string
		 */
		public function getChatInstance() {
			return $this->chatInstance;
		}

		/**
		 * @return string
		 */
		public function getQueryId() {
			return $this->queryId;
		}

	}