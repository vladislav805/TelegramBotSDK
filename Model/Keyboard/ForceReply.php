<?

	namespace Telegram\Model\Keyboard;

	use BadFunctionCallException;
	use Telegram\IKeyboard;
	use Telegram\IKeyboardRow;

	class ForceReply implements IKeyboard {

		/** @var boolean */
		protected $selective = false;

		/**
		 * @param boolean $selective
		 * @return ForceReply
		 */
		public function setSelective($selective) {
			$this->selective = $selective;
			return $this;
		}

		/**
		 * @return boolean
		 */
		public function getSelective() {
			return $this->selective;
		}

		/**
		 * @return void
		 */
		public function getCountButtons() {
			throw new BadFunctionCallException("Not supported");
		}

		/**
		 * @return void
		 */
		public function getCountRows() {
			throw new BadFunctionCallException("Not supported");
		}

		/**
		 * @param IKeyboardRow|null $row
		 * @return void
		 */
		public function addRow($row = null) {
			throw new BadFunctionCallException("Not supported");
		}

		/**
		 * @param int $index
		 * @return void
		 */
		public function getRow($index) {
			throw new BadFunctionCallException("Not supported");
		}

		/**
		 * @param IKeyboardRow|int $row
		 * @return void
		 */
		public function removeRow($row) {
			throw new BadFunctionCallException("Not supported");
		}

		/**
		 * @return array
		 */
		public function jsonSerialize() {
			return [
				"force_reply" => true,
				"selective" => $this->selective
			];
		}
	}