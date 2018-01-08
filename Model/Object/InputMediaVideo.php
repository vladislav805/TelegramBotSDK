<?

	namespace Telegram\Model\Object;

	class InputMediaVideo extends InputMedia {

		/** @var int */
		protected $width;

		/** @var int */
		protected $height;

		/** @var int */
		protected $duration;

		public function __construct($media, $caption = "") {
			parent::__construct($media, $caption);
		}

		/**
		 * @param int $width
		 * @return InputMediaVideo
		 */
		public function setWidth($width) {
			$this->width = $width;
			return $this;
		}

		/**
		 * @param int $height
		 * @return InputMediaVideo
		 */
		public function setHeight($height) {
			$this->height = $height;
			return $this;
		}

		/**
		 * @param int $duration
		 * @return InputMediaVideo
		 */
		public function setDuration($duration) {
			$this->duration = $duration;
			return $this;
		}

		/**
		 * @return string
		 */
		public function getType() {
			return "video";
		}

		/**
		 * @return array
		 */
		public function jsonSerialize() {
			$r = parent::jsonSerialize();

			if ($this->width) {
				$r["width"] = $this->width;
			}

			if ($this->height) {
				$r["height"] = $this->height;
			}

			if ($this->duration) {
				$r["duration"] = $this->duration;
			}

			return $r;
		}

	}