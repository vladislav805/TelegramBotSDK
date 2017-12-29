<?

	namespace Telegram\Model;

	use JsonSerializable;
	use Telegram\IFile;

	class PhotoSize implements IFile, JsonSerializable {

		/** @var string */
		protected $fileId;

		/** @var int */
		protected $width;

		/** @var int */
		protected $height;

		/** @var int */
		protected $fileSize;

		/** @var string */
		protected $path;

		/**
		 * PhotoSize constructor.
		 * @param $d
		 */
		public function __construct($d) {
			$this->fileId = $d->file_id;
			$this->width = $d->width;
			$this->height = $d->height;
			$this->fileSize = $d->file_size;
			isset($d->file_path) && ($this->path = $d->file_path);
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
		public function getWidth() {
			return $this->width;
		}

		/**
		 * @return int
		 */
		public function getHeight() {
			return $this->height;
		}

		/**
		 * @return int
		 */
		public function getFileSize() {
			return $this->fileSize;
		}

		/**
		 * @return array
		 */
		public function jsonSerialize() {
			return get_object_vars($this);
		}

		/**
		 * @return string
		 */
		public function getPath() {
			return $this->path;
		}
	}