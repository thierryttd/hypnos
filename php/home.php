<?php
require_once 'sessionManager.php';

$sql = "SELECT source, title, name FROM galleries, suites, hotels WHERE 
galleries.suite = suites.id AND suites.hotel = hotels.id LIMIT 12";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute();
    $images = $stmt->fetchAll();
}catch (Exception $e){
    $titre = 'Problème de lecture DB.';
    $next = '';
    $message = $e->getMessage();
    displayMessage($titre, $message, $next);
    die();
}
require_once '../view/home.php';

require_once '../html/footer.html';
