<?

	namespace Telegram\Method;

	use Telegram\IMethodParsable;
	use Telegram\Model\Object\InputMedia;
	use Telegram\Model\Object\Message;

	class SendMediaGroup extends SendMethod implements IMethodParsable {

		/** @var InputMedia[] */
		protected $media;

		/**
		 * SendMediaGroup constructor.
		 * @param int $chatId
		 * @param InputMedia[] $media
		 */
		public function __construct($chatId, $media = []) {
			parent::__construct($chatId, null);
			$this->media = $media;
		}

		/**
		 * @return string
		 */
		public function getMethod() {
			return "sendMediaGroup";
		}

		/**
		 * Force override method
		 * @return array
		 */
		public function getParams() {
			$res = [
				"chat_id" => $this->chatId,
				"media" => $this->media
			];
			if ($this->disableNotification) {
				$res["disable_notification"] = $this->disableNotification;
			}
			if ($this->replyToMessageId) {
				$res["reply_to_message_id"] = $this->replyToMessageId;
			}
			return $res;
		}

		/**
		 * Parse response from API to objects
		 * @param object $result
		 * @return Message[]
		 */
		public function parseResponse($result) {
			return null;
		}
	}