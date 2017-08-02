<?

	namespace Telegram\Method;

	class GetWebhookInfo extends BaseMethod {

		private $url;

		public function __construct() {
			parent::__construct();
		}

		public function getMethod() {
			return "getWebhookInfo";
		}

		function getParams() {
			return [];
		}
	}