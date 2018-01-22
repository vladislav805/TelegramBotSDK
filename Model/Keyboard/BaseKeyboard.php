<?

	namespace Telegram\Model\Keyboard;

	use InvalidArgumentException;
	use Telegram\IKeyboard;
	use Telegram\IKeyboardButton;
	use Telegram\IKeyboardRow;

	abstract class BaseKeyboard implements IKeyboard {

		/** @var IKeyboardRow[] */
		protected $rows = [];

		/**
		 * @return int
		 */
		public function getCountButtons() {
			return array_reduce($this->rows, function($row) {
				/** @var IKeyboardRow $row */
				return $row->getCountButtons();
			}, 0);
		}

		/**
		 * @return int
		 */
		public function getCountRows() {
			return sizeOf($this->rows);
		}

		/**
		 * @param IKeyboardRow|null $row
		 * @return IKeyboardRow
		 */
		public function addRow($row = null) {
			if (!($row instanceof KeyboardRow)) {
				$row = new KeyboardRow;
			}
			$this->rows[] = $row;
			return $row;
		}

		/**
		 * @param int $index
		 * @return IKeyboardRow|null
		 */
		public function getRow($index) {
			return $this->isValidRowId($index)
				? $this->rows[$index]
				: null;
		}

		/**
		 * @param IKeyboardRow|int $row
		 * @return IKeyboard
		 */
		public function removeRow($row) {
			if ($row instanceof IKeyboardRow) {
				$row = $this->findRowByInstance($row);
			}

			array_splice($this->rows, $row, 1);

			return $this;
		}

		/**
		 * @param int $index
		 * @return boolean
		 */
		protected function isValidRowId($index) {
			return $index >= 0 && $index < $this->getCountRows();
		}

		/**
		 * @param IKeyboardRow $target
		 * @return int|false
		 */
		protected function findRowByInstance($target) {
			foreach ($this->rows as $index => $row) {
				if ($target === $row) {
					return $index;
				}
			}

			return false;
		}

		/**
		 * Chunk and insert vector of buttons in keyboard in 'nice' and 'right' counts of rows/columns
		 * @param IKeyboard $keyboard
		 * @param IKeyboardButton[] $buttons
		 * @param int|boolean $count
		 * @return IKeyboard
		 */
		static function chunkVectorButtonsByRows($keyboard, $buttons, $count = false) {
			$s = sizeOf($buttons);

			if ($s > 50) {
				throw new InvalidArgumentException("Too many buttons. Max count 50 buttons per menu.");
			}

			if ($s <= 0) {
				return $keyboard;
			}

			if ($count === false) {
				$count = !($s % 4)
					? 4
					: (
						!($s % 3)
							? 3
							: 5
					  );
			}

			$buttons = array_chunk($buttons, $count);

			foreach ($buttons as $row) {
				$r = $keyboard->addRow();
				foreach ($row as $button) {
					$r->addButton($button);
				}
			}

			return $keyboard;
		}

	}