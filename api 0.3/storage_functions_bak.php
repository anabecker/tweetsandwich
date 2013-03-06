<?php

function read_data($file = './data.txt') {

	$unserialized_contents = file($file);
	foreach($unserialized_contents as $item) {
		$contents[] = unserialize($item);
	}
	return $contents;
}

function write_data($tweet, $file = './data.txt') {
	
	//determine if a tweet exists
	print_r($tweet);

	if(search_uniqueness($tweet->unique_id->__toString, $file)) {
	
		$fp = fopen($file, 'a');
			
		fwrite($fp, $tweet->unique_id . ",");
		fwrite($fp, serialize($tweet));
		fwrite($fp, "\r");
		fclose($fp);		
		
		return TRUE;

	} else {

		return FALSE;

	}

}

function search_uniqueness($unique_id, $file = './data.txt') {
	$content = file($file);

	if(count($content)>0) {
		foreach ($content as $item) {
			if($unique_id == substr($item, 0, 11)) {
				//data is non-unique
				return FALSE;
			}
		}
	} else {
		return TRUE;
	}
	
}

?>