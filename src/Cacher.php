<?php
namespace Untoyou;

class Cacher {
	private $dir;

	protected $mapping;
	public $disabled = false;
	private static $singleton;


	public function __construct($cacheDirectory = null) {
		//Force this to be a singleton.
		//	Don't need to initialise with a cacheDirectory if it already exists.
		if (static::$singleton) {
			return static::$singleton;
		}

		//In a project, uncomment this.
		// $this->dir = $cacheDirectory ?: CACHE_DIRECTORY;

		//Check that we can write to the directory
		if (!is_writable($cacheDirectory)) {
			 throw new Exception('Cannot write to Cache directory: ' . $cacheDirectory);
		}
		$this->dir = $cacheDirectory;

		// error_log('caching at ' . $this->dir);
		$entries = scandir($this->dir);
		$entries = array_diff($entries, array('..', '.') );

		foreach ($entries as $filename) {

			$this->mapping[$filename] = $filename;
		}
		// error_log(print_r($this->mapping, true));
		static::$singleton = $this;
	}


	public function store($key, $value) {
		$this->mapping[$key] = $key;
		$filename = $this->dir . $key;
error_log('storing to ' . $filename);
		// if (is_writable($filename)) {
			$file = fopen($filename, 'w');

			//verify that $value is a string
			// if (is_string($value)) {
			// 	//
			// } elseif (is_object($value) && method_exists($value, '__toString')) {
			// 	$value = $value->__toString();
			// } else {
			// 	$value = json_encode($value);
			// }
			fwrite($file, $value);
			fclose($file);
		// }
		return true;
	}

	public function contains($key) {
		if ($disabled) {
			return false; 
		}
		return array_key_exists($key, $this->mapping);
	}

	public function fetch($key) {
		$filename = $this->dir . $key;

		// $fh = fopen($filename, 'r');
		$html = file_get_contents($filename);
		// fclose($fh);
		return $html;
	}

	public function isOld($key) {

		//TODO: compare date against timestamp on file.

		return false;
	} 


}
