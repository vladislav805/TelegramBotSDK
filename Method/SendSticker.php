<?

	namespace Telegram\Method;

	class SendSticker extends SendMethod {

		private $sticker;

		public function __construct($chatId, $sticker) {
			parent::__construct($chatId, null);
			$this->sticker = $sticker;
		}

		public function getMethod() {
			return "sendSticker";
		}

		public function getParams() {
			$res = parent::getParams();
			$res["sticker"] = $this->sticker;
			return $res;
		}

	}