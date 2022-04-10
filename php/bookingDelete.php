<?php
require_once 'sessionManager.php';

if (!isset($_SESSION['connection'])){
  header('Location: '. 'userConnect.php');
}

if ($_SESSION['connection'] === true && isset($_POST['from'])){
  // delete selected booking
  $sql = "DELETE FROM bookings WHERE user_id = :user AND suite_id = :suite AND begin = :begin";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':user', $_SESSION['id']);
  $stmt->bindValue(':suite', $_POST['suiteBookingDelete']);
  $stmt->bindValue(':begin', $_POST['beginBookingDelete']);
  try {
    $stmt->execute();
    $titre = 'Votre réservation est bien annulée.';
    $message = '';
    $next = 'userBookingList.php';
    displayMessage($titre, $message, $next);
  }catch (Exception $e){
    $titre = 'Annulation de votre réservation impossible.';
    $message = 'Contacter l\'hôtel pour plus d\'information';
    // $message = $e->getMessage();
    $next = 'home.php';
    displayMessage($titre, $message, $next);
  }
}
require_once '../html/footer.html';
