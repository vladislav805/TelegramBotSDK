<?

	namespace Telegram\Model\Object;

	use JsonSerializable;

	class UserProfilePhotos implements JsonSerializable {

		/** @var int */
		protected $totalCount;

		/** @var PhotoSize[][] */
		protected $photos;

		public function __construct($d) {
			$this->totalCount = $d->total_count;
			$this->photos = array_map(function($photo) {
				$p = array_map(function($size) {
					return new PhotoSize($size);
				}, $photo);
				usort($p, function(PhotoSize $a, PhotoSize $b) {
					return ($a->getWidth() > $b->getWidth()) ? -1 : 1;
				});
				return $p;
			}, $d->photos);


		}

		/**
		 * @return int
		 */
		public function getTotalCount() {
			return $this->totalCount;
		}

		/**
		 * @param int $index
		 * @param int $size 0-5
		 * @return PhotoSize
		 */
		public function getPhoto($index, $size = 0) {
			return isset($this->photos[$index][$size]) ? $this->photos[$index][$size] : null;
		}

		public function jsonSerialize() {
			return get_object_vars($this);
		}
	}