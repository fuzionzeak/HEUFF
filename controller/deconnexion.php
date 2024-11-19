<?php
session_start();

// Détruire toutes les variables de session
$_SESSION = [];

// Détruire la session elle-même
session_destroy();

// Rediriger vers la page de connexion ou une autre page de votre choix
header('Location: index.php?page=page3'); // page de connexion
exit;
