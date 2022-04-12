<?php
if (!isset($response) || !isset($_GET['origin'])){
  die();
}
echo "<div class='container-fluid jumbo'>";
  echo "<div class='row custom rounded m-2 justify-content-center'>";
      echo "<div class='col mt-3 text-align-center'>";
        echo "<h5>Sélectionnez un établissement</h5>";
      echo "</div>";
  echo "</div>";
echo "</div>";
static $lineCount = 0;
$lignCss = '';
$cssLine = '';
var_dump($response);
foreach ($response as $hotel) {
  $cssLine = "jumbo-line";
  echo "<div class='row align-items-center'>";
      echo "<div class='col-6 col-sm-3 text-center align-middle " . $cssLine . "'>";  
          echo "<div class='' id='Ref-" .$lineCount . "'".">". $hotel['name']."</div>";
      echo "</div>";
      echo "<div class='col-5 col-sm-3 text-center align-middle " . $cssLine . "'>";  
          echo "<div class='' id='Sta-" .$lineCount . "'".">". $hotel['city']."</div>";
      echo "</div>";
      echo "<div class='col-6 col-sm-3 text-center align-middle " . $cssLine . "'>";  
          echo "<div class='' id='Sta-" .$lineCount . "'".">". $hotel['zipcode']."</div>";
      echo "</div>";
      echo "<div class='col-5 col-sm-1 text-center align-middle'>";   
          echo "<form action='" . $action . "' method='POST'>";
            echo "<input type='hidden' name ='hotel' id='hotel' value=" . $hotel['id'] . ">";
            echo "<input type='hidden' name ='from' id='from' value='" . $_GET['origin'] . "'>";
            echo "<button type='submit' class='btn btn-primary'>...</button>";
          echo "</form>";
      echo "</div>";
  echo "</div>";
  $lineCount++;
}
echo "</div>";