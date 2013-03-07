<?php
//require the appropriate functions files
require_once('twitter_functions.php');
require_once('google_functions.php');
require_once('utility_functions.php');
require_once('storage_functions.php');

//setup where you'd like to get data from
$format='xml';


//get some data!
$tweets = read_data();

//label the results so that it's easy to read
echo "*---------  formatted data example  ---------*\r";


//output the data
if($format == 'xml') {
	
	//$tweets contains many tweets
	foreach($tweets as $tweet) {
		//loop through each $tweet and output the data
		
		if(isset($tweet->author->name)) {
			echo "twitter name: \t\t\t" . $tweet->author->name . "\r";
		}
		if(isset($tweet->author->handle)) {
			echo "handle: \t\t\t" . $tweet->author->handle . "\r";
		}
		if(isset($tweet->content)) {
			echo "formatted tweet content: \t" . $tweet->content . "\r";
		}
		if(isset($tweet->title)) {
			echo "raw tweet content: \t\t" . $tweet->title . "\r";
		}
		if(isset($tweet->location)) {
			echo "gps coordinates: \t\t" . $tweet->location . "\r";
		}
		if(isset($tweet->lat)) {
			echo "gps lat: \t\t\t" . $tweet->lat . "\r";
		}
		if(isset($tweet->lon)) {
			echo "gps lon: \t\t\t" . $tweet->lon . "\r\r";
		}
	} 
	
	//output a full example of what the entire data structure looks like	
	echo "\r\r\r*---------  full xml data example  ---------*\r";
	print_r($tweets);
		
}



?>