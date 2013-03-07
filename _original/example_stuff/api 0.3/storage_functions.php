<?php


function read_data($file = './data.txt') {

	
	if(file_exists($file) && (filesize($file)>0)) {
	
		//$serialized_contents = file($file);
		//http://us.php.net/manual/en/function.file.php#71419
		$handle = @fopen($file, "r"); 
		if ($handle) { 
		   while (!feof($handle)) { 
		       $serialized_contents[] = fgets($handle); 
		   } 
		   fclose($handle); 
		}
	
		//echo "serialized content count: " . count($serialized_contents) . "\r\n"; 
	
		foreach($serialized_contents as $serialized_content) {
			$contents[] = sxml_unserialize($serialized_content);		
		}

	
		if(count($contents)>0) {
			return $contents;
		} else {
			return FALSE;
		} 

	} else {
		return FALSE;
	}
}

function write_data($tweet, $file = './data.txt') {
	
	//determine if a tweet exists
	if(file_exists($file) && (filesize($file)>0)) {

		if(search_uniqueness($tweet->unique_id, $file)) {
	
			$fp = fopen($file, 'a');
			
		
			$xml = $tweet;
				
			fwrite($fp, serialize($xml));
			fwrite($fp, "\r\n");
			fclose($fp);		
		
			return TRUE;
	
		} 
	
	
	} elseif(file_exists($file) && (filesize($file) == 0)) {
		
		$fp = fopen($file, 'w');
		
	
		$xml = $tweet;
			
		fwrite($fp, serialize($xml));
		fwrite($fp, "\r\n");
		fclose($fp);		
	
		return TRUE;
				
	} else {
		return FALSE;
	}

}

function search_uniqueness($unique_id, $file = './data.txt') {
	
	
	if($contents = read_data($file)) {

		//echo "contents count:" . count($contents) . "\r\n";

		foreach($contents as $tweet) {
			if(isset($tweet->unique_id)) {
				//echo "tweet's id: $tweet->unique_id \r\n";
				//echo "evaluating id: $unique_id\r\n";
				if($tweet->unique_id == $unique_id) {
					//echo "match found, returning false\r\n";
					return FALSE;
				}
			}
		}
		
		//echo "match not found, returning true\r\n\r\n";
		return TRUE;
	}

}

// http://us.php.net/manual/en/function.simplexml-load-string.php#90108
function sxml_unserialize($str) {
return unserialize(str_replace(array('O:16:"SimpleXMLElement":0:{}', 'O:16:"SimpleXMLElement":'), array('s:0:"";', 'O:8:"stdClass":'), $str));
}

?>