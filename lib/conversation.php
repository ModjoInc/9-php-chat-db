<link rel="stylesheet" href="../assets/css/style.css">
<meta http-equiv="refresh" content="2" />
<div id="chat">


<?php

include('pdo.php');


  $req = $conn->query('SELECT * FROM message INNER JOIN user ON message.user_id = user.id ');

  $sql_data= $req->fetchAll(PDO::FETCH_ASSOC);
  $length = count($sql_data);
  for ($i=0; $i < $length; $i++) {
    echo '<p class="text">';
    echo '@'.$sql_data[$i]['pseudo'].' dit : '.$sql_data[$i]['content'];
    echo '</p>';
  }

?>
</div>
