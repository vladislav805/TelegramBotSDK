<?

	namespace Telegram\Method;

	class SendMessage extends SendMethod {

		public function __construct($chatId, $text = null) {
			parent::__construct($chatId, $text);
		}

		public function getMethod() {
			return "sendMessage";
		}

		public function getText() {
			return $this->text;
		}

		public function getParams() {
			$res = [ "chat_id" => $this->chatId, "text" => $this->text ];
			if ($this->replyMarkUp) {
				$res["reply_markup"] = $this->replyMarkUp;
			}
			if ($this->parseMode) {
				$res["parse_mode"] = $this->parseMode;
			}
			if ($this->disableWebPagePreview) {
				$res["disable_web_page_preview"]= $this->disableWebPagePreview;
			}
			return $res;
		}

	}