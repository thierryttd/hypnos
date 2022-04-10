<?php
require_once 'sessionManager.php';

require_once '../html/header.html';
require_once '../model/Hotel.php';
require_once '../model/Suite.php';

if(!isset($_POST['hotel'])){
    header('Location: '. 'home.php');
}

// Get detailed information from selected hotel
if (isset($_POST['hotel'])){
    $_SESSION['hotel'] = $_POST['hotel'];
    $hotel = new Hotel();
    $response = $hotel->findId($pdo, $_POST['hotel']);
    if(isset($response) && !is_object($response)){
        $titre = 'Problème d\'accès à l\établissement.';
        $next = 'home.php';
        displayMessage($titre, $response, $next);
        die();
     }
}

// Get list of the hotel suites
$suite = new Suite();
$suites = $suite->findByHotel($pdo, $_POST['hotel'] );
$action ="" ;
$disabled = "disabled";
if(isset($suites) && !is_array($suites)){
    $titre = 'Problème d\'accès à la liste des suites.';
    $next = '';
    displayMessage($titre, $suites, $next);
    die();
}else{
    if (count($suites) === 0){
        if (isset($_SESSION['connection']) && $_SESSION['role'] === 'MNG') {
            $titre = "Cet hôtel ne dispose pas encore de suite.";
            $next = "suiteCreate.php?hotel=" . $_POST['hotel'];
            $message = "Vous allez pouvoir créer la première !";
            displayMessage($titre, $message, $next);
            die();
        }else{
            $titre = "OOPS !";
            $next = "home.php";
            $message = "Cet hôtel ne dispose pas encore de suite.";
            displayMessage($titre, $message, $next);
            die();
        }

    }
}

$action= "hotelList.php?origin=home";
?>
<div class="row sticky-top">
    <div class="col-6 col-md-4">
        <div class="row rounded m-2 justify-content-center">
            <?php
            echo "<div class='col mt-3 text-align-center'>";
            ?>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="row custom rounded m-2 justify-content-center">
            <?php
            echo "<div class='col mt-3 text-align-center'>";
            echo "<form action='" . $action . "' method='POST'>";
            echo "<button type='submit' class='btn btn-primary'>Retour liste établissements</button>";
            echo "</form>";
            ?>
            </div>
            <?php

            if (isset($_SESSION['connection']) && $_SESSION['role'] === 'MNG') {
                echo "<div class='col mt-3 text-align-center'>";
                $cssDisabled = "cssDisabled";
                $action = "suiteCreate.php";
                $disabled="";
                echo "<form action='" . $action . "' method='GET'>";
                echo "<input type='hidden' name ='hotel' id='hotel' value=" . $_POST['hotel'] . ">";
                echo "<input type='hidden' name ='from' id='from' value='suiteList.php'>";
                echo "<button type='submit' class='btn btn-primary' " . $disabled . ">Ajouter une suite</button>";
                echo "</form>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>
<?php

require_once '../view/hotelDisplay.php';
require_once 'message.php';
require_once '../html/footer.html';
?>