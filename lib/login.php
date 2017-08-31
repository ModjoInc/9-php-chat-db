<?

	include 'pdo.php';
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);


	if (empty($_POST)) {
		return;
	}

	$error = "";
	$inputs = [];

	// check if there are any input empty
	foreach ($_POST as $key => $value) {
		if( empty( trim($value) ) ) {
			$error .= 'Vous avez oublié d\'indiquer votre '.$key;
		}
	}

	if ( !empty($error) ) {
		return;
	}

	switch ($_POST['action']) {

		case 'signin':

			// validation + sanitization
			filter_inputs();

			if ( !empty($error) ) {
				return;
			}

			$check = $conn->prepare("SELECT pw FROM user WHERE pseudo = ?");
			$args_check = array($inputs['pseudo']);

			try {

				$check->execute($args_check);
				$hash = $check->fetchColumn();

				if ($hash) {

					if (password_verify($inputs['pw'], $hash)) {

					    $_SESSION['pseudo'] = $inputs['pseudo'];
					    $_SESSION['pw'] = $hash;

					} else {

					    $error = 'Votre mot de passe n\'est pas valide, veuillez réessayer';

					}

				} else {

					$error = 'Vous n\'êtes pas encore enregistré? veuillez vous inscrire d\'abord';

				}

			} catch (Exception $e){
				die('Error: '.$e->getMessage());
			}

			break;

		case 'signup':

			// validation + sanitization
			filter_inputs('signup');

			if ( !empty($error) ) {
				return;
			}

			return;
			// Check if pseudo or email already exist in db
			$check = $conn->prepare("SELECT id FROM user WHERE pseudo = :pseudo OR email = :email");
			$args_check = array(
				'pseudo'=>$inputs['pseudo'],
				'email'=>$inputs['email']
			);

			// Insert user
			$insert = $conn->prepare("INSERT INTO user (pseudo, email, pw) VALUES (:pseudo, :email, :pw)");
			$args_insert = array(
				'pseudo' => $inputs['pseudo'],
				'email' => $inputs['email'],
				'pw' => password_hash($inputs['pw'], PASSWORD_DEFAULT)
			);

			try {

				$check->execute($args_check);
				$user_exist = $check->fetchColumn();

				if ($user_exist) {

					$error = 'Cet utilisateur existe déjà, veuillez vous connecter';

				} else {

					$res = $insert->execute($args_insert);

					if($res) {
						// if user registed in db save value in session
						$_SESSION['pseudo'] = $inputs['pseudo'];
						$_SESSION['pw'] = password_hash($inputs['pw'], PASSWORD_DEFAULT);
					}
				}

			} catch (Exception $e){
				die('Error: '.$e->getMessage());
			}

			break;

		case 'signout':

			unset($_SESSION['pw']);

			break;

		default:
			# code...
			break;
	}

	function show_error() {
		global $error;

		if($error) {
			return '<p>'.$error.'</p>';
		}

	}

	function filter_inputs($action = 'signin') {
		global $error, $inputs;

		$args = array(
			'pseudo' => FILTER_SANITIZE_STRING,
			'pw' => FILTER_SANITIZE_STRING // try FILTER_VALIDATE_REGEXP
		);

		if ($action == 'signup') {
			$args['email'] = FILTER_VALIDATE_EMAIL;
		}

		$inputs = filter_input_array(INPUT_POST, $args );

		if ( in_array(null || false , $inputs ) ) {

			foreach ($inputs as $key=>$value) {
				if( !$value || empty($value) ) {
					$error .= "Le champ ".$key.' n\'est pas valide. ';
				}
			}

		}

	}
?>
