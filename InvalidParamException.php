<?

	namespace Telegram;

	use RuntimeException;

	class InvalidParamException extends RuntimeException {

		public function __construct($msg) {
			parent::__construct($msg);
		}

	}