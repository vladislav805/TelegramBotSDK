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

		/**
		 * @return string
		 */
		public function getPath();

	}