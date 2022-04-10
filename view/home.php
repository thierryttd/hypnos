<div class="container-fluid">
    <div class="row justify-content-around">
        <div class="col-12 col-lg-4">
            <div class="card custom">
                <img class="card-img-top" src="../images/card-history.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Notre histoire</h5>
                    <p class="card-text">Découvrez notre développement d'une passion familiale à un groupe performant.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card custom">
                <img class="card-img-top" src="../images/card-hotel.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Nos établissements</h5>
                    <p class="card-text">Imprégnez vous du confort de chacun de nos hôtels, découvrez leur intimité.</p>
                    <a href="hotelList.php?origin=home" class="btn btn-primary">Découvrez</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card custom">
                <img class="card-img-top" src="../images/card-booking.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Bienvenue</h5>
                    <p class="card-text">Programmez votre séjour dès maintenant, nous vous assisterons dans votre réservation.</p>
                    <a href="bookingPeriod.php" class="btn btn-primary">Réservez</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-around jumbo">
        <h2>
            Au hasard de nos suites ...
        </h2>
    </div>
    
    <div class="row justify-content-around">
            <div id="carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner col">
                <?php
                $active = "active";
                    foreach ($images as $image){
                    echo "<div class='carousel-item " . $active . "'> ";
                        echo "<img class='d-block img-fluid rounded' src='" . $image['source'] . "' alt='image' >";
                        echo "<div class='carousel-caption d-md-block'>";
                            echo "<h5 class='custom'>" . $image['name'] . "</h5>";
                            echo "<p class='custom'>" . $image['title'] . "</p>";
                        echo "</div>";
                    echo "</div>";
                    $active="";
                }
                    
                ?>
            </div>
            </div>
    </div>   
</div>