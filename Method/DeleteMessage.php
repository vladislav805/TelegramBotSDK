<?
	namespace Telegram\Method;

	class DeleteMessage extends BaseMethod {

		private $chatId;
		private $messageId;

		public function __construct($chatId, $messageId) {
			$this->chatId = $chatId;
			$this->messageId = $messageId;
		}

		public function getMethod() {
			return "deleteMessage";
		}

		public function getParams() {
			return [ "chat_id" => $this->chatId, "message_id" => $this->messageId ];
		}

	}