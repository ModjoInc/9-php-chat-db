<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include 'lib/login.php';
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
  <div class="container-fluid">
    <? if( !isset($_SESSION['pw']) &&  empty($_SESSION['pw'])) : ?>
  <div class="error"><? show_error(); ?></div>

  <div class="col-md-6 col-md-offset-3">
    <form action="" method="post" autocomplete="off" novalidate>
      <div class="form-group">
        <legend>SignIn</legend>
        Pseudo<input class="form-control" type="text" name="pseudo" required>
        Mot de Passe<input class="form-control" type="password" name="pw" required>
        <input class="btn btn-primary" type="submit" value="signin" name="action">
      </div>

    </form>
  </div>

  <div class="col-md-6 col-md-offset-3">
    <form action="" method="post" autocomplete="off" novalidate>
      <div class="form-group">
        <legend>SignUp</legend>
        Pseudo<input class="form-control" type="text" name="pseudo" required>
        Email<input class="form-control" type="email" name="email" required>
        Mot de Passe<input class="form-control" type="password" name="pw" required>
        <input class="btn btn-primary" type="submit" value="signup" name="action">
      </div>
    </form>
  </div>

  <? else : ?>

    <div class="col-md-6 col-md-offset-3">
      <p>Hello, <? $_SESSION['pseudo']; ?> !</p>
      <form action="" method="post">
        <input type="submit" value="signout" name="action">
      </form>
    </div>

    <div class="col-md-6 col-md-offset-3">
      <iframe title="chat" src="lib/conversation.php" width="400" height="500">
	      <p>Your browser does not support iframes.</p>
	    </iframe>
	    <iframe title="chat box" src="lib/input.php" width="400" height="200">
 	      <p>Your browser does not support iframes.</p>
      </iframe>
    </div>

  <? endif; ?>
  </div>
</body>
</html>
