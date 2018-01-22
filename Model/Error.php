<?
	namespace Telegram\Model;

	use JsonSerializable;
	use UnexpectedValueException;

	class Error extends UnexpectedValueException implements JsonSerializable {

		/**
		 * Example:
		 * {"ok":false,"error_code":400,"description":"Bad Request: QUERY_ID_INVALID"}
		 */

		/** @var int */
		protected $code;

		/** @var string */
		protected $description;

		/**
		 * Error constructor.
		 * @param object $e
		 */
		public function __construct($e) {
			$this->code = $e->error_code;
			$this->description = $e->description;
		}

		/**
		 * @return array
		 */
		public function jsonSerialize() {
			return [
				"code" => $this->code,
				"description" => $this->description
			];
		}
	}