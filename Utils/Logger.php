<?

	namespace Telegram\Utils;

	class Logger {

		const LOG_MODE_MESSAGE = 1;
		const LOG_MODE_CALLBACK_QUERY = 2;
		const LOG_MODE_REVERSE = 4;
		const LOG_MODE_INCLUDE_RAW = 8;
		const LOG_MODE_API_RESULT = 16;

		const TYPE_MESSAGE = "MSG";
		const TYPE_CALLBACK = "CQR";
		const TYPE_INLINE = "CIR";
		const TYPE_RAW = "RAW";

		/** @var string */
		private $mLogFile;

		/** @var int */
		private $mLogMode;

		/**
		 * Logger constructor.
		 * @param string $file
		 * @param int|int[] $mode
		 */
		public function __construct($file, $mode = 0) {
			$this->mLogFile = $file;
			$this->mLogMode = is_array($mode) ? array_sum($mode) : $mode;
		}

		/**
		 * @param int $mode
		 * @param string $type
		 * @param mixed $data
		 */
		public function log($mode, $type, $data) {
			if (!($this->mLogMode & $mode)) {
				return;
			}

			if (!$this->mLogFile) {
				return;
			}

			$str = [];
			foreach ($data as $key => $value) {
				$str[] = $key . ": " . $value;
			}

			$log = sprintf("%s | %s", $type, join("; ", $str));

			if (!file_exists($this->mLogFile)) {
				fclose(fopen($this->mLogFile, "w+"));
			}

			$fh = fopen($this->mLogFile, "r+");

			$isReverse = $this->mLogMode & self::LOG_MODE_REVERSE; // true - begin, false - end
			$str = $isReverse ? $log . "\n" : "\n" . $log;
			$ft = null;

			$tmpFile = "tglg.tmp";

			if ($isReverse) {
				$ft = fopen($tmpFile, "w+");
				while (!feof($fh)) {
					fwrite($ft, fgets($fh, 4096));
				}
				fseek($fh, 0);
			} else {
				fseek($fh, 0, SEEK_END);
			}

			fwrite($fh, $str);

			if ($isReverse) {
				fseek($ft, 0, SEEK_SET);
				while (!feof($ft)) {
					fwrite($fh, fgets($ft, 4096));
				}
				fclose($ft);
				unlink($tmpFile);
			}

			fclose($fh);
		}

		public function clear() {
			fclose(fopen($this->mLogFile, "w+"));
		}

	}
