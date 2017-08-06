<?

	namespace Telegram\Model;

	class Document {

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

		public function __construct($d) {
			$this->fileId = $d->file_id;
			$this->thumbnail = $d->thumb;
			$this->name = $d->file_name;
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

	}