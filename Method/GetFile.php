<?
	namespace Telegram\Method;

	class GetFile extends BaseMethod {

		private $fileId;


		public function __construct($fileId) {
			$this->fileId = $fileId;
		}

		public function getMethod() {
			return "getFile";
		}

		public function getParams() {
			return [ "file_id" => $this->fileId ];
		}

	}