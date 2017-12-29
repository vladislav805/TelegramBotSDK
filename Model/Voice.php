<?

	namespace Telegram\Model;

	use JsonSerializable;
	use Telegram\IFile;

	class Voice implements IFile, JsonSerializable {

		/** @var string */
		protected $fileId;

		/** @var int */
		protected $duration;

		/** @var string */
		protected $mime;

		/** @var int */
		protected $size;

		/**
		 * Voice constructor.
		 * @param $d
		 */
		public function __construct($d) {
			$this->fileId = $d->file_id;
			$this->duration = $d->duration;
			$this->mime = $d->mime_type;
			$this->size = $d->file_size;
		}

		/**
		 * @return string
		 */
		public function getFileId() {
			return $this->fileId;
		}

		/**
		 * @return int
		 */
		public function getDuration() {
			return $this->duration;
		}

		/**
		 * @return int
		 */
		public function getSize() {
			return $this->size;
		}

		/**
		 * @return string
		 */
		public function getMime() {
			return $this->mime;
		}

		/**
		 * @return array
		 */
		public function jsonSerialize() {
			return get_object_vars($this);
		}

		/**
		 * @return int
		 */
		public function getFileSize() {
			return $this->size;
		}
	}