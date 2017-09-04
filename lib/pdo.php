<?php

$servername = "localhost";
$username = "root";
$password = "mvdtvw28";

try {
   $conn = new PDO('mysql:host='.$servername.';dbname=mini_chat;charset=utf8', $username, $password);
   // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connection à la BD OK";
   } catch (PDOException $e) {
   echo "Connection failed: " . $e->getMessage();
   }
?>
