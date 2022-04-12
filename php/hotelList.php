<?php
require_once 'sessionManager.php';
require_once '../html/header.html';
require_once 'message.php';
require_once '../model/Hotel.php';

if (isset($_SESSION['connection']) && ( $_SESSION['role'] === 'ADM' || $_SESSION['role'] === 'MNG') ){
  $cssDisabled = "cssDisabled";
  // Select all hotels in DB
  if ($_SESSION['role'] === 'MNG') {
    
    $action = 'hotelDisplay.php';
    $hotel = new Hotel();
    $response =  $hotel->findByManager($pdo, $_SESSION['id']); 
    responseCheck($response, $action);
  }else{
    $action = 'hotelUpdate.php';
    $hotel = new Hotel();
    $response =  $hotel->findAll($pdo); 
    responseCheck($response, $action);
  }
}else{
    $cssDisabled = "";
    $hotel = new Hotel();
    $response =  $hotel->findAll($pdo); 
    $action = "hotelDisplay.php";
    responseCheck($response, $action);
}

function responseCheck ($response, $action){
  if(isset($response) && !is_array($response)){
    $titre = 'Problème d\'accès à la liste des établissements.';
    $next = '';
    displayMessage($titre, $response, $next);
    die();
  }
}

require_once '../view/hotelList.php';
require_once '../html/footer.html';