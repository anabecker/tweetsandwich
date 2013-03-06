<?php
require_once('twitter_functions.php');
require_once('utility_functions.php');

//a twitter search url
$url = "http://search.twitter.com/search.atom?&q=+sandwich+OR+sammich+OR+tweetsandwich+&rpp=200";
$format = "xml"; 
$parameters = "";

//get some data!
$tweets = search_twitter($url);

//print_r($tweets);




?>

<html>
<head>
<title>tweet sandwich</title>
<link rel="stylesheet" type="text/css" href="style.css" media="screen">
	<style type="text/css">
	
	body{
	background-color:#000;
	}
	

	
	</style>
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19360346-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
	<div id="wrapper">
	<h1>tweet sandwich</h1>
	<h2>(Almost) all sandwich ingredients courtesy of <a href="http://www.scanwiches.com">scanwiches.com</a></h2>
	<div id="share">
	<div id="twitter">
<a href="http://twitter.com/share" class="twitter-share-button" data-text="tweet sandwich = a sandwich. made of twitter." data-count="none" data-via="tweetsandwich" data-related="ana_becker">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div id="stumbleupon"><script src="http://www.stumbleupon.com/hostedbadge.php?s=1"></script></div>
<iframe id="facebook" src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.tweetsandwich.com&amp;layout=standard&amp;show_faces=true&amp;width=200&amp;action=like&amp;colorscheme=dark&amp;height=30" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:80px;" allowTransparency="true"></iframe>


	</div>
	<div id="sandwichtop"></div>
	<div id="sandwichbody">	
	
	
	
		
<?php 

//$fulltext = "InCurtWeTrust @Handy_Manny10 chill get me a porkchop sandwich good looks my dude w cheese 3 minutes ago reply', 'sxyscorpio profile sxyscorpio Mannnnnnnn that took a lot outta me! Sheeshh #FINALLY to a seat now my philly cheese steak sandwich and a quik nap!', 'lizatweet profile lizatweet Nom nom ham sammich. 4 minutes ago reply','cheeeeeeeeeeeeeeeeeeese cheese','nomnomnom eating a sandwich made of nothing'";

//$tweets = explode (",", $fulltext);

function make_sandwich($tweet){


		if(stristr($tweet, "steak")){
		$type = "steak";
		}elseif(stristr($tweet, "pork")){
		$type = "pork";		
		}elseif(stristr($tweet, "meatball")){
		$type = "meatball";
		}elseif(stristr($tweet, "meatballs")){
		$type = "meatball";
		}elseif(stristr($tweet, "corned beef")){
		$type = "cornedbeef";
		}elseif(stristr($tweet, "chicken")){
		$type = "chicken";
		}elseif(stristr($tweet, "beef")){
		$type = "steak";
		}elseif(stristr($tweet, "tuna")){
		$type = "tuna";
		}elseif(stristr($tweet, "porkchop")){
		$type = "pork";
		}elseif(stristr($tweet, "blt")){
		$type = "blt";
		}elseif(stristr($tweet, "bacon lettuce tomato")){
		$type = "blt";
		}elseif(stristr($tweet, " ham")){
		$type = "ham";
		}elseif(stristr($tweet, "turkey")){
		$type = "turkey";
		}elseif(stristr($tweet, "PB&J")){
		$type = "pbj";
		}elseif(stristr($tweet, "peanut butter & jelly")){
		$type = "pbj";
		}elseif(stristr($tweet, "peanut butter and jelly")){
		$type = "pbj";
		}elseif(stristr($tweet, "peanut butter&jelly")){
		$type = "pbj";
		}elseif(stristr($tweet, "peanut butter jelly")){
		$type = "pbj";
		}elseif(stristr($tweet, "peanut butter & banana")){
		$type = "pbbanana";
		}elseif(stristr($tweet, "peanut butter and banana")){
		$type = "pbbanana";
		}elseif(stristr($tweet, "peanut butter")){
		$type = "pb";
		}elseif(stristr($tweet, "salami")){
		$type = "salami";
		}elseif(stristr($tweet, "prosciutto")){
		$type = "salami";
		}elseif(stristr($tweet, "pastrami")){
		$type = "pastrami";
		}elseif(stristr($tweet, "roast beef")){
		$type = "roastbeef";
		}elseif(stristr($tweet, "roastbeef")){
		$type = "roastbeef";
		}elseif(stristr($tweet, "veggie")){
		$type = "veggie";
		}elseif(stristr($tweet, "vegetable")){
		$type = "veggie";
		}elseif(stristr($tweet, "ice cream")){
		$type = "icecream";
		}elseif(stristr($tweet, "egg ")){
		$type = "egg";
		}elseif(stristr($tweet, "cheese")){
		$type = "cheese";
		}elseif(stristr($tweet, "bacon")){
		$type = "bacon";
		
		}else{
		$type = "none";
		}
	//echo $type;
	if ($type != "none"){
	$sandwich = "<div class='sandwich ". $type . "'>";
	$sandwich .= "<div class='tweet'><p>". $tweet. "</p></div>";
	$sandwich .= "</div>";
	echo $sandwich;
	}
}

foreach($tweets->entry as $tweet) {
				
					$counter = $counter + 1;

					$title = $tweet->title;
					$author = $tweet->author->name;

	 make_sandwich($title);
}


?>
</div>
	<div id="sandwichbottom"></div>		
	<div id="footer">
	<p>&copy; <a href="http://www.anabdesigns.com">Ana Becker Design</a> 2012</p> 
	</div>
	
</body>

<!--foreach ($tweet as $item){
	if(stristr($item, "steak")){
	echo "<div class='sandwich' id='steak'><div class='tweet'>$item</div></div>";
	}elseif(stristr($item, "pork")){
	echo "<div class='sandwich' id='pork'><div class='tweet'>$item</div></div>";
	}elseif(stristr($item, "porkchop")){
	echo "<div class='sandwich' id='pork'><div class='tweet'>$item</div></div>";
	}elseif(stristr($item, "cheese")){
	echo "<div class='sandwich' id='cheese'><div class='tweet'>$item</div></div>";
	}elseif(stristr($item, "ham")){
	echo "<div class='sandwich' id='ham'><div class='tweet'>$item</div></div>";
	}

} -->


<!--foreach ($tweet as $item){

	if (stristr($item, "steak")){
		echo "<div id='steak' class='sandwich'>steak</div>";
		}elseif (stristr($item, "cheese")){
		echo "<div id='cheese' class='sandwich'><p>", $item, "</p></div>";
		}elseif (stristr($item, "turkey")){
		echo "<div id='turkey' class='sandwich'>turkey</div>";
		}else{
		echo "<div id='false'>false</div>"
	}

}
// foreach ($tweet as $item){
// 
// 	if (stristr($item, "steak")){
// 		$sandwich = "steak.png";
// 		}elseif (stristr($item, "cheese")){
// 		sandwich = "cheese.png";
// 		}elseif (stristr($item, "turkey")){
// 		$sandwich = "turkey.png";
// 		}else{
// 		$sandwich = "display:none";
// 	}
// 
// }-->
</html>




		
		
		
		
		
		
		
		