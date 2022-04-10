<?php
require_once 'sessionManager.php';
require_once 'message.php';

require_once '../model/Hotel.php';
require_once '../model/Suite.php';
require_once '../model/Booking.php';

if (!isset($_POST['firstNight'])){
    header('Location: '. 'home.php');
}

// Search for existing booking corresponding to required period
$booking = new Booking();
$response = $booking->findOccupied($pdo, $_POST['firstNight'], $_POST['lastNight'] );
if(isset($response) && !is_array($response)){
    $titre = "Problème d'accès aux réservations.";
    $next = 'home.php';
    displayMessage($titre, $response, $next);
    die();
}

// Create array with occupied suite key
$keyBooking = [];
foreach ($response as $booking){
    $keyBooking [] = $booking['suite_id'];
}

// get all the existing suites
$suite = new Suite();
$response = $suite->findAll($pdo);
if(isset($response) && !is_array($response)){
    $titre = "Problème d'accès aux suites.";
    $next = 'home.php';
    displayMessage($titre, $response, $next);
    die();
}

// Check for each existing suite if presents in liste of occupied suites
// if not, display the suite for possible booking
// only the one selected if allready done
// if no previous selected suite, all suites are displayed
$suites = [];

foreach ($response as $suite) {
    if (!in_array($suite['id'], $keyBooking)){
        if (isset($_SESSION['currentSuite'])){
            if ($suite['id'] === $_SESSION['currentSuite']){
                $suites [] = $suite;
                $action = 'bookingCreate.php';
                $disabled = '';
            }
        }else{
            $suites [] = $suite;
            $action = 'bookingCreate.php';
            $disabled = '';
        }
    }
}

if (count($suites) === 0){
    $titre = 'OOPS !';
    $next = 'home.php';
    $message = "Nous n'avons pas trouvé de disponibilité pour cette période.";
    displayMessage($titre, $message, $next);
    die();
}
require_once '../view/bookingDisplay.php';

require_once '../html/footer.html';
