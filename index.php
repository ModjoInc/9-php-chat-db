<?php
include('errors.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Php Chat</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div id="wrapper">
    <div id="conversation">
      <iframe title="messages" src="lib/conversation.php" width="500" height="400">
        <p>Your browser does not support iframes.</p>
      </iframe>
    </div>
    <div id="login">
      <iframe title="login" src="lib/login.php" width="300" height="600">
  	      <p>Your browser does not support iframes.</p>
      </iframe>
    </div>
  </div>
</body>
</html>
