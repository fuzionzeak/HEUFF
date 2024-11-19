<?php
require_once __DIR__ . '/../model/GestionBDD.php';

use Model\GestionBDD;

// Connexion à la base de données
$gestionBDD = new GestionBDD('ligue1');
$cnx = $gestionBDD->connect();

// Récupération des utilisateurs avec date d'inscription et dernière connexion
$stmt = $cnx->prepare("SELECT ID_UTI, NOM_UTI, PRENOM_UTI, MAIL_UTI, DATE_INSCRIPTION, derniere_connexion 
                       FROM UTILISATEUR");
$stmt->execute();
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Marquer les utilisateurs comme inactifs si dernière connexion > 3 mois ou jamais connecté
$inactive_users = [];
foreach ($utilisateurs as &$utilisateur) {
    $date_inscription = new DateTime($utilisateur['DATE_INSCRIPTION']);
    $derniere_connexion = $utilisateur['derniere_connexion'] ? new DateTime($utilisateur['derniere_connexion']) : null;
    $now = new DateTime();

    // Si jamais connecté ou plus de 3 mois depuis la dernière connexion
    if ($derniere_connexion === null || $now->diff($derniere_connexion)->m >= 3 || 
        ($derniere_connexion === null && $now->diff($date_inscription)->m >= 3)) {
        $utilisateur['inactif'] = true;
        $inactive_users[] = $utilisateur;
    } else {
        $utilisateur['inactif'] = false;
    }
}

// gestion de la suppression d'un utilisateur inactif
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_id'])) {
    $userIdToDelete = (int) $_POST['delete_user_id'];

    // Supprimer l'utilisateur de la base de données
    $stmtDelete = $cnx->prepare("DELETE FROM UTILISATEUR WHERE ID_UTI = :id");
    $stmtDelete->bindParam(':id', $userIdToDelete);
    $stmtDelete->execute();

    // Rediriger pour éviter la soumission du formulaire en double
    header("Location: index.php?page=admin_m2");
    exit;
}

require_once __DIR__ . '/../views/admin_m2_view.php';
