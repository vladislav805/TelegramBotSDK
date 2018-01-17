<?

	namespace Telegram\Model\Object;

	class FullDocument extends Document {

		/** @var string */
		protected $path;

		public function __construct($d) {
			parent::__construct($d);
			isset($d->file_path) && ($this->path = $d->file_path);
		}

		/**
		 * @return string
		 */
		public function getPath() {
			return $this->path;
		}

	}