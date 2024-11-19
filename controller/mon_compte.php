<?php
session_start();
require_once __DIR__ . '/../model/GestionBDD.php';

use Model\GestionBDD;

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=page3'); // Redirige vers la page de connexion si non connecté
    exit;
}

// Connexion à la base de données
$gestionBDD = new GestionBDD('ligue1');
$cnx = $gestionBDD->connect();

// Récupération des informations utilisateur, y compris le club
$stmt = $cnx->prepare("SELECT NOM_UTI, PRENOM_UTI, MAIL_UTI, NOM_CLUB FROM UTILISATEUR 
                       INNER JOIN CLUB ON UTILISATEUR.ID_CLUB = CLUB.ID_CLUB 
                       WHERE ID_UTI = :id_uti");
$stmt->bindParam(':id_uti', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Utilisateur non trouvé.";
    exit;
}

require_once __DIR__ . '/../views/mon_compte_view.php';
