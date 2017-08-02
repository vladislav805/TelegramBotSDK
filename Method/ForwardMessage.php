<?

	namespace Telegram\Method;

	class ForwardMessage extends SendMethod {

		private $messageId;
		private $fromChatId;

		public function __construct($targetChatId, $messageId, $fromChatId) {
			parent::__construct($targetChatId, null);
			$this->messageId = $messageId;
			$this->fromChatId = $fromChatId;
		}

		public function getMethod() {
			return "forwardMessage";
		}


		public function getParams() {
			$res = [ "chat_id" => $this->chatId, "message_id" => $this->messageId, "from_chat_id" => $this->fromChatId ];
			return $res;
		}

	}