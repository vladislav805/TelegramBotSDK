<?

	namespace Telegram\Method;

	class SetWebhook extends BaseMethod {

		/** @var string */
		private $url;

		/** @var int */
		private $maxConnections = 20;

		public function __construct($url, $maxConnections = 20) {
			parent::__construct();
			$this->url = $url;
			$this->maxConnections = $maxConnections;
		}

		public function getMethod() {
			return "setWebhook";
		}

		function getParams() {
			return ["url" => $this->url, "max_connections" => $this->maxConnections ];
		}

	}