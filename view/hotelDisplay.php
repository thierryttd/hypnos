<div class="container-fluid">
    <div class="row">
        <?php
        
        // Block for hotel description
        require_once '../view/hotelInfo.php';

        // Block for list of hotel suites 
        $action = "";
        if (isset($_SESSION['connection']) && $_SESSION['role'] === 'MNG') {
            $cssDisabled = "cssDisabled";
            $action = "suiteUpdate.php";
            $disabled="";
        }else{
            $cssDisabled = "";
            $action = "hotelDisplay.php";
            $disabled = "disabled";
        }
        require_once '../view/suiteList.php';
        
        ?>
    </div>
</div>