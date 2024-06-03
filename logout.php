<?php
	session_start();
	session_destroy();

	header('location: machine_type.php');
?>