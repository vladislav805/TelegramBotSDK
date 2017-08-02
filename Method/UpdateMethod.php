<?

	namespace Telegram\Method;

	abstract class UpdateMethod extends SendMethod {

		protected $messageId;

		/**
		 * UpdateMethod constructor.
		 * @param int $chatId
		 * @param int $messageId
		 * @param string|null $text
		 */
		public function __construct($chatId, $messageId, $text = null) {
			parent::__construct($chatId, $text);
			$this->setMessageId($messageId);
		}

		/**
		 * @param int $messageId
		 * @return $this
		 */
		public function setMessageId($messageId) {
			$this->messageId = $messageId;
			return $this;
		}

		/**
		 * @return int
		 */
		public function getMessageId() {
			return $this->messageId;
		}

	}