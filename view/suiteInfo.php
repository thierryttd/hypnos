<?php
if (!isset($suite)){
    die();
  }
?>
<div class="col-12 col-md-4">
    <div class="row custom rounded m-2">
        <div class="col">
            <h1><?php echo htmlspecialchars_decode($suite->getTitle(), ENT_QUOTES)?></h1>
            <p><?php echo htmlspecialchars_decode($suite->getDescription(), ENT_QUOTES)?></p>
            <p><?php echo htmlspecialchars_decode($suite->getPrice(), ENT_QUOTES)?>€ la nuitée.</p>
        </div>
    </div>
</div>