<?

	namespace Telegram;

	use JsonSerializable;

	interface IKeyboard extends JsonSerializable {

		/**
		 * @return int
		 */
		public function getCountButtons();

		/**
		 * @return int
		 */
		public function getCountRows();

		/**
		 * @param IKeyboardRow|null $row
		 * @return IKeyboardRow
		 */
		public function addRow($row = null);

		/**
		 * @param int $index
		 * @return IKeyboardRow|null
		 */
		public function getRow($index);

		/**
		 * @param IKeyboardRow|int $row
		 * @return IKeyboard
		 */
		public function removeRow($row);

	}