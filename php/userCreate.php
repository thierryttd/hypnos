<?php
require_once 'sessionManager.php';
require_once '../model/User.php';

if (isset($_POST['password'])){
    // insert account in DB
    $user = new User();
    $user->hydrate($_POST);
    $user->setRole('   ');
    $response = $user->create($pdo);
    if(isset($response)){
        $titre = 'Problème lors de la création de votre compte.';
        $next = 'home.php';
        if (strpos($response, 'Duplicate')){
            $message = 'L \'adresse email indiquée existe déjà dans notre base.';
        }else{
            $message = $response;
        }
        displayMessage($titre, $message, $next);
        die();
    }else{
        $titre = 'Opération réussie.';
        $message = "Votre compte est bien créé.";
        $next = 'home.php';
        displayMessage($titre, $message, $next);
    }
}
require_once '../html/userCreate.html';
require_once '../html/footer.html';