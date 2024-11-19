<?php
require_once __DIR__ . '/../model/GestionBDD.php';
require_once __DIR__ . '/../model/GestionUser.php';
require_once __DIR__ . '/../model/user.php';

use Model\GestionBDD;
use Model\GestionUser;
use Model\User;

session_start();

$gestionBDD = new GestionBDD('ligue1');
$cnx = $gestionBDD->connect();

$gestionUser = new GestionUser($cnx);

$loginError = ''; // Variable pour afficher les erreurs

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;

    if (!empty($email) && !empty($password)) {
        $user = $gestionUser->getUserByEmail($email);

        if ($user && password_verify($password, $user->getPassword())) {
            // Mettre à jour la dernière connexion
            $gestionUser->updateLastConnection($user->getId());

            // Démarrer la session
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['success_message'] = "Connexion réussie. Bienvenue, " . $user->getEmail() . " !";

            header('Location: index.php?page=page1');
            exit;
        } else {
            $loginError = "Adresse e-mail ou mot de passe incorrect.";
        }
    } else {
        $loginError = "Veuillez remplir tous les champs.";
    }
}

require_once __DIR__ . '/../views/page3_view.php';
