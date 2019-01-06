<?

	namespace Telegram\Model\Object;

	use JsonSerializable;

	class Location implements JsonSerializable {

		/** @var double */
		protected $latitude;

		/** @var double */
		protected $longitude;

		public function __construct($l) {
			$this->latitude = $l->latitude;
			$this->longitude = $l->longitude;
		}

		/**
		 * @return double
		 */
		public function getLatitude() {
			return $this->latitude;
		}

		/**
		 * @return double
		 */
		public function getLongitude() {
			return $this->longitude;
		}

		/**
		 * @return array
		 */
		public function jsonSerialize() {
			return get_object_vars($this);
		}
	}