<?php

$conn = mysqli_connect('127.0.0.1', 'admin', 'admin123', 'supermarket');

// check connection
if(!$conn){
	echo 'Connection Error'.mysqli_connect_error();
}

?>