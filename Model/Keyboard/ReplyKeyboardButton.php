<?

	namespace Telegram\Model\Keyboard;

	class ReplyKeyboardButton extends BaseKeyboardButton {

		/** @var boolean */
		protected $requestContact = false;

		/** @var boolean */
		protected $requestLocation = false;

		/**
		 * @return array
		 */
		public function jsonSerialize() {
			$d = ["text" => $this->text];

			if ($this->requestContact) {
				$d["request_contact"] = $this->requestContact;
			}

			if ($this->requestLocation) {
				$d["request_location"] = $this->requestLocation;
			}

			return $d;
		}
	}