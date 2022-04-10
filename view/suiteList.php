<div class="col-md-7">
<?php
    if (!isset($suites)){
    die();
}
echo "<div class='col jumbo mt-3'>";
foreach ($suites as $suite){
    echo "<img src='" . $suite['featured'] . "' class='mr-3 img-fluid' width='100' height='100' ";
    echo "<h5>" . $suite['title'] . "</h5>";
    echo "<p>" . $suite['description'] . "</p>";
    echo "<p>" . $suite['price'] . "€ la nuité.</p>";
    echo "<div class='col'>";
        echo "<a href='suiteGallery.php?suite=" .$suite['id'] .  "'  class=' " . $cssDisabled . "'>Détail</a>";
        echo "<br>";
        echo "<a href='bookingPeriod.php?suite=" .$suite['id'] .  "' class=' " . $cssDisabled . "'>Réservez</a>";
    echo "</div>";
        
    echo "<div class='col col-md-2 text-center align-middle'>";   
        if ($disabled === ""){
            echo "<form action='" . $action . "' method='POST'>";
                echo "<input type='hidden' name ='idSuite' id='idSuite' value=" . $suite['id'] . ">";
                echo "<input type='hidden' name ='hotel' id='hotel' value=" . $suite['hotel'] . ">";
                echo "<input type='hidden' name ='from' id='from' value='suiteList.php'>";
                echo "<button type='submit' class='btn btn-primary' " . $disabled . ">...</button>";
            echo "</form>";
        }
    echo "</div>";
    
    echo "<hr>";
}
echo "</div>";
?>
</div>