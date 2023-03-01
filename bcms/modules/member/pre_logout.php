<?php
	/*
	$_SESSION=array();
	unset($_SESSION);
	session_unset();
	unset($membersID);
	*/
	session_start();
  	session_destroy();
	$Message="You are logged out";
	header("Location: /");

?>
