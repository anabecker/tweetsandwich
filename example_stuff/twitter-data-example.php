<?php
//require the appropriate functions files
require_once('twitter_functions.php');
require_once('google_functions.php');
require_once('utility_functions.php');

//setup where you'd like to get data from
//a local file
//$url = "http://localhost/~spar/cooper/api/tweets.atom.xml";

//a different local file
// $url = "http://localhost/~spar/cooper/api/coffee-tweets.atom.xml";

//a twitter search url
$url = "http://search.twitter.com/search.atom?geocode=40.751744,-73.985882,10mi&q=coffee&rpp=100";

$format = 'xml';
$parameters = "";


//get some data!
$tweets = search_twitter($url, $parameters, $format, TRUE);

//label the results so that it's easy to read
echo "*---------  formatted data example  ---------*\r";


//output the data
if($format == 'xml') {
	
	//$tweets contains many tweets
	foreach($tweets->entry as $tweet) {
		//loop through each $tweet and output the data
		
		echo "twitter name: \t\t\t" . $tweet->author->name . "\r";
		echo "handle: \t\t\t" . $tweet->author->handle . "\r";
		echo "formatted tweet content: \t" . $tweet->content . "\r";
		echo "raw tweet content: \t\t" . $tweet->title . "\r";
		echo "gps coordinates: \t\t" . $tweet->location . "\r";
		echo "gps lat: \t\t\t" . $tweet->lat . "\r";
		echo "gps lon: \t\t\t" . $tweet->lon . "\r\r";
	} 
	
	//output a full example of what the entire data structure looks like	
	echo "\r\r\r*---------  full xml data example  ---------*\r";
	print_r($tweets->entry);
		
} elseif($format == 'array') {

	//$tweets contains many tweets
	foreach($tweets['entry'] as $tweet) {
		//loop through each $tweet and output the data
	
		echo "twitter name: \t\t\t" . $tweet['author']['name'] . "\r";
		echo "handle: \t\t\t" . $tweet['author']['handle'] . "\r";
		echo "formatted tweet content: \t" . $tweet['content'] . "\r";
		echo "raw tweet content: \t\t" . $tweet['title'] . "\r";
		echo "gps coordinates: \t\t" . $tweet['location'] . "\r\r";
	}
			
	//output a full example of what the entire data structure looks like				
	echo "\r\r\r*---------  full array data example  ---------*\r";
	print_r($tweets['entry'][0]);
}



?>