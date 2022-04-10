<?php
require_once 'sessionManager.php';

if (!isset($_SESSION['connection'])){
  header('Location: '. 'userConnect.php');
}

require_once '../html/userSelection.html';
require_once '../html/footer.html';
