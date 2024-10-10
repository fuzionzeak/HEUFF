<?php
require_once __DIR__ . '/../model/GestionBDD.php';

use Model\GestionBDD;

// Connexion à la base de données
$gestionBDD = new GestionBDD('ligue1');
$cnx = $gestionBDD->connect();

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Préparation de la requête pour vérifier si l'email existe
    $stmt = $cnx->prepare("SELECT COUNT(*) FROM UTILISATEUR WHERE MAIL_UTI = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $count = $stmt->fetchColumn();

    // Si l'email existe, renvoyer une réponse
    if ($count > 0) {
        echo 'exists';
    } else {
        echo 'available';
    }
}

