<?
	namespace Telegram\Method;

	use Telegram\IMethodParsable;
	use Telegram\Model\Object\UserProfilePhotos;

	class GetUserProfilePhotos extends BaseMethod implements IMethodParsable {

		private $userId;

		private $offset;

		private $limit;


		public function __construct($userId, $offset = 0, $limit = 100) {
			$this->userId = $userId;
			$this->offset = $offset;
			$this->limit = $limit;
		}

		public function getMethod() {
			return "getUserProfilePhotos";
		}

		public function getParams() {
			return [ "user_id" => $this->userId, "offset" => $this->offset, "limit" => $this->limit ];
		}

		/**
		 * Parse response from API to objects
		 * @param object $result
		 * @return UserProfilePhotos
		 */
		public function parseResponse($result) {
			return new UserProfilePhotos($result);
		}
	}