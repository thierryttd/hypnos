<?php
require_once 'sessionManager.php';
require_once '../model/Booking.php';

if (!isset($_SESSION['connection'])){
  header('Location: '. 'userConnect.php');
}

if (isset($_POST['from']) && $_POST['from'] === 'bookingSearch.php'){
  $_SESSION['validLastNight'] = $_POST['lastNight'];
  $_SESSION['validFirstNight'] = $_POST['firstNight'];
  $_SESSION['validSuiteId'] = $_POST['idSuite'];
  $_SESSION['price'] = $_POST['price'];
} 

// calculate bill of booking
$datediff = strtotime($_SESSION['validLastNight']) - strtotime($_SESSION['validFirstNight']);
$bill = round($datediff / (60 * 60 * 24)) * $_SESSION['price'];
// in case of only one single night
if ($bill == 0){
  $bill = $_SESSION['price'];
}

$booking = new Booking();
$booking->setUser_id($_SESSION['id']);
$booking->setSuite_id($_SESSION['validSuiteId']);
$booking->setBegin($_SESSION['validFirstNight']);
$booking->setEnd($_SESSION['validLastNight']);
$booking->setBill($bill);

$response = $booking->create($pdo);
if(isset($response)){
  $titre = 'OOPS !.';
  $next = 'home.php';
  $message = $response;
  displayMessage($titre, $message, $next);
  die();
}else{
    $titre = "Votre réservation est enregistrée.";
    $message = "Une confirmation par mail vous sera adressée.";
    $next = "userBookingList.php";
    displayMessage($titre, $message, $next);
}

require_once '../html/footer.html';