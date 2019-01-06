<?
	namespace Telegram\Method;

	use Telegram\IMethodParsable;
	use Telegram\Model\Object\FullDocument;

	class RestrictChatMember extends BaseMethod {

		private $chatId;

		private $userId;

		private $untilDate;

		private $access = 0;

		const CAN_MESSAGE = 1;
		const CAN_MEDIA = 2;
		const CAN_OTHER = 4;
		const CAN_WEB_PREVIEW = 8;
		const CAN_ALL = self::CAN_MESSAGE | self::CAN_MEDIA | self::CAN_OTHER | self::CAN_WEB_PREVIEW;


		public function __construct($chatId, $userId, $untilDate = 0, $mode = 0) {
			$this->chatId = $chatId;
			$this->userId = $userId;
			$this->untilDate = $untilDate;
			$this->access = $mode;
		}

		public function getMethod() {
			return "restrictChatMember";
		}

		public function addAccess($mode) {
			$this->access |= $mode;
		}

		public function getParams() {
			return [
				"chat_id" => $this->chatId,
				"user_id" => $this->userId,
				"until_date" => $this->untilDate,
				"can_send_messages" => ($this->access & self::CAN_MESSAGE) > 0,
				"can_send_media_messages" => ($this->access & self::CAN_MEDIA) > 0,
				"can_send_other_messages" => ($this->access & self::CAN_OTHER) > 0,
				"can_add_web_page_previews" => ($this->access & self::CAN_WEB_PREVIEW) > 0
			];
		}

	}