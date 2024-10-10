<<<<<<< HEAD
<<<<<<< HEAD
<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once __DIR__ . '/../model/GestionBDD.php';
require_once __DIR__ . '/../model/GestionClub.php';

use Model\GestionBDD;
use Model\GestionClub;

// Connexion à la base de données
$gestionBDD = new GestionBDD('ligue1');
$cnx = $gestionBDD->connect();

// Création de l'objet GestionClub pour manipuler les clubs
$gestionClub = new GestionClub($cnx);

// Récupération des clubs pour les afficher dans le formulaire
$clubs = $gestionClub->getAllClubs();
if (empty($clubs)) {
    echo "Erreur : aucun club trouvé dans la base de données.";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire

    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $sexe = $_POST['sexe'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';
    $club_principal = $_POST['club_principal'] ?? '';
    $image = $_FILES['image'] ?? null;
    $club_principal = $_POST['club_principal'] ?? '';

    if (empty($club_principal) || $club_principal == '0') {
        echo "Erreur : veuillez sélectionner un club principal valide.";
        return;
    }


    $idClubPrincipal = (int) $club_principal;

    
    

    // Vérification si les mots de passe correspondent
    if ($password !== $password_confirm) {
        echo "Erreur : les mots de passe ne correspondent pas.";
    } else {
        // Continuer seulement si les mots de passe correspondent

        // Vérification de l'unicité de l'email
        $stmtCheckEmail = $cnx->prepare("SELECT COUNT(*) FROM UTILISATEUR WHERE MAIL_UTI = :email");
        $stmtCheckEmail->bindParam(':email', $email);
        $stmtCheckEmail->execute();
        $emailExists = $stmtCheckEmail->fetchColumn() > 0;

        if ($emailExists) {
            echo "Erreur : cet email est déjà utilisé. Veuillez en choisir un autre.";
        } else {
            // Traitement de l'image de profil
            $imagePath = '';
            if ($image && $image['error'] === 0) {
                $uploadDir = __DIR__ . '/../uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $imagePath = $uploadDir . basename($image['name']);
                move_uploaded_file($image['tmp_name'], $imagePath);
            }

            // Hachage du mot de passe pour la sécurité
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insertion de l'utilisateur dans la base de données
            $stmt = $cnx->prepare("INSERT INTO UTILISATEUR (ID_CLUB, NOM_UTI, PRENOM_UTI, SEXE_UTI, PASSWORD_UTI, IMAGE_UTI, MAIL_UTI, DATE_INSCRIPTION) 
            VALUES (:id_club_principal, :nom, :prenom, :sexe, :password, :image, :email, NOW())");

            $stmt->bindParam(':id_club_principal', $idClubPrincipal, PDO::PARAM_INT);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':sexe', $sexe);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':image', $imagePath);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            echo "Inscription réussie !";
        }
    }
}


require_once __DIR__ . '/../views/page2_view.php'; // Appelle la vue
=======
<?php

require_once __DIR__ . '/../model/GestionBDD.php';
require_once __DIR__ . '/../model/GestionClub.php';

use Model\GestionBDD;
use Model\GestionClub;

// Connexion à la base de données
$gestionBDD = new GestionBDD('ligue1');
$cnx = $gestionBDD->connect();

// Création de l'objet GestionClub pour manipuler les clubs
$gestionClub = new GestionClub($cnx);

// Récupération des clubs pour les afficher en boutons
$clubs = $gestionClub->getAllClubs();

// ID_CLUB par défaut
$idClubParDefaut = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';  
    $sexe = $_POST['sexe'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';  // Confirmation du mot de passe
    $clubsChoisis = $_POST['clubs'] ?? [];
    $image = $_FILES['image'] ?? null;

    // Vérification si les mots de passe correspondent
    if ($password !== $confirm_password) {
        echo "Erreur : les mots de passe ne correspondent pas.";
    } else {
        // Continuer seulement si les mots de passe correspondent

        // Vérification de l'unicité de l'email
        $stmtCheckEmail = $cnx->prepare("SELECT COUNT(*) FROM UTILISATEUR WHERE MAIL_UTI = :email");
        $stmtCheckEmail->bindParam(':email', $email);
        $stmtCheckEmail->execute();
        $emailExists = $stmtCheckEmail->fetchColumn() > 0;

        if ($emailExists) {
            echo "Erreur : cet email est déjà utilisé. Veuillez en choisir un autre.";
        } else {
            // Utiliser le premier club sélectionné ou un club par défaut
            $idClub = !empty($clubsChoisis) ? (int)$clubsChoisis[0] : $idClubParDefaut;

            // Vérification que l'ID_CLUB existe dans la table CLUB
            $stmtCheckClub = $cnx->prepare("SELECT COUNT(*) FROM CLUB WHERE ID_CLUB = :id_club");
            $stmtCheckClub->bindParam(':id_club', $idClub, PDO::PARAM_INT);
            $stmtCheckClub->execute();
            $clubExists = $stmtCheckClub->fetchColumn() > 0;

            if (!$clubExists) {
                $idClub = $idClubParDefaut;
            }

            // Traitement de l'image de profil
            $imagePath = '';
            if ($image && $image['error'] === 0) {
                $uploadDir = __DIR__ . '/../uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $imagePath = $uploadDir . basename($image['name']);
                move_uploaded_file($image['tmp_name'], $imagePath);
            }

            // Hachage du mot de passe pour la sécurité
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insertion de l'utilisateur dans la base de données
            $stmt = $cnx->prepare("INSERT INTO UTILISATEUR (ID_CLUB, NOM_UTI, PRENOM_UTI, SEXE_UTI, MAIL_UTI, PASSWORD_UTI, IMAGE_UTI, DATE_INSCRIPTION) 
                                   VALUES (:id_club, :nom, :prenom, :sexe, :email, :password, :image, NOW())");

            $stmt->bindParam(':id_club', $idClub, PDO::PARAM_INT);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':sexe', $sexe);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);  // Utilisation du mot de passe haché
            $stmt->bindParam(':image', $imagePath);
            $stmt->execute();

            echo "Inscription réussie !";
        }
    }
}

