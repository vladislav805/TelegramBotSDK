<?

	namespace Telegram\Model;

	use stdClass;

	class WebhookInfo implements \JsonSerializable {

		/** @var string */
		private $url;

		/** @var boolean */
		private $hasCustomCertificate = false;

		/** @var int */
		private $pendingUpdateCount = 0;

		/** @var int */
		private $lastErrorDate = 0;

		/** @var string */
		private $lastErrorMessage = "";

		/** @var int */
		private $maxConnections = 40;

		/**
		 * WebhookInfo constructor.
		 * @param stdClass $d
		 */
		public function __construct($d) {
			$this->url = $d->url;
			$this->hasCustomCertificate = $d->has_custom_certificate;
			$this->pendingUpdateCount = $d->pending_update_count;
			isset($d->last_error_date) && ($this->lastErrorDate = $d->last_error_date);
			isset($d->last_error_message) && ($this->lastErrorMessage = $d->last_error_message);
			$this->maxConnections = $d->max_connections;
		}

		/**
		 * @return string
		 */
		public function getUrl() {
			return $this->url;
		}

		/**
		 * @return int
		 */
		public function getPendingUpdateCount() {
			return $this->pendingUpdateCount;
		}

		/**
		 * @return int
		 */
		public function getLastErrorDate() {
			return $this->lastErrorDate;
		}

		/**
		 * @return string
		 */
		public function getLastErrorMessage() {
			return $this->lastErrorMessage;
		}

		/**
		 * @return int
		 */
		public function getMaxConnections() {
			return $this->maxConnections;
		}

		/**
		 * @return array
		 */
		public function jsonSerialize() {
			return get_object_vars($this);
		}

	}