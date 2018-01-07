<?

	namespace Telegram\Method;

	class SendPhoto extends SendMethod {

		protected $photo;

		public function __construct($chatId, $photo = null, $text = "") {
			parent::__construct($chatId, $text);
			$this->setPhoto($photo);
		}

		public function getMethod() {
			return "sendPhoto";
		}

		public function setPhoto($photo) {
			$this->photo = $photo;
			return $this->photo;
		}

		public function getParams() {
			$res = parent::getParams();
			$res["photo"] = $this->photo;
			return $res;
		}

	}