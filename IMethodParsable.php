<?

	namespace Telegram;

	interface IMethodParsable {

		/**
		 * Parse response from API to objects
		 * @param object $result
		 * @return mixed
		 */
		public function parseResponse($result);

	}