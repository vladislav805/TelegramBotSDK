<?

	namespace Telegram\Method;

	class SetWebhook extends BaseMethod {

		private $url;

		public function __construct($url) {
			parent::__construct();
			$this->url = $url;
		}

		public function getMethod() {
			return "setWebhook";
		}

		function getParams() {
			return ["url" => $this->url];
		}
	}