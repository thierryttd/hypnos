<?php
if (!isset($hotel)){
    die();
}
?>
<div class="col-12 col-md-4">
    <div class="row custom rounded m-2">
        <div class="col">   
            <div class="col">
                <h1><?php echo $hotel->getName()?></h1>
                <p><?php echo $hotel->getCity()?></p>
                <p><?php echo $hotel->getZipcode()?></p>
                <div class="row  m-1">
                    <p><?php echo $hotel->getStreetnumber() . " " . $hotel->getStreet()?></p>
                    <!-- <p><?php echo $hotel->getStreet()?></p> -->
                </div>
            </div>
            <div class="col">
                <p><?php echo $hotel->getDescription()?></p>
                <a href='../html/formContact'>Contacter l'établissement</a>
            </div>
        </div>
    </div>
</div>

