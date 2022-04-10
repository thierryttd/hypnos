<?php
// Test if running deployed app on heroku or local server 
if (getenv('JAWSDB_URL') !== false){
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);
    
    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');
    try {
        $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    } catch (PDOException $e) {
        // Gestion de l'exception
        die('Erreur : ' . $e->getMessage());
    }
}else{
    $username = "root";
    $password = "";
    try {
        $pdo = new PDO('mysql:dbname=hypnos;host=127.0.0.1', $username, $password);
    } catch (PDOException $e) {
        // Gestion de l'exception
        die('Erreur : ' . $e->getMessage());
    }
}
$_SESSION['dbconnect'] = 'connected';
?>