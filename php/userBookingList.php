<?php
require_once 'sessionManager.php';

require_once '../model/Booking.php';

if (!isset($_SESSION['connection'])){
  header('Location: '. 'userConnect.php');
}

// read bookings from DB
$booking = new Booking();
$response = $booking->findByUser($pdo, $_SESSION['id']);
if(isset($response) && !is_array($response)){
  $titre = "Problème d'accès aux réservations.";
  $next = 'home.php';
  displayMessage($titre, $response, $next);
  die();
}
if (count($response) === 0){
  $titre = 'Historique de vos réservations.';
  $message = 'Aucune réservation n\'a été trouvée.';
  $next = 'home.php';
  displayMessage($titre, $message, $next);
}else{
  $disabled = "";
  displayBookings ($response, $disabled);
}

require_once '../html/footer.html';

function displayBookings ($bookings, $disabled){
  static $lineCount = 0;
  $lignCss = '';
  $cssLine = '';
  foreach ($bookings as $booking) {
    echo "<div class='row align-items-center'>";
        echo "<div class='col col-md-2 text-center align-middle'>";  
          echo "<div class='' id='Ref-" .$lineCount . "'".">". $booking['name']."</div>";
        echo "</div>";

        echo "<div class='col col-md-2 text-center align-middle'>";  
          echo "<div class='' id='Ref-" .$lineCount . "'".">". $booking['title']."</div>";
        echo "</div>";
    echo"</div>";
    echo "<div class='row align-items-center'>";
        echo "<div class='col-5 col-md-2 text-center align-middle'>";  
          echo "<div class='' id='Sta-" .$lineCount . "'"."> DU : ". $booking['begin']."</div>";
        echo "</div>";

        echo "<div class='col-5 col-md-2 text-center align-middle'>";   
          echo "<div class='' id='Pri-" .$lineCount . "'"."> AU : ". $booking['end']."</div>";
        echo "</div>";

        echo "<div class='col-2 col-md-2 text-center align-middle'>";   
          echo "<div class='' id='Pri-" .$lineCount . "'".">". $booking['bill']."€</div>";
        echo "</div>";
    echo"</div>";
    echo "<div class='row align-items-center'>";
        echo "<div class='col col-md-2 text-center align-middle'>";   
            echo "<form action='suiteGallery.php' method='POST'>";
              echo "<input type='hidden' name ='idSuite' id='idSuite' value=" . $booking['suite_id'] . ">";
              echo "<input type='hidden' name ='from' id='from' value='userBookingList.php'>";
              echo "<button type='submit' class='btn btn-primary'>...</button>";
            echo "</form>";
        echo "</div>";
        echo "<div class='col col-md-2 text-center align-middle'>";
            echo "<form action='bookingDelete.php' method='POST'>";
              echo "<input type='hidden' name ='suiteBookingDelete' id='suiteBookingDelete' value=" . $booking['suite_id'] . ">";
              echo "<input type='hidden' name ='beginBookingDelete' id='beginBookingDelete' value=" . $booking['begin'] . ">";
              echo "<input type='hidden' name ='from' id='from' value='userBookingList.php'>";
              $today = date("Y-m-d");
              $datediff = strtotime($booking['begin']) - strtotime($today);
              $nbDay = round($datediff / (60 * 60 * 24));
              if ($nbDay < 3){
                $disabled = "disabled";
              }else{
                $disabled = "";
              }
              echo "<button type='submit' class='btn btn-primary'" . $disabled . ">Annuler</button>";
            echo "</form>";
        echo "</div>";
    echo "</div>";
    $lineCount++;
  }
}
