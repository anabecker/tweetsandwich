<?php

$animals = array('dog','cat','panda','giraffe','mouse','raccoon','taikuni','monkey','badger','coyote','brontosaur');

if(isset($_GET['number'])) {
$number = $_GET['number'];
} else {

$number = 0;

}

echo $animals[$number];


?>