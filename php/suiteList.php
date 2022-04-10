<?php
require_once 'sessionManager.php';
require_once '../model/Suite.php';

if(!isset($_POST['hotel'])){
  header('Location: '. 'home.php');
}

$disabled = "";
$action = "";
if (!isset($_SESSION['connection'])){
  // header('Location: '. 'userConnect.php');
  $suite = new Suite();
  $suites = $suite->findByHotel($pdo, $_POST['hotel'] );
  $action ="" ;
  $disabled = "disabled";
  if(isset($suites) && !is_array($suites)){
    $titre = 'Problème d\'accès à la liste des suites.';
    $next = '';
    displayMessage($titre, $suites, $next);
    die();
  }
} 

// if (isset($_SESSION['connection']) && ( $_SESSION['role'] === 'ADM' || $_SESSION['role'] === 'MNG') ){
if (isset($_SESSION['connection']) && $_SESSION['role'] === 'MNG' ){
  // Select all suite depending on selected hotel
  if ($_SESSION['role'] === 'MNG'){
    $suite = new Suite();
    $suites = $suite->findByHotel($pdo, $_POST['hotel'] );

    switch ($_POST['from']){
      case 'upd':
        $disabled = "";
        $action = 'suiteUpdate.php';
        break;
      case 'gal':
        $disabled = "";
        $action = 'suiteGallery.php';
        break;
      case 'add':
        // in this case button detail on suite is disabled
        $disabled = "disabled";
        $action = 'suiteCreate.php';
        break;
    }
  // }else{
  //   header('Location: ' . 'indexsuiteCreate.php');
  }

  if(isset($suites) && !is_array($suites)){
      $titre = 'Problème d\'accès à la liste des suites.';
      $next = '';
      displayMessage($titre, $suites, $next);
      die();
  }else{
    if (count($suites) === 0 && $_SESSION['role'] === 'MNG'){
      header('Location: ' . 'suiteCreate.php?hotel=' . $_POST['hotel'] );
    }
  } 

}
 // Block for list of hotel suites 
 require_once '../view/suiteList.php';

//  Possibility add suites for manager (add condition yet missing)

 echo "<form action='" . $action . "' method='GET'>";
      echo "<input type='hidden' name ='hotel' id='hotel' value=" . $_POST['hotel'] . ">";
      echo "<input type='hidden' name ='from' id='from' value='suiteList.php'>";
      echo "<button type='submit' class='btn btn-primary' " . $disabled . ">Ajouter une suite</button>";
  echo "</form>";

require_once '../html/footer.html';
