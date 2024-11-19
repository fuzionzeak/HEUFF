<?php
require_once __DIR__ . '/../model/GestionBDD.php';
require_once __DIR__ . '/../model/GestionClub.php';

use Model\GestionBDD;
use Model\GestionClub;

$validationErrors = []; // Tableau pour stocker les erreurs

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $contenu = $_POST['contenu'] ?? '';
    $club_id = $_POST['club'] ?? '';

    // Validation du contenu de la news
    if (empty($contenu)) {
        $validationErrors[] = "Le contenu de la news est obligatoire.";
    } elseif (strlen($contenu) < 10) {
        $validationErrors[] = "Le contenu doit contenir au moins 10 caractères.";
    }

    // Validation du club
    if (empty($club_id)) {
        $validationErrors[] = "Veuillez sélectionner un club.";
    }

    // Si aucune erreur, afficher "OK"
    if (empty($validationErrors)) {
        echo "OK";
    }
}

// Appelle la vue du formulaire de news
require_once __DIR__ . '/../views/admin_m3_view.php';