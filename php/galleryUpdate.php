<?php
require_once 'sessionManager.php';
require_once '../model/Suite.php';
require_once '../model/Gallery.php';
require_once 'message.php';

if (!isset($_SESSION['connection'])){
    header('Location: '. 'userConnect.php');
}

if (!isset($_POST['postString'])){
    die();
}

// - is separator for featured image and , is separator for images to cancel
$data = explode("-", $_POST['postString']);
$featured = $data[0];
$data1 = rtrim($data[1], ",");
$galleries = explode(",",$data1);


if ($featured !== ""){
    // Update suite : new source for featured image
    $suite = new Suite();
    $response = $suite->findId($pdo, $_SESSION['currentSuite']);
    if(!is_object($response)){
        $titre = 'OOOPS !';
        $message = "PROBLEME LECTURE SUITE.";
        $next = 'home.php';
        displayMessage($titre, $message, $next);
        die();
    }

    $gallerie = new Gallery();
    $response = $gallerie->findId($pdo, $featured);
    if(!is_object($response)){
        $titre = 'OOOPS !';
        $message = "PROBLEME LECTURE GALLERIE IMAGES.";
        $next = 'home.php';
        displayMessage($titre, $message, $next);
        die();
    }
    
    $suite->setFeatured($gallerie->getSource());
    $response = $suite->update($pdo, $suite->getId());
    if(!is_object($response)){
        $titre = 'OOOPS !';
        $message = "Probleme de mise à jour suite.";
        $next = 'home.php';
        displayMessage($titre, $message, $next);
        die();
    }
}

// Delete all posting galleries id
if ($galleries[0] !== ""){
    $in = "";
    for ($i=0; $i < count($galleries); $i++){
        $in = $in . $galleries[$i] . ", ";
    }
    $in = "(" . rtrim($in, ', ') . ")";
    // $sql = "DELETE FROM galleries WHERE id in " . $in;
    $gallerie = new Gallery();
    $response = $gallerie->delete($pdo, $in);
    if(isset($response)){
        $titre = 'OOOPS !';
        $message = "Problème lors de la suppression des images.";
        $next = 'home.php';
        displayMessage($titre, $message, $next);
        die();        
    }
}

$titre = 'Opération réussie!';
$message = "Toutes les actions demandées ont été correctement effectuées.";
$next = 'suiteGallery.php?suite=' . $_SESSION['currentSuite'];
displayMessage($titre, $message, $next);