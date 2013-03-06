<?php
/*
	google_functions.php
	This file contains two functions, create_markers() and create_marker().
	A properly formatted google marker document looks like this code snippit:
	
	<markers>
		<marker name="text to appear on the map" address="optional" lat="latitude" lng="longitude" />
		<marker name="text to appear on the map" address="optional" lat="latitude" lng="longitude" />
		<marker name="text to appear on the map" address="optional" lat="latitude" lng="longitude" />
	</markers>

	Each <marker> tag creates a single point on the map, when a google map requests this xml file.
	create_markers() takes a $tweet object generated from the search_twitter() function, and wraps
	the resulting tweets in the parent <markers> tags.  It then uses the create_marker() function,
	which creates an individual point, for each tweet in the $tweets object.

*/

function create_markers($tweets) {
	//Assumes you've used search_twitter() from twitter_functions.php 
	//to create an object of search results
	
	//output the open <markers> tag with a linebreak for formatting
	$markers = "<markers>\r\n";
	
	//loop through each tweet
	foreach($tweets->entry as $tweet) {

		//if there is a valid latitude and longitude (as stored by the clean_xml_geo_data() function)
		//then use the create_markers() function on the tweet
		if($tweet->lat && $tweet->lon) {
			$markers .= create_marker($tweet);
		}
	}
	//close the <markers> tag we opened just before the loop
	$markers .= "</markers>";

	return $markers;
}

function create_marker($tweet) {
		//Assumes a single tweet's data was passed into it, as created by search_twitter().

		//pull out the latitude, longitude and title, so we can easily substitute them into the tag
		$latitude = $tweet->lat;
		$longitude = $tweet->lon;
		//escape the title so that all of the content displays properly 
		//similar to if we used $tweets->content instead
		$tweet_string = htmlspecialchars($tweet->title);
		
		$tweet_string .= " at " . $tweet->date . ", " . $tweet->time;
		
		//Use the sprintf command, which replaces every %s in the first item with the following variable
		$marker =  sprintf('<marker name="%s" address="" lat="%s" lng="%s" />', $tweet_string, $latitude, $longitude);
		$marker .= "\r";
				
		return $marker;
}


?>