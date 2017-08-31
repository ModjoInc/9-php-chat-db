<?
include('lib/connect.php');

try {
   $conn = new PDO("mysql:host=$servername;dbname=mini_chat", $username, $password);
   // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    "Connection à la BD OK";
   }
catch(PDOException $e)
   {
   "Connection failed: " . $e->getMessage();
   }
?>
