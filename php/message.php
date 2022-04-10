<?php
function displayMessage($title, $message, $next){
    echo "<div class='col'>";
    echo "<div class='card'>";
    echo "<div class='card-body jumbo'>";
        echo "<h5 class='card-title'>" . $title . "</h5>";
        echo "<p class='card-text'>" . $message . "</p>";
        echo "<a href='" . $next . "' class='btn btn-secondary'>Fermer</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}