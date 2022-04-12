<?php
require_once 'sessionManager.php';
require_once '../model/Suite.php';
require_once '../model/Gallery.php';

if (!isset($_SESSION['currentSuite'])){
        header('Location: '. 'home.php');
}

if (isset($_SESSION['connection'])){

    if ($_SESSION['role'] === 'MNG' ){
        if(isset($_FILES['monfichier'])) {
            if (!is_uploaded_file($_FILES['monfichier']['tmp_name'])){
                $titre = "OOPS !";
                $next = "";
                $message = "UPLOAD DU FICHIER IMPOSSIBLE.";
                displayMessage($titre, $message, $next);
                die();
            }else{
                $check = getimagesize($_FILES["monfichier"]["tmp_name"]);
                if($check === false) {
                    $titre = "OOPS !";
                    $next = "";
                    $message = "Le fichier désigné n'est pas une image.";
                    displayMessage($titre, $message, $next);
                    die();
                }
                if ($_FILES["monfichier"]["size"] > 200000) {
                    $titre = "OOPS !";
                    $next = "";
                    $message = "La taille du fichier est supérieure à la limite de 200000 octets.";
                    displayMessage($titre, $message, $next);
                    die();
                }
                // Check file name has suffix
                $suffixes = explode('.', $_FILES['monfichier']['name'] );
                if (count($suffixes) < 2){
                    $titre = "OOPS !";
                    $next = "";
                    $message = "Le nom du fichier doit comporter un suffixe.";
                    displayMessage($titre, $message, $next);
                    die();
                }
                $uploadDir = '../gallery';
                $suffixe = $suffixes[count($suffixes) - 1];
                // Make file name unique in gallery
                $filename = $uploadDir . "/IMG_". time() . "." . $suffixe;
                $response = move_uploaded_file($_FILES['monfichier']['tmp_name'], $filename);
                var_dump($response);
                // Store image gallery to the appropriate suite
                $gallery = new Gallery();
                $gallery->setSource($filename);
                $gallery->setSuite($_SESSION['currentSuite']);
                $response = $gallery->create($pdo);
                if(isset($response)){
                    $titre = 'Problème d\'insertion photo..';
                    $next = '';
                    $message = $response;
                    displayMessage($titre, $response, $next);
                    die();
                }else{
                    // Set this new image gallery to the new created/updated suite
                    // only if explicit user request
                    $suite = new Suite();
                    $response = $suite->findId($pdo, $_SESSION['currentSuite']);
                    if(!is_object($response)){
                        $titre = 'OOOPS !';
                        $message = "PROBLEME LECTURE SUITE.";
                        $next = 'home.php';
                        displayMessage($titre, $message, $next);
                        die();
                    }
                    if (isset($_POST['checkFeatured'])){
                        $suite->setFeatured($filename);
                        $response = $suite->update($pdo, $_SESSION['currentSuite']);
                        if(is_object($response)){
                            $titre = 'La suite a bien été mise à jour.';
                            $message = "avec son image par défaut.";
                            $next = 'suiteGallery.php?suite=' . $_SESSION['currentSuite'];
                            displayMessage($titre, $message, $next);
                            die();
                        }else{
                            $titre = "Problème lors de l'insertion image par défaut.";
                            $message = $response;
                            $next = 'home.php';
                            displayMessage($titre, $message, $next);
                            die();
                        }
                    }else{
                        $titre = 'La suite a bien été mise à jour.';
                        $message = "";
                        $next = 'suiteGallery.php?suite=' . $_SESSION['currentSuite'];
                        displayMessage($titre, $message, $next);
                        die();
                    }
                }
            }
        }else{
            // Display images of the selected suite
            
            $suite = new Suite();
            $suite->findId($pdo, $_SESSION['currentSuite']);
            $galleries = $suite->findGalleries($pdo, $suite->getId() );
            if(isset($galleries) && !is_array($galleries)){
                $titre = 'Problème d\'accès à la liste des images.';
                $next = '';
                displayMessage($titre, $galleries, $next);
                die();
            }
        }   
    }else{
        if ($_SESSION['role'] !== 'MNG' ){
            $suite = new Suite();
            $suite->findId($pdo, $_SESSION['currentSuite']);
            $galleries = $suite->findGalleries($pdo, $suite->getId() );
            if(isset($galleries) && !is_array($galleries)){
                $titre = 'Problème d\'accès à la liste des images.';
                $next = '';
                displayMessage($titre, $galleries, $next);
                die();
            }else{
                if (count($galleries) === 0) {
                    $titre = 'OOPS !';
                    $next = 'home.php';
                    $message = "Le détail de cette suite n'est pas encore disponible.";
                    displayMessage($titre, $message, $next);
                    die();
                }else{
                        $action="";
                }
            }
        }
    }
}else{
    $suite = new Suite();
    $suite->findId($pdo, $_SESSION['currentSuite']);
    $galleries = $suite->findGalleries($pdo, $suite->getId() );
    if(isset($galleries) && !is_array($galleries)){
        $titre = 'Problème d\'accès à la liste des images.';
        $next = '';
        displayMessage($titre, $galleries, $next);
        die();
    }else{
        if (count($galleries) === 0) {
            $titre = 'OOPS !';
            $next = 'home.php';
            $message = "Le détail de cette suite n'est pas encore disponible.";
            displayMessage($titre, $message, $next);
            die();
        }else{
                $action="";
        }
    }
}

$action= "hotelDisplay.php";
?>
<div class="row sticky-top">
    <div class="col-6 col-md-4">
        <div class="row rounded m-2 justify-content-center">
            <div class='col mt-3 text-align-center'>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['from']) && $_POST['from'] === "userBookingList.php"){
        echo "<div class='col-12 col-md-4'>";
            echo "<div class='row custom rounded m-2 justify-content-center'>";
            echo "<div class='col mt-3 text-align-center'>";
            echo "<form action='userBookingList.php' method='POST'>";
            echo "<button type='submit' class='btn btn-primary'>Retour liste réservation</button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        echo "</div>";
    }else{
    ?>
        <div class="col-12 col-md-4">
            <div class="row custom rounded m-2 justify-content-center">
                <?php
                echo "<div class='col mt-3 text-align-center'>";
                echo "<form action='" . $action . "' method='POST'>";
                echo "<input type='hidden' name ='hotel' id='hotel' value=" . $_SESSION['hotel'] . ">";
                echo "<button type='submit' class='btn btn-primary'>Retour liste suite</button>";
                echo "</form>";
                ?>
                </div>
                <?php
                echo "<div class='col mt-3 text-align-center'>";
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'MNG' ){
                    require_once '../html/uploadForm.html';
                }
                echo "</div>";
                echo "<div class='col mt-3 text-align-center'>";
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'MNG' ){
                    echo "<form id='formCheck' action='galleryUpdate.php' method='POST'>";
                    echo "<input type='hidden' name ='postString' id='postString'>";
                    echo "<button type='submit' class='btn btn-primary'>Confirmer les coches</button>";
                    echo "</form>";
                }
                echo "</div>";
                ?>
            </div>
        </div>
    <?php
    }
    ?>
</div>   
<?php

require_once '../view/galleryDisplay.php';

require_once '../html/footer.html';
?>