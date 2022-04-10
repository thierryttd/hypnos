<?php
require_once 'sessionManager.php';
require_once '../model/User.php';
require_once '../model/Hotel.php';

if (!isset($_SESSION['connection'])){
  header('Location: '. 'userConnect.php');
}

if (isset($_POST['from']) && $_POST['from'] === 'userList.php'){
    // read account from DB
    $user = new User();
    $response =  $user->findId($pdo, $_POST['id']); 
    if(isset($response) && !is_object($response)){
        $titre = 'Problème d\'accès au compte.';
        $next = 'home.php';
        displayMessage($titre, $response, $next);
        die();
    }
}else{
   // updating user's role
  if (isset($_POST['newRole']) && isset($_POST['role']) && is_integer(intval($_POST['id']))){

    // if changing manager role
    //  verify no hotel has this person as manager
    if (($_POST['role'] !== $_POST['newRole']) && $_POST['role'] === "MNG" ){
      $hotel = new Hotel();
      $response = $hotel->findByManager($pdo, $_POST['id']);
      if(is_array($response)){
        if (count($response) > 0 ){
            $titre = "CE MANAGER GERE AU MOINS UN HOTEL.";
            $message = "Réaffecter chaque hotel ayant ce manager avant de modifier le role.";
            $next = 'home.php';
            displayMessage($titre, $message, $next);
            die();
        }
      }else{
          $titre = "OOPS !";
          $next = 'home.php';
          displayMessage($titre, $response, $next);
          die();
      }
    }
    // Get user data and apply role changing
    $user = new User();
    $response =  $user->findId($pdo, $_POST['id']); 
    if(isset($response) && !is_object($response)){
        $titre = "Problème d'accès au compte.";
        $next = "home.php";
        displayMessage($titre, $response, $next);
        die();
    }
    switch ($_POST['newRole']){
        case 1:
            $newRole = "   ";
            break;
        case 2:
            $newRole = "MNG";
            break;
        case 3:
            $newRole = "ADM";
            break;
        default:
          $titre = "OOPS !";
          $next = 'home.php';
          $message = "Problème de reconnaissance du rôle.";
          displayMessage($titre, $message, $next);
          die();
    }
    $user->setRole($newRole);
    $response = $user->update($pdo, $user->getId());
    if(isset($response) && !is_object($response)){
      $titre = 'Problème de mise à jour du compte.';
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
}

require_once '../view/userRole.php';
require_once '../html/footer.html';