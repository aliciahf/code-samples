<?php
	session_unset();
	session_destroy();

	//redirect
	header("Location: index.php");
	die("REdirecting to: index.php");
?>