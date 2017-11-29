<?

	namespace Telegram\Method;

	abstract class SendMethod extends BaseMethod {

		/**
		 * @var int
		 */
		protected $chatId;

		/**
		 * @var string
		 */
		protected $text;

		/**
		 * @var mixed|null
		 */
		protected $replyMarkUp = null;

		/**
		 * @var string
		 */
		protected $parseMode;

		/**
		 * @var boolean
		 */
		protected $disableWebPagePreview = false;

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
		 * @param mixed $data
		 * @return $this
		 */
		public function setReplyMarkup($data) {
			$this->replyMarkUp = $data;
			return $this;
		}

		/**
		 * @return mixed
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

	}