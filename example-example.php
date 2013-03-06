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
//if($format == 'xml') {
	
	//$tweets contains many tweets
	foreach($tweets as $tweet) {
		//loop through each $tweet and output the data

	$value = "@attributes";
	
	if($tweet) {
	$img = tweet->link[1]->value;
	
	echo '<a href="'. $url . '">';
	echo "<img width='50' hieght='50' src=\"" .$img['href']. "\"/>"
	echo 
	
	}
}
print_r($tweet-?link[1]);
EXIT;