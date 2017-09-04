<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="../assets/css/style.css">
<div id="box">


<?php
include('pdo.php');
// Start the session
session_start();

$postMesg = file_get_contents('messages.html');
$inscription = file_get_contents('login.html');


  // interruption de session

  if(isset($_POST['disconnect'])){
      session_destroy();
    }

// Si utilisateur connu

  if(isset($_SESSION['userId'])){
    if(isset($_POST['message'])){
      $userId = $_SESSION['userId'];
      $message = $_POST['message'];
      $req = $conn->prepare("INSERT INTO message(content, user_id) VALUES (?, ?) ");
      $req->execute(array($message, $userId));
    };
    echo '@'.$_SESSION['pseudo'];
    echo $postMesg;
    }  else {
      if (isset($_POST['LogIn']) OR isset($_POST['SignUp'])){
        $msg = '';
        if (isset($_POST['LogIn'])){
          $pseudo = $_POST['pseudo'];
          $password = $_POST['pw'];
          $req = $conn->query("SELECT * FROM user WHERE pseudo = '$pseudo' ");
          $sql_data= $req->fetchAll(PDO::FETCH_ASSOC);
           // Vérification email et password
          if($pseudo == $sql_data[0]['pseudo']){
            if(password_verify($password, $sql_data[0]['pw'])){
              $_SESSION['userId'] = $sql_data[0]['id'];
              $_SESSION['pseudo'] = $sql_data[0]['pseudo'];
            } else {
              $msg = 'Mot de passe incorrect. Réessayer.';
            }
          } else {
            $msg = 'Email inconnu. Veuillez vous inscrire';
          }
        }
        // tentative de Sign Up...
        if (isset($_POST['SignUp'])){
          $pseudo = $_POST['pseudo'];
          $email = $_POST['email'];
          $password1 = $_POST['pwd1'];
          $password2 = $_POST['pwd2'];
          // Vérifier que l'email est pas connu en DB$password
          $req = $conn->query("SELECT * FROM user WHERE pseudo = '$pseudo' ");
          $sql_data= $req->fetchAll(PDO::FETCH_ASSOC);
          if(isset($sql_data[0]['pseudo'])){
            $msg = "Pseudo déjà utilisé. Veuillez utiliser un autre pseudo ou vous connecter";
            // Vérifier que les password sont identiques
            if($password1 != $password2){
              $msg = "Veuilez entrer deux mots de passe identiques.";
            }
          } else { // Si c'est OK, sanitizer, valider hasher le pwd et faire l'insertion en DB
            $pseudo = filter_var($pseudo, FILTER_SANITIZE_SPECIAL_CHARS);
            if ($pseudo) {
              $email = filter_var($email, FILTER_VALIDATE_EMAIL);
              if ($email) {
                $password = password_hash($password1, PASSWORD_DEFAULT);
                var_dump($password);
                $req = $conn->prepare("INSERT INTO user(pseudo, email, pw) VALUES (?, ?, ?) ");
                $req->execute(array($pseudo, $email, $password));
                // Récupérer ensuite l'ID et pseudo pour enregistrement de session
                $req = $conn->query("SELECT * FROM user WHERE pseudo = '$pseudo' ");
                $sql_data= $req->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION['userId'] = $sql_data[0]['id'];
                $_SESSION['pseudo'] = $sql_data[0]['pseudo'];
              } else {
                $msg = "Veuillez entrer un email valide";
              }
            } else {
              $msg = "Veuillez entrer un nom valide";
            }
          }
        }
        // envoi de messages
        if($msg != '') {
          echo $msg;
          echo $inscription;
        } else {
          echo $_SESSION['pseudo'].' dit:';
          echo $postMesg;
        }
      } else { // Sinon, proposition de login ou signup
        echo $inscription;
      }
    }


?>
</div>
