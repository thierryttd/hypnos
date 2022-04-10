<?php
require_once 'sessionManager.php';
require_once '../model/User.php';

if (!isset($_SESSION['connection'])){
    header('Location: '. 'userConnect.php');
}

if (isset($_POST['from']) && $_POST['from'] === 'userChangePw.php'){
    $user = new User();
    $response = $user->findId($pdo, $_SESSION['id']);
    if(isset($response) && !is_object($response)){
        $titre = "Problème d\'accès à votre compte.";
        $next = 'home.php';
        displayMessage($titre, $response, $next);
        die();
    }
    // check current password is correct before change password
    if (password_verify($_POST['previousPw'], $user->getPassword()) ) {
        $user->setPassword($_POST['newPw']);
        $response = $user->changePassword($pdo, $_SESSION['id']);
        if(isset($response) && !is_object($response)){
            $titre = "OOPS !";
            $message = "Le changement de votre mot de passe n'a pas abouti.";
            $next = 'home.php';
            displayMessage($titre, $message, $next);
            die();
        }else{
            $titre = "Mise à jour effectuée";
            $message = "Votre nouveau mot de passe est bien actif.";
            $next = 'home.php';
            displayMessage($titre, $message, $next);
        }
    }else{
        $titre = "Vérifiez votre saisie !";
        $message = "Vous devez renseigner votre mot de passe actuel.";
        $next = '';
        displayMessage($titre, $message, $next);
        die();
    }
}else{

}
require_once '../html/userChangePw.html';
require_once '../html/footer.html';