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
			$res = [ "chat_id" => $this->chatId, "sticker" => $this->sticker ];
			if ($this->replyMarkUp) {
				$res["reply_markup"] = $this->replyMarkUp;
			}
			return $res;
		}

	}