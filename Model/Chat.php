<?

	namespace Telegram\Model;

	use JsonSerializable;

	abstract class Chat implements JsonSerializable {

		// TODO: remove it
		/** @deprecated  */
		const TYPE_USER = "private";

		/** @deprecated  */
		const TYPE_GROUP = "group";

		/** @deprecated  */
		const TYPE_SUPERGROUP = "supergroup";

		/** @deprecated  */
		const TYPE_CHANNEL = "channel";


		/** @var int */
		protected $id;

		/** @var boolean */
		protected $mIsBot;

		/** @var string */
		protected $firstName;

		/** @var string|null */
		protected $lastName;

		/** @var string */
		protected $username;

		/** @var string */
		protected $languageCode;

		/** @var string */
		protected $type;

		/**
		 * User constructor.
		 * @param object $d
		 */
		public function __construct($d) {
			$this->id = $d->id;

			isset($d->is_bot) && ($this->mIsBot = $d->is_bot);
			isset($d->username) && ($this->username = $d->username);
			isset($d->first_name) && ($this->firstName = $d->first_name);
			isset($d->last_name) && ($this->lastName = $d->last_name);
			isset($d->type) && ($this->type = $d->type);
			isset($d->language_code) && ($this->languageCode = $d->language_code);
		}

		/**
		 * @return int
		 */
		public function getId() {
			return $this->id;
		}

		/**
		 * @return string
		 */
		public function getFullName() {
			return $this->firstName . " " . $this->lastName;
		}

		/**
		 * @return string
		 */
		public function getFirstName() {
			return $this->firstName;
		}

		/**
		 * @return string
		 */
		public function getLastName() {
			return $this->lastName;
		}

		/**
		 * @return string
		 */
		public function getUsername() {
			return $this->username;
		}

		/**
		 * TODO: remove it
		 * @deprecated
		 * @return string
		 */
		public function getType() {
			return $this->type;
		}

		/**
		 * @return string
		 */
		public function getLanguageCode() {
			return $this->languageCode;
		}

		/**
		 * @return array
		 */
		public function jsonSerialize() {
			return get_object_vars($this);
		}

		/**
		 * @param Chat $val
		 * @return boolean
		 */
		public function __is_equal($val) {
			return $this->getId() === $val->getId();
		}

		/**
		 * Parse chat and return needed instance: User, Group, Supergroup, Channel
		 * @param object $chat
		 * @return Chat
		 */
		static function parse($chat) {
			if (isset($chat->type)) {
				switch ($chat->type) {
					case "private": return new User($chat);
					case "group": return new Group($chat);
					case "supergroup": return new Supergroup($chat);
					case "channel": return new Channel($chat);
				}
			}
			return new User($chat);
		}

	}