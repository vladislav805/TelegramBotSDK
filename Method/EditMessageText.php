<?

	namespace Telegram\Method;

	class EditMessageText extends UpdateMethod {

		public function __construct($chatId, $messageId, $text = null) {
			parent::__construct($chatId, $messageId, $text);
		}

		public function getMethod() {
			return "editMessageText";
		}

		public function getText() {
			return $this->text;
		}

		public function getParams() {
			$res = [ "chat_id" => $this->chatId, "message_id" => $this->messageId, "text" => $this->text ];
			if ($this->replyMarkUp) {
				$res["reply_markup"] = $this->replyMarkUp;
			}
			if ($this->parseMode) {
				$res["parse_mode"] = $this->parseMode;
			}
			return $res;
		}

	}