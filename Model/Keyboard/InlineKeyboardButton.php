<?

	namespace Telegram\Model\Keyboard;

	use Telegram\IKeyboard;

	class InlineKeyboardButton extends BaseKeyboardButton {

		/** @var string */
		protected $url = "";

		/** @var string */
		protected $callbackData = "";

		/**
		 * InlineKeyboardButton constructor.
		 * @param $text
		 * @param IKeyboard|null $data
		 */
		public function __construct($text, $data = null) {
			parent::__construct($text);
			$this->setCallback($data);
		}

		/**
		 * @param string $callback
		 * @return InlineKeyboardButton
		 */
		public function setCallback($callback) {
			$this->callbackData = $callback;
			return $this;
		}

		/**
		 * @param string $url
		 * @return InlineKeyboardButton
		 */
		public function setUrl($url) {
			$this->url = $url;
			return $this;
		}

		/**
		 * @return array
		 */
		public function jsonSerialize() {
			$d = ["text" => $this->text];

			if ($this->callbackData) {
				$d["callback_data"] = $this->callbackData;
			} /*elseif ($this->url) {
				$d["url"] = $this->url;
			}*/

			// TODO: fix it

			return $d;
		}
	}