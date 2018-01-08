<?

	namespace Telegram\Model\Object;

	use JsonSerializable;

	abstract class InputMedia implements JsonSerializable {

		/** @var string */
		protected $type;

		/** @var string */
		protected $media;

		/** @var string */
		protected $caption = "";

		/**
		 * InputMedia constructor.
		 * @param string $media
		 * @param string $caption
		 */
		public function __construct($media, $caption = "") {
			$this->media = $media;
			$this->caption = $caption;
		}

		/**
		 * @param string $media
		 * @return InputMedia
		 */
		public function setMedia($media) {
			$this->media = $media;
			return $this;
		}

		/**
		 * @param string $caption
		 * @return InputMedia
		 */
		public function setCaption($caption) {
			$this->caption = $caption;
			return $this;
		}

		/**
		 * @return string
		 */
		public function getMedia() {
			return $this->media;
		}

		/**
		 * @return string
		 */
		public function getCaption() {
			return $this->caption;
		}

		/**
		 * @return string
		 */
		abstract function getType();

		/**
		 * @return array
		 */
		public function jsonSerialize() {
			return [
				"type" => $this->getType(),
				"media" => $this->media,
				"caption" => $this->caption
			];
		}

	}