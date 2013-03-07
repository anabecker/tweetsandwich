<?php

//require the appropriate functions files
require_once('twitter_functions.php');
require_once('google_functions.php');
require_once('utility_functions.php');

//a twitter search url
// $url = "http://localhost/~spar/cooper/api/tweets.atom.xml";
$url = "http://search.twitter.com/search.atom?geocode=40.751744,-73.985882,10mi&q=coffee&rpp=100";
$format = 'xml'; 
$parameters = "";

//get some data!
$tweets = search_twitter($url, $parameters, $format, TRUE);

//output your data!
echo create_markers($tweets);

?>