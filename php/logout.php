<?php
	session_start();
	session_destroy();
	header('Location: http://localhost/theFitnessBox/html/main.html');
	exit;
?>
