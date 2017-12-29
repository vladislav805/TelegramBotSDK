<?

	namespace Telegram;

	interface IFile {

		/**
		 * @return string
		 */
		public function getFileId();

		/**
		 * @return int
		 */
		public function getFileSize();

	}