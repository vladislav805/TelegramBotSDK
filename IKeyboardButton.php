<?

	namespace Telegram;

	use JsonSerializable;

	interface IKeyboardButton extends JsonSerializable {

		/**
		 * @param string $text
		 * @return IKeyboardButton
		 */
		public function setText($text);

		/**
		 * @return string
		 */
		public function getText();

	}