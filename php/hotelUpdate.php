<?php
require_once 'sessionManager.php';

require_once '../html/header.html';
require_once 'message.php';

require_once '../model/Hotel.php';
require_once '../model/User.php';
require_once '../model/Suite.php';

if (!isset($_SESSION['connection'])){
  header('Location: '. 'userConnect.php');
}
$disabled = "disabled";
if ($_SESSION['role'] === 'ADM'){
  if (isset($_POST['hotel'])){
      // read hotel from DB
      $hotel = new Hotel();
      $hotel->findId($pdo, $_POST['hotel']);
      if(isset($response) && !is_object($response)){
        $titre = "Problème d'accès à l\établissement.";
        $next = 'home.php';
        displayMessage($titre, $response, $next);
        die();
      }

      // Delete action anticipation, check if hotel has suite
      // if yes no delete permitted
      $suite = new Suite();
      $response = $suite->findByHotel($pdo, $_POST['hotel']);
      if(isset($response) && !is_array($response)){
        $titre = "Problème d'accès à l'établissement.";
        $next = 'home.php';
        displayMessage($titre, $response, $next);
        die();
      }else{  
        if (count($response) === 0){
          $disabled = "";
        }
      }

      // get manager email for possible affectation changing
      $user = new User();
      $response =  $user->findId($pdo, $hotel->getManager()); 
      if(isset($response) && !is_object($response)){
          $titre = "Problème d'accès au compte du manager.";
          $next = '';
          displayMessage($titre, $response, $next);
          die();
      }      
  }else{
      // Update action detected
      // Before updating check if email manager is existing 
      $user = new User();
      $response= $user->findEmail($pdo, $_POST['emailmanager']);
      if(isset($response) && !is_object($response)){
        $titre = "Vérifiez votre saisie.";
        $next = 'home.php';
        $message = "L'email indiqué ne correspond à aucun manager.";
        displayMessage($titre, $message, $next);
        die();
      }else{
      //  user exist so have to check if role = MNG
        if ($user->getRole() !== "MNG"){
          $titre = 'Vérifiez votre saisie.';
          $next = 'home.php';
          $message = "L'email indiqué ne correspond pas à un manager.";
          displayMessage($titre, $message, $next);
          die();
        }
      }
      $hotel = new Hotel();
      $hotel->hydrate($_POST);
      $hotel->setManager($user->getId());
      $response = $hotel->update($pdo, $_POST['idUpdate']);
      if(isset($response) && !is_object($response)){
          $titre = "Problème lors de la mise à jour de l'établissement.";
          $next = 'home.php';
          displayMessage($titre, $response, $next);
          die();
      }else{
          $titre = 'Opération réussie.';
          $message = "L'établissement est bien mis à jour.";
          $next = 'home.php';
          displayMessage($titre, $message, $next);
          die();
      }
  }
}

require_once '../view/hotelUpdate.php';