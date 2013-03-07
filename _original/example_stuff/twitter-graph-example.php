<?php
//require the appropriate functions files
require_once('twitter_functions.php');
require_once('google_functions.php');
require_once('utility_functions.php');
require_once('storage_functions.php');


//a twitter search url
$url = "http://search.twitter.com/search.atom?geocode=40.751744,-73.985882,10mi&q=coffee&rpp=100";

$format = 'xml';
$parameters = "";



//get some data!

//search example
//$tweets = search_twitter($url, $parameters, $format, TRUE);
//$tweets = search_datetime($tweets->entry, "2010-10-9 23:00:00", "2010-10-10 12:01:01");

//cache example
$tweets = read_data();
$days[] = search_datetime($tweets, "2010-10-8 23:00:00", "2010-10-9 12:01:01");
$days[] = search_datetime($tweets, "2010-10-9 23:00:00", "2010-10-10 12:01:01");
$days[] = search_datetime($tweets, "2010-11-8 23:00:00", "2010-10-12 12:01:01");

$day_string = implode(",", $days);

//echo count($tweets) . "\r\n";

echo $day_string;