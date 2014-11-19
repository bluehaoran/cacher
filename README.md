cacher
======

A quick and simple cache that stores and retrieves things from/to a flat file cache system.


#Setup
As this is a flat file cache, you need a directory with the appropriate write permissions to it.

#Usage
Once you have a directory, then start Cacher like this:

	
	$cache = new \Untoyou\Cacher('/var/tmp/cache');  //replace this with the path to your cache directory.
	$cache->store('key', $html);
	if ($cache->contains('key')) {
		$html = $cache->fetch('key');		
	}

