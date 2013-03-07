<?php

//require the appropriate functions files
require_once('twitter_functions.php');
require_once('utility_functions.php');

//a twitter search url
$url = "http://search.twitter.com/search.atom?geocode=40.751744,-73.985882,10mi&q=coffee&rpp=5";
$format = 'xml'; 
$parameters = "";

//get some data!
$tweets = search_twitter($url, $parameters, $format, TRUE);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>100 coffee tweets</title>
		<link rel="stylesheet" type="text/css" media="screen" href="styles.css" />
	</head>
	<body>
	
		<div class="tweets">
			<?php
			
				$counter = 0;
			
				foreach($tweets->entry as $tweet) {
				
					$counter = $counter + 1;

					$title = $tweet->title;
					$author = $tweet->author->name;

					echo '<div class="tweet" id="post-' . $counter . '">';
					
					if($counter == 1) {
						$titleOpenTag = "<h1>";
						$titleCloseTag = "</h1>";
					} else {
						$titleOpenTag = "<h2>";
						$titleCloseTag = "</h2>";

					}
					
					$authorOpenTag = "<h3>";
					$authorCloseTag = "</h3>";
					
					echo $titleOpenTag . $title . $titleCloseTag;
					echo $authorOpenTag . $author . $authorCloseTag;
					
					
					echo "</div>\r\n";
					
				
				}
				
			
			?>
		</div>
	
	
	
	</body>
</html>




		
		
		
		
		
		