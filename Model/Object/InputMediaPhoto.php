<?

	namespace Telegram\Model\Object;

	class InputMediaPhoto extends InputMedia {

		public function __construct($media, $caption = "") {
			parent::__construct($media, $caption);
		}

		/**
		 * @return string
		 */
		public function getType() {
			return "photo";
		}

	}