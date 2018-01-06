<?

	namespace Telegram\Model\Object;

	use JsonSerializable;
	use Telegram\Model\Chat;

	class Message implements JsonSerializable {

		/** @var int */
		protected $id;

		/** @var Chat */
		protected $from;

		/** @var Chat */
		protected $chat;

		/** @var int */
		protected $date;

		/** @var string */
		protected $text;

		/** @var PhotoSize[] */
		protected $photo;

		/** @var Document */
		protected $document;

		/** @var Voice */
		protected $voice;

		/** @var MessageEntity[] */
		protected $entities;

		/** @var Sticker */
		protected $sticker;

		/** @var Message */
		protected $replyToMessage;

		/** @var Chat */
		protected $forwardFrom = null;

		/** @var int */
		protected $forwardFromMessageId;

		/** @var int */
		protected $forwardDate;

		/** @var Chat */
		protected $newChatMember;

		/** @var Chat */
		protected $leftChatMember;

		public function __construct($d) {
			$this->id = $d->message_id;
			$this->from = Chat::parse($d->from);
			$this->chat = Chat::parse($d->chat);
			$this->date = $d->date;

			isset($d->text) && ($this->text = $d->text);
			isset($d->caption) && ($this->text = $d->caption);

			isset($d->photo) && ($this->photo = array_map(function($p) { return new PhotoSize($p); }, $d->photo));
			isset($d->document) && ($this->document = new Document($d->document));
			isset($d->sticker) && ($this->sticker = new Sticker($d->sticker));

			if (isset($d->forward_from_chat))  {
				$this->forwardFrom = Chat::parse($d->forward_from_chat);
				$this->forwardDate = $d->forward_date;
			}

			$this->entities = isset($d->entities)
				? array_map(function($e) {
					return new MessageEntity($e, $this);
				  }, $d->entities)
				: [];

			isset($d->reply_to_message) && ($this->replyToMessage = new Message($d->reply_to_message));

			isset($d->new_chat_member) && ($this->newChatMember = Chat::parse($d->new_chat_member));
			isset($d->left_chat_member) && ($this->leftChatMember = Chat::parse($d->left_chat_member));
		}

		/**
		 * @return Chat
		 */
		public function getForwardFrom() {
			return $this->forwardFrom;
		}

		/**
		 * @return int
		 */
		public function getId() {
			return $this->id;
		}

		/**
		 * @return int
		 */
		public function getChatId() {
			return $this->chat->getId();
		}

		/**
		 * @return Chat
		 */
		public function getFrom() {
			return $this->from;
		}

		/**
		 * @return Chat
		 */
		public function getChat() {
			return $this->chat;
		}

		/**
		 * @return string
		 */
		public function getText() {
			return $this->text;
		}

		/**
		 * @return Sticker|null
		 */
		public function getSticker() {
			return $this->sticker;
		}

		/**
		 * @return int
		 */
		public function getDate() {
			return $this->date;
		}

		/**
		 * @return int
		 */
		public function hasText() {
			return mb_strlen($this->text);
		}

		/**
		 * @return boolean
		 */
		public function isCommand() {
			return sizeOf($this->entities) &&
				$this->entities[0]->getOffset() === 0 &&
				$this->entities[0]->getType() === MessageEntity::TYPE_BOT_COMMAND;
		}

		/**
		 * @param int $index
		 * @return MessageEntity|null
		 */
		public function getTextEntity($index) {
			if ($index < 0 || sizeOf($this->entities) <= $index) {
				return null;
			}

			return $this->entities[$index];
		}

		/**
		 * @return int
		 */
		public function getForwardDate() {
			return $this->forwardDate;
		}

		/**
		 * @return int
		 */
		public function getForwardFromMessageId() {
			return $this->forwardFromMessageId;
		}

		/**
		 * @return Chat
		 */
		public function getLeftChatMember() {
			return $this->leftChatMember;
		}

		/**
		 * @return Chat
		 */
		public function getNewChatMember() {
			return $this->newChatMember;
		}

		/**
		 * @return PhotoSize[]
		 */
		public function getPhoto() {
			return $this->photo;
		}

		/**
		 * @return Document
		 */
		public function getDocument() {
			return $this->document;
		}

		/**
		 * @return Voice
		 */
		public function getVoice() {
			return $this->voice;
		}

		/**
		 * @return boolean
		 */
		public function isForwarded() {
			return $this->forwardFrom != null;
		}

		/**
		 * @return Message
		 */
		public function getReplyToMessage() {
			return $this->replyToMessage;
		}

		/**
		 * @return array
		 */
		public function jsonSerialize() {
			return get_object_vars($this);
		}
	}