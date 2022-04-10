<?php
if (!isset($suite)){
    die();
  }
?>
<div class="col-12 col-md-4">
    <div class="row custom rounded m-2">
        <div class="col">
            <h1><?php echo $suite->getTitle()?></h1>
            <p><?php echo $suite->getDescription()?></p>
            <p><?php echo $suite->getPrice()?></p>
        </div>
    </div>
</div>