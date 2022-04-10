<?php
require_once 'sessionManager.php';
require_once '../html/header.html';
require_once 'message.php';
require_once '../model/Suite.php';
require_once '../model/Hotel.php';

if (!isset($_SESSION['connection'])){
    header('Location: '. 'userConnect.php');
}

if ($_SESSION['role'] !== 'MNG' ){
    header('Location: '. 'home.php');
}

if (isset($_POST['title'])){
    $suite = new Suite();
    $suite->hydrate($_POST);
    $suite->setFeatured(' ');
    $idSuite = $suite->create($pdo);
    $_SESSION['currentSuite'] = $idSuite;
    header('Location: '. 'suiteGallery.php?suite=' . $idSuite );
}else{
    if (isset($_GET['hotel'])){
        $hotel = new Hotel();
        $hotel->findId($pdo, $_GET['hotel']);
        if(isset($response) && !is_object($response)){
            $titre = 'Problème d\'accès à l\établissement.';
            $next = 'home.php';
            displayMessage($titre, $response, $next);
            die();
        }
    }else{
        $titre = "OOPS !";
        $next = 'home.php';
        $message = "Problème d'accès à l'établissement.";
        displayMessage($titre, $message, $next);
        die();
    }
}
require_once '../view/suiteCreate.php';