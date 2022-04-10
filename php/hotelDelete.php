<?php
require_once 'sessionManager.php';

require_once '../html/header.html';
require_once 'message.php';
require_once '../model/Hotel.php';

if (!isset($_SESSION['connection'])){
  header('Location: '. 'userConnect.php');
}

  if ($_SESSION['role'] === 'ADM'){
    if (isset($_POST['hotelDelete'])){
        // delete hotel from DB
        $hotel = new Hotel();
        $hotel->delete($pdo, $_POST['hotelDelete']);
        if(isset($response)){
          $titre = "L'établissement n'a pu être supprimé";
          $next = 'home.php';
          displayMessage($titre, $response, $next);
          die();
       }else{
        $titre = "Opération réussie !";
        $next = 'home.php';
        $message ="L'établissement est bien supprimé.";
        displayMessage($titre, $message, $next);
       }
    }else{
        $titre = "Problème d'accès à la donnée hotel.";
        $message = '';
        $next = '';
        displayMessage($titre, $message, $next);
    }
}
    require_once '../html/footer.html';