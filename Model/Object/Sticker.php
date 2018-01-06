<?

	namespace Telegram\Model\Object;

	use Telegram\IFile;

	class Sticker extends PhotoSize implements IFile {

		/** @var PhotoSize */
		protected $thumbnail;

		/** @var string */
		protected $emoji;

		/**
		 * Sticker constructor.
		 * @param $d
		 */
		public function __construct($d) {
			parent::__construct($d);
			$this->thumbnail = $d->thumb;
			$this->emoji = $d->emoji;
		}

		/**
		 * @return string
		 */
		public function getEmoji() {
			return $this->emoji;
		}

		/**
		 * @return PhotoSize
		 */
		public function getThumbnail() {
			return $this->thumbnail;
		}

	}