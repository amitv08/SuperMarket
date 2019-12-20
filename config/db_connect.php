<?php

$conn = mysqli_connect('127.0.0.1', 'admin', 'admin123', 'mybooks');

// check connection
if(!$conn){
	echo 'Connection Error'.mysqli_connect_error();
}

?>