<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="refresh" content="5">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>Document</title>
</head>
<body>

<?php

include('errors.php');
include('pdo.php');

  $req = $conn->query('SELECT * FROM message INNER JOIN user ON message.user_id = user.id ');

	$sql_data= $req->fetchAll(PDO::FETCH_ASSOC);
	$length = count($sql_data);
	for ($i=0; $i < $length; $i++) {
		echo '<p>';
		echo '<span class="pseudo">@'.$sql_data[$i]['pseudo'].'</span> dit : '.$sql_data[$i]['content'];
		echo '</p>';
		// echo '<p id="lastReceived"> Dernier message : ';
		// echo '<span class="time">'.$sql_data[$length-1]['date'].'</span><br>';
		// echo '<span class="pseudo">@'.$sql_data[$i]['pseudo'].'</span> dit : '.$sql_data[$length-1]['content'];
		// echo '</p>';
  }

?>



</body>
</html>
