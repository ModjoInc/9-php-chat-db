<?php

	try {
		$db = new PDO('mysql:host=localhost;dbname=mini_chat;charset=utf8', 'root', 'mvdtvw28', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	} catch (Exception $e){
		die('Error: '.$e->getMessage());
	}
