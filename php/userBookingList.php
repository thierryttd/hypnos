<?php
require_once 'sessionManager.php';

if (!isset($_SESSION['connection'])){
  header('Location: '. 'userConnect.php');
}
// if ($_SESSION['connection'] === true){
  // read bookings from DB
  $sql = "SELECT * from bookings WHERE user_id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $_SESSION['id']);

  try {
      $stmt->execute();
      $bookings = $stmt->fetchAll();
      if (count($bookings) === 0){
        $titre = 'Historique de vos réservations.';
        $message = 'Aucune réservation n\'a été trouvée.';
        $next = 'home.php';
        displayMessage($titre, $message, $next);
      }else{
        // if firstNight booking is more than three days away from today
        // cancelling is permitted
        // $datediff = strtotime($_SESSION['validLastNight']) - strtotime($_SESSION['validFirstNight']);
        $disabled = "";
        displayBookings ($bookings, $disabled);
      }
  }catch (Exception $e){
      $titre = 'Problème d\'accès à votre compte.';
      $message = $e->getMessage();
      $next = '';
      displayMessage($titre, $message, $next);
  }
// }
require_once '../html/footer.html';

function displayBookings ($bookings, $disabled){
  static $lineCount = 0;
    $lignCss = '';
    $cssLine = '';
      foreach ($bookings as $booking) {
              
        echo "<div class='row align-items-center'>";
            
            echo "<div class='col col-md-2 text-center align-middle'>";  
                echo "<div class='' id='Ref-" .$lineCount . "'".">". $booking['suite_id']."</div>";
            echo "</div>";
            echo "<div class='col col-md-2 text-center align-middle'>";  
                echo "<div class='' id='Sta-" .$lineCount . "'".">". $booking['begin']."</div>";
            echo "</div>";
            echo "<div class='col col-md-2 text-center align-middle'>";   
                echo "<div class='' id='Pri-" .$lineCount . "'".">". $booking['end']."</div>";
            echo "</div>";
            echo "<div class='col col-md-2 text-center align-middle'>";   
                echo "<div class='' id='Pri-" .$lineCount . "'".">". $booking['bill']."</div>";
            echo "</div>";
            echo "<div class='col col-md-2 text-center align-middle'>";   
                echo "<form action='suiteGallery.php' method='POST'>";
                  echo "<input type='hidden' name ='idSuite' id='idSuite' value=" . $booking['suite_id'] . ">";
                  echo "<input type='hidden' name ='from' id='from' value='userBookingList.php'>";
                  echo "<button type='submit' class='btn btn-primary'>...</button>";
                echo "</form>";
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
