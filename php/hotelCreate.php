<?php
require_once 'sessionManager.php';

require_once '../html/header.html';
require_once '../model/Hotel.php';
require_once '../model/User.php';

if(!isset($_SESSION['connection'])){
        header('Location: '. 'userConnect.php');
}

if (isset($_POST['email'])){
    // Check user with type in email exists in DB
    $user = new User();
    $response =  $user->findEmail($pdo, $_POST['email']); 
    if(isset($response) && !is_object($response)){
        $titre = "L'email du manager est inconnu.";
        $next = '';
        displayMessage($titre, $response, $next);
        die();
    }
    // check user has MNG role
    if ($user->getRole() != 'MNG'){
        $titre = "L'établissement ne peut pas être affecté";
        $message = "L'utilisateur ne possède pas le rôle manager";
        $next = '';
        displayMessage($titre, $message, $next);
    }else{
        // insert hotel in DB
        $hotel = new Hotel();
        $hotel->hydrate($_POST);
        $hotel->setManager($user->getId());
        // var_dump($_POST);
        $response = $hotel->create($pdo);
        if(isset($response)){
            $titre = "Problème lors de la création de l'établissement.";
            $next = 'home.php';
            displayMessage($titre, $response, $next);
            die();
        }else{
            $titre = 'Opération réussie.';
            $message = "L'établissement est bien créé.";
            $next = 'home.php';
            displayMessage($titre, $message, $next);
        }
    }
}
require_once '../html/hotelCreate.html';
require_once 'message.php';
require_once '../html/footer.html';