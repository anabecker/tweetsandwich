<?php
/*
	twitter_functions.php
	This file contains 4 main functions.  When using this library, the only function directly relevant
	to use is the search_twitter() function, which then selectivecly uses the clean_data() function,
	which in turn uses either a function from utility_functions.php, or the two additional functions
	from this file, clean_xml_geo_data() and add_xml_author_handle().  Each of these functions are
	described in detail below.

*/


function search_twitter($url, $parameters = NULL, $format = 'xml', $clean = TRUE) {
/*
	This function takes 1 required variable, and 3 optional variables.
	
	$url (required) 						= The url to retrieve results from.
	$parameters (optional, empty by default)		= Additional parameters to add to the search
	$format (optional, array by default)	= Format of the results, either xml or array
	$clean (optional, true by default)		= Run additional data cleaning functions
	
	Minimal example usage:
	This will run the query on twitter.com, and return a $tweets variable containing an array of the results mentioning coffee.
	$tweets = search_twitter('http://search.twitter.com/?q="coffee"');

	
	More involved usage:
	This will return a $tweets variable containing an simpleXML object, with results about coffee shops or tea rooms.
	$tweets = search_twitter('http://search.twitter.com/', array("Coffee Shop","Tea Room", 'xml');
*/


	//set a useragent, basically what the receiving website will know about you
	$useragent="com.erinsparling.cooperunion.tweetapi";
	
	//construct the final $url
	if($parameters != NULL) {
		$url .= urlencode($parameters);
	}
	
	//set a bunch of defaults for the cURL program, used to retrieve remote data
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

	//get the remote data
	$tweets = curl_exec($ch);
	curl_close($ch);

	//aoptionally clean the data
	if($clean == TRUE) {
		$tweets = clean_data($tweets, $format);
	}
	
	//return the data back to where it was called from
	return $tweets;

}

//take tweets (a curl object) and a format (xml, array or other)
//format the data uniformly, construct additional data types
function clean_data($tweets, $format) {
	
	$tweets = str_replace('google:location', 'location', $tweets);
	$tweets = str_replace("\r\n", '', $tweets);
	$tweets = str_replace("\r", '', $tweets);
	$tweets = str_replace("\n", '', $tweets);
	
	$tweets = new SimpleXMLElement($tweets);
	
	if($format == 'array') {
		
		//If the format is an array, convert the results into a large array
		$tweets = amstore_xmlobj2array($tweets);
		
	} elseif($format == 'xml') {
		
		//If the format is xml, clean up the gps coordinates
		//add additional author handle information
		$tweets = clean_xml_geo_data($tweets);
		$tweets = add_xml_author_handle($tweets);		
		$tweets = add_unique_id($tweets);
		$tweets = add_datetime_info($tweets);		
		
	} else {
		//format unknown, just return it back as raw data
	}
	
	return $tweets;
}

//clean up disparate gps coordinate information
function clean_xml_geo_data($tweets) {
	foreach($tweets->entry as $tweet) {
		$location = explode(" ", $tweet->location);

		if(count($location) == 2) {
			
			//data looks like iPhone: 37.778274,-122.397939
			//we only want the 2nd part of that, i.e. the coordinates

			/*sometimes the data is messed up
			Case 1) garbage first text
			(
			    [0] => ÃœT:
			    [1] => 37.788491,-122.404388
			)
			Case 2) informative first text
			(
			    [0] => iPhone:
			    [1] => 37.762557,-122.435306
			)
			Case 3) already formatted correctly
			(
			    [0] => 37.776000,
			    [1] => -122.403300
			)
			My assumption is that if we ask about location[1], and it's a valid number, then it's case 3.
			Otherwise, treat the location[1] item as the thing that needs to be split.*/

			if(is_numeric($location[1])) {
				//Case 3 from above, i.e. the data was already valid.  Re-combine so tht it's handled uniformly.
				$location = implode("", $location);
				$tweet->location = $location;
			} else {
				//Assume Case 1 and 2, so just pass through the data from the 2nd element
				$tweet->location = $location[1];
			}
							
		} elseif(count($location) == 1) {
			//Assume data is fine, do nothing
		} else {
			//Data is of an unknown type
			$tweet->location = NULL;
		}
		
		if($tweet->location != NULL) {
			$coordinates = explode (",", $tweet->location);
			if(is_numeric($coordinates[0]) && is_numeric($coordinates[1])) {
				$tweet->lat = $coordinates[0];
				$tweet->lon = $coordinates[1];
			}
		}

	}
	
	return $tweets;
}

//author information usually looks like [uri] => http://twitter.com/everyplace
//add a 'handle' value to the data object that just returns the username, in this case [handle] => everyplace
function add_xml_author_handle($tweets) {
	foreach($tweets->entry as $tweet) {
		//create $handle by finding the uri value [uri] => http://twitter.com/<username>
		//and removing the http://twitter.com part, so we're left with just <username>
		$handle = str_replace('http://twitter.com/', '', $tweet->author->uri);
		
		//add $handle back to the data object
		$tweet->author->addChild('handle', $handle);
		
	}
	
	//return the data object back to where it was called from
	return $tweets;
}

//unique id usually looks like [id] => tag:search.twitter.com,2005:26333901439
//add an 'id' value to the data object that just returns the username, in this case [id] => 26333901439
function add_unique_id($tweets) {
	foreach($tweets->entry as $tweet) {
		//create $id by using the explode() function to turn the id value
		//using the ":" character to separate the three pieces
		$unique_id = explode(":",$tweet->id);

		//the above example would become:
		//	[0] => tag
		//	[1] => search.twitter.com,2005
		//	[2] => 26333901439
		//add $id back to the data object by selecting the 3rd item
		// $tweet->unique_id = (int)$unique_id[2];
		$tweet->addChild('unique_id', $unique_id[2]);
	}
	
	//return the data object back to where it was called from
	return $tweets;
}

function add_datetime_info($tweets) {
	foreach($tweets->entry as $tweet) {
	
		$datetime = explode("T", $tweet->published);
			
		$date = $datetime[0];
		$time = str_replace('Z','', $datetime[1]);
		
		$tweet->addChild('date',$date);
		$tweet->addChild('time',$time);
		
	
	}


	
	return $tweets;
}

//$start and $end can be standard date strings.
//valid examples: 
//$start = "2010-10-10";
//$start = "2010-10-9 12:30";
//$start = "2010-10-8 12:30:20";
//$end = "yesterday";
//$end = "2010-10-11";
function search_datetime($tweets, $start, $end = "NOW") {

	if(strstr($start, ":")) {
		$startDateTime = explode(":", $start);
	
		$startDate = $startDateTime[0];
		$startTime = $startDateTime[1];
	} else {
		
		$startDate = $start;
		$startTime = NULL;
		
	}
	
	if(strstr($end, ":")) {
		$endDateTime = explode(":", $end);
	
		$endDate = $endDateTime[0];
		$endTime = $endDateTime[1];
	} else {
		
		$endDate = $end;
		$endTime = NULL;
		
	}

	$filtered_tweets = array();
	foreach($tweets as $tweet) {
		if(isset($tweet->date) && isset($tweet->time)) {
			
			//echo strtotime($tweet->date) . "\r\n";
			if((strtotime($start) <= strtotime($tweet->date)) && (strtotime($tweet->date) <= strtotime($end))) {
			
				$filtered_tweets[] = $tweet;

			}	
		}
	}

	return $filtered_tweets;
}


?>