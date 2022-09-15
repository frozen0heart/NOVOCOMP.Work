<?php
	require "configDB.php";
	unset($_SESSION['logged_user']);
    unset($_SESSION['logged_user_level']);
    unset($_SESSION['logged_user_Id']);

	header('Location: /');
?>