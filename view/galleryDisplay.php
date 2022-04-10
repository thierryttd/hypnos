<div class="container-fluid">
    <div class="row">
        <?php
        // Block for suite description
        require_once '../view/suiteInfo.php';

        // Block for gallery of the suite
        $action = "";
        $disabled = "disabled";
        
        require_once '../view/galleryList.php';
        
        ?>
    </div>
</div>