<?

	namespace Telegram\Model\Keyboard;

	class ReplyKeyboard extends BaseKeyboard {

		/** @var boolean */
		protected $needResize = false;

		/** @var boolean */
		protected $oneTime = false;

		/** @var boolean */
		protected $selective = false;

		/**
		 * @param boolean $needResize
		 * @return ReplyKeyboard
		 */
		public function setNeedResize($needResize) {
			$this->needResize = $needResize;
			return $this;
		}

		/**
		 * @param boolean $oneTime
		 * @return ReplyKeyboard
		 */
		public function setOneTime($oneTime) {
			$this->oneTime = $oneTime;
			return $this;
		}

		/**
		 * @param boolean $selective
		 * @return ReplyKeyboard
		 */
		public function setSelective($selective) {
			$this->selective = $selective;
			return $this;
		}

		/**
		 * @return array
		 */
		public function jsonSerialize() {
			return sizeOf($this->rows)
				? [
					"keyboard" => $this->rows,
					"resize_keyboard" => $this->needResize,
					"one_time_keyboard" => $this->oneTime,
					"selective" => $this->selective
				]
				: [
					"remove_keyboard" => true,
					"selective" => $this->selective
				];
		}
	}