<?

	namespace Telegram\Method;

	class SendChatAction extends BaseMethod {

		/** @var int */
		protected $chatId;

		/** @var string */
		protected $action;

		/**
		 * SendChatAction constructor.
		 * @param int $chatId
		 * @param string $action
		 */
		public function __construct($chatId, $action) {
			$this->chatId = $chatId;
			$this->action = $action;
		}

		/**
		 * @return string
		 */
		public function getMethod() {
			return "sendChatAction";
		}

		/**
		 * @return array
		 */
		public function getParams() {
			return [ "chat_id" => $this->chatId, "action" => $this->action ];
		}
	}