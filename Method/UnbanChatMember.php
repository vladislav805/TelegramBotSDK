<?
	namespace Telegram\Method;

	use Telegram\IMethodParsable;
	use Telegram\Model\Object\FullDocument;

	class UnbanChatMember extends BaseMethod {

		private $chatId;

		private $userId;

		public function __construct($chatId, $userId) {
			$this->chatId = $chatId;
			$this->userId = $userId;
		}

		public function getMethod() {
			return "unbanChatMember";
		}

		public function getParams() {
			return [
				"chat_id" => $this->chatId,
				"user_id" => $this->userId
			];
		}

	}