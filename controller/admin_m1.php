<?php

require_once __DIR__ . '/../model/GestionBDD.php';

use Model\GestionBDD;

$gestionBDD = new GestionBDD('ligue1');
$cnx = $gestionBDD->connect();

// Exemple de récupération de données depuis la base
$stmt = $cnx->prepare("SELECT * FROM UTILISATEUR");
$stmt->execute();
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Repérer les utilisateurs inactifs
$inactive_users_query = "
    SELECT *
    FROM UTILISATEUR
    WHERE 
        (derniere_connexion IS NULL AND DATE_INSCRIPTION < DATE_SUB(NOW(), INTERVAL 3 MONTH)) 
        OR (derniere_connexion IS NOT NULL AND derniere_connexion < DATE_SUB(NOW(), INTERVAL 3 MONTH))
";

$stmtInactiveUsers = $cnx->prepare($inactive_users_query);
$stmtInactiveUsers->execute();
$inactive_users = $stmtInactiveUsers->fetchAll(PDO::FETCH_ASSOC);



// Inclure la vue admin_m1_view.php
require_once __DIR__ . '/../views/admin_m1_view.php';
