<?php
require_once 'sessionManager.php';

if(isset($_GET['suite'])){
    $_SESSION['currentSuite'] = $_GET['suite'];
}else{
    unset($_SESSION['currentSuite']);
}

require_once '../html/bookingPeriod.html';
require_once '../html/footer.html';
