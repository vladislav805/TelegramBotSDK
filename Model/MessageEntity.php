<?

	namespace Telegram\Model;

	class MessageEntity {

		const TYPE_BOT_COMMAND = "bot_command";
		const TYPE_MENTION = "mention";
		const TYPE_HASHTAG = "hashtag";
		const TYPE_URL = "url";
		const TYPE_EMAIL = "email";
		const TYPE_BOLD = "bold";
		const TYPE_ITALIC = "italic";
		const TYPE_CODE_INLINE = "code";
		const TYPE_CODE_BLOCK = "pre";
		const TYPE_TEXT_LINK = "text_link";
		const TYPE_TEXT_MENTION = "text_mention";

		/** @var string */
		private $type;

		/** @var int */
		private $offset;

		/** @var int */
		private $length;

		/** @var string|null */
		private $data;

		/**
		 * MessageEntity constructor.
		 * @param object $e
		 * @param Message $message
		 */
		public function __construct($e, $message) {
			$this->type = $e->type;
			$this->offset = $e->offset;
			$this->length = $e->length;

			switch ($this->type) {
				case "text_link":
					$this->data = $e->url;
					break;

				case "text_mention":
					$this->data = "@" . (new Chat($e->user))->getUsername();
					break;

				default:
					$this->data = mb_substr($message->getText(), $this->getOffset(), $this->getLength());
					break;
			}
		}

		/**
		 * @return string
		 */
		public function getType() {
			return $this->type;
		}

		/**
		 * @return int
		 */
		public function getOffset() {
			return $this->offset;
		}

		/**
		 * @return int
		 */
		public function getLength() {
			return $this->length;
		}

		/**
		 * @return null|string
		 */
		public function getData() {
			return $this->data;
		}

	}