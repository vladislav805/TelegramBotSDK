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

		public function getParams() {
			$res = parent::getParams();
			$res["document"] = $this->document;
			return $res;
		}

	}