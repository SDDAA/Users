<?php
	require "db.php"; // подключаемся к базе данных
	unset($_SESSION['logged_user']);
	header('Location: ../index.php');
	
?>
