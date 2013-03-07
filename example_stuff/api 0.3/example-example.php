<?php
//require the appropriate functions files
require_once('twitter_functions.php');
require_once('utility_functions.php');
require_once('storage_functions.php');


//get some data!
$tweets = read_data();


foreach($tweets as $tweet) {


	$value = "@attributes";
	if($tweet) {
		$img = $tweet->link[1]->$value;
		$url = $tweet->author->uri;
	
		echo '<a href="' . $url . '">';
		
		echo "<img width='50' height='50' src=\"" . $img['href'] . "\"/>";
		
		echo "</a>";
	}	
	
}


?>


