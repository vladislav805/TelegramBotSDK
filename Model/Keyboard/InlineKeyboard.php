<?

	namespace Telegram\Model\Keyboard;

	class InlineKeyboard extends BaseKeyboard {

		/**
		 * @return array
		 */
		public function jsonSerialize() {
			return ["inline_keyboard" => $this->rows];
		}
	}