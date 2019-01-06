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
			isset($d->thumb) && ($this->thumbnail = $d->thumb);
			isset($d->emoji) && ($this->emoji = $d->emoji);
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