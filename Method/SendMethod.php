<?

	namespace Telegram\Method;

	use Telegram\IKeyboard;

	abstract class SendMethod extends BaseMethod {

		/** @var int */
		protected $chatId;

		/** @var string */
		protected $text;

		/** @var IKeyboard|null */
		protected $replyMarkUp = null;

		/** @var string */
		protected $parseMode;

		/** @var boolean */
		protected $disableWebPagePreview = false;

		/** @var boolean */
		protected $disableNotification = false;

		/** @var int */
		protected $replyToMessageId = 0;

		/**
		 * SendMethod constructor.
		 * @param int $chatId
		 * @param string|null $text
		 */
		public function __construct($chatId, $text = null) {
			$this->setChatId($chatId);
			$this->setText($text);
		}

		/**
		 * @param int $chatId
		 * @return $this
		 */
		public function setChatId($chatId) {
			$this->chatId = $chatId;
			return $this;
		}

		/**
		 * @return int
		 */
		public function getChatId() {
			return $this->chatId;
		}

		/**
		 * @param string $mode
		 * @return $this
		 */
		public function setParseMode($mode) {
			$this->parseMode = $mode;
			return $this;
		}

		/**
		 * @return string
		 */
		public function getParseMode() {
			return $this->parseMode;
		}

		/**
		 * @param string $text
		 * @return $this
		 */
		public function setText($text) {
			$this->text = $text;
			return $this;
		}

		/**
		 * @return string
		 */
		public function getText() {
			return $this->text;
		}

		/**
		 * @param IKeyboard $data
		 * @return $this
		 */
		public function setReplyMarkup($data) {
			$this->replyMarkUp = $data;
			return $this;
		}

		/**
		 * @return IKeyboard
		 */
		public function getReplyMarkup() {
			return $this->replyMarkUp;
		}

		/**
		 * @param boolean $preview
		 * @return $this
		 */
		public function setDisableWebPagePreview($preview) {
			$this->disableWebPagePreview = $preview;
			return $this;
		}

		/**
		 * @return boolean
		 */
		public function getDisableWebPagePreview() {
			return $this->disableWebPagePreview;
		}

		/**
		 * @param boolean $disableNotification
		 * @return SendMethod
		 */
		public function setDisableNotification($disableNotification) {
			$this->disableNotification = $disableNotification;
			return $this;
		}

		/**
		 * @return boolean
		 */
		public function getDisableNotification() {
			return $this->disableNotification;
		}

		/**
		 * @param int $replyToMessageId
		 * @return SendMethod
		 */
		public function setReplyToMessageId($replyToMessageId) {
			$this->replyToMessageId = $replyToMessageId;
			return $this;
		}

		/**
		 * @return int
		 */
		public function getReplyToMessageId() {
			return $this->replyToMessageId;
		}

		/**
		 * @return array
		 */
		public function getParams() {
			$res = [
				"chat_id" => $this->chatId,
				$this instanceof SendMessage ? "text" : "caption" => $this->text
			];
			if ($this->replyMarkUp) {
				$res["reply_markup"] = $this->replyMarkUp;
			}
			if ($this->parseMode) {
				$res["parse_mode"] = $this->parseMode;
			}
			if ($this->disableWebPagePreview) {
				$res["disable_web_page_preview"] = $this->disableWebPagePreview;
			}
			if ($this->disableNotification) {
				$res["disable_notification"] = $this->disableNotification;
			}
			if ($this->replyToMessageId) {
				$res["reply_to_message_id"] = $this->replyToMessageId;
			}
			return $res;
		}

	}