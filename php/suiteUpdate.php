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

if (isset($_POST['from']) && ($_POST['from']) === "suiteUpdate.php"){
        $suite = new Suite();
        $suite->hydrate($_POST);
        $suite->update($pdo, $_POST['suite']);
        $_SESSION['currentSuite'] = $_POST['suite'];
        header('Location: '. 'suiteGallery.php');
}else{
    if (isset($_POST['idSuite']) && isset($_POST['hotel'])){
        $suite = new Suite();
        $suite->findId($pdo, $_POST['idSuite']);
    }
}

require_once '../view/suiteUpdate.php';
