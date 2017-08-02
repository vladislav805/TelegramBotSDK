<?

	namespace Telegram\Model;

	use JsonSerializable;

	class Chat implements JsonSerializable {

		/** @var int */
		protected $id;

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
		 * @param \stdClass $d
		 */
		public function __construct($d) {
			$this->id = $d->id;

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
		 * @return array
		 */
		public function jsonSerialize() {
			return [
				"id" => $this->id,
				"first_name" => $this->firstName,
				"last_name" => $this->lastName,
				"username" => $this->username
			];
		}

		/**
		 * @param Chat $val
		 * @return boolean
		 */
		public function __is_equal($val) {
			return $this->getId() === $val->getId();
		}

	}