<div class="col-md-7">
    <?php
    if (!isset($galleries)){
        die();
    }
    echo "<div class='col jumbo mt-3'>";
        foreach ($galleries as $gallerie){
        echo "<div class='row'>";
            echo "<div class='col text-center align-middle'>"; 
                echo "<img src='" . $gallerie['source'] . "' class='mb-3 img-fluid rounded'";
                // echo "<h5></h5>";
            echo "</Div>";
            echo "<div class='col text-center align-middle'>";
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'MNG' ){
                echo "<label>Par défaut</label>";
                echo "<input class='featuredGallery' type='checkbox' id ='featuredGallery-" . $gallerie['id'] . "'>";
                echo "<label>Supprimer</label>";
                echo "<input class='cancelGallery' type='checkbox' id ='cancelGallery-" . $gallerie['id'] . "'>";
                }
            echo "</div>";
        echo "</div>";
        }
    echo "</div>";
    ?>
</div>