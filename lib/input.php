<?

	include 'pdo.php';
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

	session_start();

	if ( !empty($_POST) && !empty($_POST['message']) ) :

		$msg = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);
	 	try {

	 		$req = $conn -> prepare("INSERT INTO message (content, date, user_id) VALUES (:content, NOW(), (SELECT id FROM user WHERE pseudo = :pseudo))");
	 		$res = $req -> execute(array(
	 				'content' => $msg,
	 				'pseudo' => $_SESSION['pseudo']
	 		));

	 	} catch (Exception $e){
	 		die('Error: '.$e->getMessage());
	 	}

	endif;

?>

		<form action="" method="post">
			<textarea name="message" id="" rows="5"></textarea>
			<input type="submit" value="send">
		</form>
