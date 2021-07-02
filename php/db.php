<?php
	require "libs/rb.php";
	R::setup('mysql:host=localhost; dbname=users', 'root', '');
	if ( !R::testConnection() )
	{
        exit ('Нет соединения с базой данных');
	}
	session_start();
?>