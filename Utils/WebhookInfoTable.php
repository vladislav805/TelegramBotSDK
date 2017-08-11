<?

	namespace Telegram\Utils;

	use Telegram\Model\WebhookInfo;

	class WebhookInfoTable {

		/**
		 * @param WebhookInfo $info
		 */
		public static function outputTable($info) {
			header("Content-type: text/plain; charset=utf-8");


			printf("%-20s: %s\n", "URL", $info->getUrl());
			printf("%-20s: %s\n", "Pending updates", $info->getPendingUpdateCount());
			printf("%-20s: %s\n", "Last error date", date("d.m.Y H:i:s", $info->getLastErrorDate()));
			printf("%-20s: %s\n", "Last error message", $info->getLastErrorMessage());
			printf("%-20s: %s\n", "Max connections", $info->getMaxConnections());

			exit;
		}
	}