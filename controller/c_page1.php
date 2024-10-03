<?php

// Correction du chemin d'inclusion
require_once __DIR__ . '/../model/GestionBDD.php';
require_once __DIR__ . '/../model/GestionClub.php';

use Model\GestionBDD;
use Model\GestionClub;

// Connexion à la base de données
$gestionBDD = new GestionBDD('ligue1');
$cnx = $gestionBDD->connect();

// Création de l'objet GestionClub pour manipuler les clubs
$gestionClub = new GestionClub($cnx);
$clubs = $gestionClub->getAllClubs(); // Suppose que vous avez une méthode pour récupérer tous les clubs

// Inclure la vue
require_once __DIR__ . '/../views/page1_view.php';
?>
