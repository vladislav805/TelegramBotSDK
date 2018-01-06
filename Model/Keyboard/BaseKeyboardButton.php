<?

	namespace Telegram\Model\Keyboard;

	use Telegram\IKeyboardButton;

	abstract class BaseKeyboardButton implements IKeyboardButton {

		/** @var string */
		protected $text;

		public function __construct($text) {
			$this->setText($text);
		}

		/**
		 * @param string $text
		 * @return IKeyboardButton
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
	}