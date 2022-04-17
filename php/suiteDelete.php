<?php
require_once 'sessionManager.php';
require_once 'message.php';

require_once '../model/Suite.php';
require_once '../model/Gallery.php';
require_once '../model/Booking.php';

if (!isset($_SESSION['connection'])){
    header('Location: '. 'userConnect.php');
}

if ( !(isset($_POST['suiteDelete']) && is_integer(intval($_POST['suiteDelete']))) ){
    $titre = 'OOPS !';
    $next = 'home.php';
    $message = "Problème d'identification de la suite.";
    displayMessage($titre, $message, $next);
    die();
}

// verify that there is no upcoming booking for the targeted suite to delete
$booking = new Booking();
$response = $booking->findUpcoming($pdo,$_POST['suiteDelete'], date("Y-m-d") );
if(is_array($response)){
    if (count($response) > 0 ){
        $titre = "SUPPRESSION DE LA SUITE IMPOSSIBLE !";
        $message = "Il y a au moins une réservation à venir pour cette suite.";
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
// get source image file name to unlink them after galleries suppressed
$gallerie = new Gallery();
$imageFiles = $gallerie->findBySuite($pdo, $_POST['suiteDelete']);

// Delete all  galleries linked to selected suite
$response = $gallerie->deleteBySuite($pdo, $_POST['suiteDelete']);
if (isset($response)){
    $titre = 'Problème suppression gallerie images.';
    $next = 'home.php';
    displayMessage($titre, $response, $next);
    die();
}

// no galleries linked to suite so, deleting suite
$suite = new Suite();
$response = $suite->delete($pdo, $_POST['suiteDelete']);
if (isset($response)){
    $titre = 'Problème suppression de la suite.';
    $next = 'home.php';
    displayMessage($titre, $response, $next);
    die();
}

// unlink images files 
$error = 0;
foreach ($imageFiles as $imageFile){
    $delete = unlink($imageFile['source']);
    if(!$delete){
        $error++;
    }
}
if ($error > 0)  {
    $titre = 'OOPS !';
    $next = 'home.php';
    $message = "Problème, " . $error . " fichier images n'ont pu être supprimé";
    displayMessage($titre, $message, $next);
    die();
} 

$titre = 'Suppression effectuée.';
$next = 'home.php';
$message = "La suite et ses images ont été supprimées.";
displayMessage($titre, $message, $next);
die();