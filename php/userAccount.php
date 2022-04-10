<?php
require_once 'sessionManager.php';
require_once '../model/User.php';

if (!isset($_SESSION['connection'])){
    header('Location: '. 'userConnect.php');
}

if (!isset($_POST['from']) || $_POST['from'] != "userAccount.php"){
    $user = new User();
    $response =  $user->findId($pdo, $_SESSION['id']); 
    if(isset($response) && !is_object($response)){
        $titre = 'Problème d\'accès à votre compte.';
        $next = 'home.php';
        displayMessage($titre, $response, $next);
        die();
    }
}else{
    // update general info from account in DB
    $user = new User();
    $user->setName($_POST['name']);
    $user->setFirstname($_POST['firstname']);
    $user->setEmail($_POST['email']);
    $user->setRole($_POST['role']);
    $response = $user->update($pdo, $_SESSION['id']);
    if(isset($response) && !is_object($response)){
      $titre = 'Problème de mise à jour de votre compte.';
      $next = 'home.php';
      displayMessage($titre, $response, $next);
      die();
    }else{
      $titre = 'Mise à jour réussie.';
      $message = "";
      $next = 'home.php';
      displayMessage($titre, $message, $next);
    }
}

require_once '../view/userAccount.php';
?>