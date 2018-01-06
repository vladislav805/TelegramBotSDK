<?

	namespace Telegram;

	use JsonSerializable;

	interface IKeyboardRow extends JsonSerializable {

		/**
		 * @param IKeyboardButton $key
		 * @return IKeyboardRow
		 */
		public function addButton($key);

		/**
		 * @param IKeyboardButton|int $key
		 * @return IKeyboardRow
		 */
		public function removeKey($key);

		/**
		 * @return int
		 */
		public function getCountButtons();

	}