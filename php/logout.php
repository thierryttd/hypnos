<?php
require_once 'sessionManager.php';

require_once 'message.php';

// Détruit toutes les variables de session
$_SESSION = array();

// Finalement, on détruit la session.
session_destroy();

$titre = 'Vous êtes bien déconnecté.';
$message = 'Merci de votre visite.';
$next = 'home.php';
displayMessage($titre, $message, $next);

require_once '../html/footer.html';
?>