<?

	namespace Telegram\Method;

	class SendDocument extends SendMethod {

		/** @var string */
		protected $document;

		public function __construct($chatId, $file = "", $text = null) {
			parent::__construct($chatId, $text);
			$this->setDocument($file);
		}

		public function getMethod() {
			return "sendDocument";
		}

		public function setDocument($document) {
			$this->document = $document;
		}

		public function getText() {
			return $this->text;
		}

		public function getParams() {
			$res = [ "chat_id" => $this->chatId, "caption" => $this->text, "document" => $this->document ];
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