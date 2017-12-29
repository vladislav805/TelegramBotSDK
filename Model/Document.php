<?

	namespace Telegram\Model;

	use JsonSerializable;
	use Telegram\IFile;

	class Document implements IFile, JsonSerializable {

		/** @var string */
		protected $fileId;

		/** @var PhotoSize */
		protected $thumbnail;

		/** @var string */
		protected $name;

		/** @var string */
		protected $mime;

		/** @var int */
		protected $size;

		/** @var string */
		protected $path;

		public function __construct($d) {
			$this->fileId = $d->file_id;
			$this->thumbnail = $d->thumb;
			$this->name = $d->file_name;
			$this->mime = $d->mime_type;
			$this->size = $d->file_size;
			isset($d->file_path) && ($this->path = $d->file_path);
		}

		/**
		 * @return string
		 */
		public function getFileId() {
			return $this->fileId;
		}

		/**
		 * @return string
		 */
		public function getName() {
			return $this->name;
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
		 * @return PhotoSize
		 */
		public function getThumbnail() {
			return $this->thumbnail;
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

		/**
		 * @return string
		 */
		public function getPath() {
			return $this->path;
		}

	}