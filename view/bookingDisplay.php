<div class="container-fluid">
    <div class="row">
    <div class="col-md-7">
    <?php
    echo "<div class='col jumbo mt-3'>";
    if (!isset($suites)){
      die();
    }
    foreach ($suites as $suite){
            echo "<img src='" . $suite['featured'] . "' class='mb-3 img-fluid rounded'";
            echo "<h5>" . $suite['title'] . "</p5>";
            echo "<h4>Période de réservation</h4>";
            echo "<p>" . "Du : ". $_POST['firstNight'] . " au " . $_POST['lastNight'] ."</p>";
            // echo "<a href='suiteGallery.php?suite=" .$suite['id'] .  "'>Détail</a>";
            echo "<div class='col col-md-2 text-center align-middle'>";   
            // echo "<div class='' id='Pri-" .$lineCount . "'".">". $hotel['id']."</div>";
            echo "<form action='" . $action . "' method='POST'>";
              echo "<input type='hidden' name ='idSuite' id='idSuite' value=" . $suite['id'] . ">";
              echo "<input type='hidden' name ='price' id='price' value=" . $suite['price'] . ">";
              echo "<input type='hidden' name ='firstNight' id='firstNight' value=" . $_POST['firstNight'] . ">";
              echo "<input type='hidden' name ='lastNight' id='lastNight' value=" . $_POST['lastNight'] . ">";
              echo "<input type='hidden' name ='from' id='from' value='bookingSearch.php'>";
              $_SESSION['hotel'] = $suite['hotel'];
              echo "<button type='submit' class='btn btn-primary' " . $disabled . ">Réserver</button>";
            echo "</form>";
            echo "</div>";
            // echo "<hr>";
    }
    echo "</div>";
    ?>
</div>
    </div>
</div>