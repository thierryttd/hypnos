<?php
require_once 'sessionManager.php';
require_once '../model/User.php';

if (isset($_SESSION['connection']) && isset($_SESSION['validSuiteId'])){
        header('Location: '. 'bookingCreate.php');
}

if (isset($_POST['password'])){
    // check if email knowned in DB and password correct
    $user = new User();
    $response =  $user->findEmail($pdo, $_POST['email']); 
    if(isset($response) && !is_object($response)){
        $titre = 'Vérifiez votre saisie.';
        $next = 'home.php';
        displayMessage($titre, $response, $next);
        die();
    }
    if (password_verify($_POST['password'], $user->getPassword())) {
        $_SESSION['connection'] = true;
        $_SESSION['id'] = $user->getId();
        $_SESSION['name'] = $user->getName();
        $_SESSION['firstname'] = $user->getfirstname();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['role'] = $user->getRole();
        $titre = 'Vous êtes bien connecté.';
        $message = "Bienvenue " .$user->getfirstname();
        if (isset($_SESSION['validSuiteId'])){
            $next = 'bookingCreate.php';
        }else{
            $next = 'home.php';
        }
        displayMessage($titre, $message, $next);
    } else {
        $titre = 'Vérifier votre mot de passe.';
        $message = "Connexion impossible.";
        $next = '';
        displayMessage($titre, $message, $next);
    }
}
require_once '../html/userConnect.html';
require_once '../html/footer.html';