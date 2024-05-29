<?php
	$conn = new mysqli('localhost', 'root', '', 'abdullatif');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>