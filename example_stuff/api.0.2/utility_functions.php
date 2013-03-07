<?php
/*
	utility_functions.php
	google_functions and twitter_functions are really specific, in that they are only supposed to
	contain functions related to that type of content.  Generally, when on a project, there is a
	category of functions that develop that aren't really about data, so much as about utility.
	preprint_r() is a great example of this, in that it's only for quickly outputting data to test,
	and isn't about any particular type of data.


*/

function preprint_r($array) {
	//take an array and make it display in a human-readable way without viewing source all the time

	echo "<pre>\r\n\t";
	print_r($array);
	echo "\r\n</pre>\r";
}

function amstore_xmlobj2array($obj, $level=0) {
    //convert a simbpleXML object into an array
	//Copied in it's entirety from the comments on http://php.net/manual/en/book.simplexml.php
    $items = array();
    
    if(!is_object($obj)) return $items;
        
    $child = (array)$obj;
    
    if(sizeof($child)>1) {
        foreach($child as $aa=>$bb) {
            if(is_array($bb)) {
                foreach($bb as $ee=>$ff) {
                    if(!is_object($ff)) {
                        $items[$aa][$ee] = $ff;
                    } else
                    if(get_class($ff)=='SimpleXMLElement') {
                        $items[$aa][$ee] = amstore_xmlobj2array($ff,$level+1);
                    }
                }
            } else
            if(!is_object($bb)) {
                $items[$aa] = $bb;
            } else
            if(get_class($bb)=='SimpleXMLElement') {
                $items[$aa] = amstore_xmlobj2array($bb,$level+1);
            }
        }
    } else
    if(sizeof($child)>0) {
        foreach($child as $aa=>$bb) {
            if(!is_array($bb)&&!is_object($bb)) {
                $items[$aa] = $bb;
            } else
            if(is_object($bb)) {
                $items[$aa] = amstore_xmlobj2array($bb,$level+1);
            } else {
                foreach($bb as $cc=>$dd) {
                    if(!is_object($dd)) {
                        $items[$obj->getName()][$cc] = $dd;
                    } else
                    if(get_class($dd)=='SimpleXMLElement') {
                        $items[$obj->getName()][$cc] = amstore_xmlobj2array($dd,$level+1);
                    }
                }
            }
        }
    }

    return $items;
}


?>