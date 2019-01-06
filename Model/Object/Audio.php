<?

	namespace Telegram\Model\Object;

	class Audio extends Document {

		/** @var int */
		protected $duration;

		/** @var string */
		protected $performer;

		/** @var string */
		protected $title;

		public function __construct($d) {
			parent::__construct($d);
			isset($d->duration) && ($this->duration = $d->duration);
			isset($d->performer) && ($this->performer = $d->performer);
			isset($d->title) && ($this->title = $d->title);
		}

		/**
		 * @return int
		 */
		public function getDuration() {
			return $this->duration;
		}

		/**
		 * @return string
		 */
		public function getPerformer() {
			return $this->performer;
		}

		/**
		 * @return string
		 */
		public function getTitle() {
			return $this->title;
		}

	}