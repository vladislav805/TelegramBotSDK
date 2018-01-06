<?

	namespace Telegram\Model\Keyboard;

	use Telegram\IKeyboard;
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

	}