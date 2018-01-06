<?

	namespace Telegram\Model\Keyboard;

	use Telegram\IKeyboardButton;
	use Telegram\IKeyboardRow;

	class KeyboardRow implements IKeyboardRow {

		/** @var IKeyboardButton[] */
		protected $buttons = [];

		/**
		 * @param IKeyboardButton $key
		 * @return IKeyboardRow
		 */
		public function addButton($key) {
			$this->buttons[] = $key;
			return $this;
		}

		/**
		 * @param IKeyboardButton|int $key
		 * @return IKeyboardRow
		 */
		public function removeKey($key) {
			if ($key instanceof IKeyboardButton) {
				$key = $this->findKeyByInstance($key);
			}
			array_splice($this->buttons, $key, 1);

			return $this;
		}

		/**
		 * @return int
		 */
		public function getCountButtons() {
			return sizeOf($this->buttons);
		}

		/**
		 * @return IKeyboardButton[]
		 */
		public function jsonSerialize() {
			return $this->buttons;
		}

		/**
		 * @param IKeyboardButton $key
		 * @return int|false
		 */
		protected function findKeyByInstance($key) {
			foreach ($this->buttons as $index => $k) {
				if ($key === $k) {
					return $index;
				}
			}
			return false;
		}
	}