require_once __DIR__ . '/../views/page2_view.php'; // Appelle la vue
>>>>>>> 45817e33f25d270d1a9a29bf228b1b53a0ac5675
=======
<?php

require_once __DIR__ . '/../model/GestionBDD.php';
require_once __DIR__ . '/../model/GestionClub.php';

use Model\GestionBDD;
use Model\GestionClub;

// Connexion à la base de données
$gestionBDD = new GestionBDD('ligue1');
$cnx = $gestionBDD->connect();

// Création de l'objet GestionClub pour manipuler les clubs
$gestionClub = new GestionClub($cnx);

// Récupération des clubs pour les afficher en boutons
$clubs = $gestionClub->getAllClubs();

// ID_CLUB par défaut
$idClubParDefaut = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';  
    $sexe = $_POST['sexe'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';  // Confirmation du mot de passe
    $clubsChoisis = $_POST['clubs'] ?? [];
    $image = $_FILES['image'] ?? null;

    // Vérification si les mots de passe correspondent
    if ($password !== $confirm_password) {
        echo "Erreur : les mots de passe ne correspondent pas.";
    } else {
        // Continuer seulement si les mots de passe correspondent

        // Vérification de l'unicité de l'email
        $stmtCheckEmail = $cnx->prepare("SELECT COUNT(*) FROM UTILISATEUR WHERE MAIL_UTI = :email");
        $stmtCheckEmail->bindParam(':email', $email);
        $stmtCheckEmail->execute();
        $emailExists = $stmtCheckEmail->fetchColumn() > 0;

        if ($emailExists) {
            echo "Erreur : cet email est déjà utilisé. Veuillez en choisir un autre.";
        } else {
            // Utiliser le premier club sélectionné ou un club par défaut
            $idClub = !empty($clubsChoisis) ? (int)$clubsChoisis[0] : $idClubParDefaut;

            // Vérification que l'ID_CLUB existe dans la table CLUB
            $stmtCheckClub = $cnx->prepare("SELECT COUNT(*) FROM CLUB WHERE ID_CLUB = :id_club");
            $stmtCheckClub->bindParam(':id_club', $idClub, PDO::PARAM_INT);
            $stmtCheckClub->execute();
            $clubExists = $stmtCheckClub->fetchColumn() > 0;

            if (!$clubExists) {
                $idClub = $idClubParDefaut;
            }

            // Traitement de l'image de profil
            $imagePath = '';
            if ($image && $image['error'] === 0) {
                $uploadDir = __DIR__ . '/../uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $imagePath = $uploadDir . basename($image['name']);
                move_uploaded_file($image['tmp_name'], $imagePath);
            }

            // Hachage du mot de passe pour la sécurité
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insertion de l'utilisateur dans la base de données
            $stmt = $cnx->prepare("INSERT INTO UTILISATEUR (ID_CLUB, NOM_UTI, PRENOM_UTI, SEXE_UTI, MAIL_UTI, PASSWORD_UTI, IMAGE_UTI, DATE_INSCRIPTION) 
                                   VALUES (:id_club, :nom, :prenom, :sexe, :email, :password, :image, NOW())");

            $stmt->bindParam(':id_club', $idClub, PDO::PARAM_INT);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':sexe', $sexe);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);  // Utilisation du mot de passe haché
            $stmt->bindParam(':image', $imagePath);
            $stmt->execute();

            echo "Inscription réussie !";
        }
    }
}

require_once __DIR__ . '/../views/page2_view.php'; // Appelle la vue
>>>>>>> 42ad1d4a2e39c27072b5bbdccbc2fabe720ec015
