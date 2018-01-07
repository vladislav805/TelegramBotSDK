<?

	namespace Telegram\Method;

	use Telegram\IMethodParsable;
	use Telegram\Model\Object\Message;

	class SendMessage extends SendMethod implements IMethodParsable {

		public function __construct($chatId, $text = null) {
			parent::__construct($chatId, $text);
		}

		public function getMethod() {
			return "sendMessage";
		}

		public function getParams() {
			return parent::getParams();
		}

		/**
		 * Parse response from API to objects
		 * @param object $result
		 * @return Message
		 */
		public function parseResponse($result) {
			return new Message($result->result);
		}
	}