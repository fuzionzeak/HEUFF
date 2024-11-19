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

// Récupération des clubs pour les afficher dans le formulaire
$clubs = $gestionClub->getAllClubs();
if (empty($clubs)) {
    echo "Erreur : aucun club trouvé dans la base de données.";
}

// Clé secrète reCAPTCHA
$secretKey = '6LeN3HUqAAAAAC0HxIWO2f8j90TYHqt1zeD-Mc6R';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification CAPTCHA
    $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';

    // Effectuer une requête vers l'API de reCAPTCHA
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);

    // Si le CAPTCHA échoue, retournez une erreur
    if (!$responseKeys['success']) {
        echo "Erreur : vérification reCAPTCHA échouée. Veuillez réessayer.";
        exit;
    }

    $nom = isset($_POST['nom']) && !empty(trim($_POST['nom'])) ? trim($_POST['nom']) : null;
    $prenom = isset($_POST['prenom']) && !empty(trim($_POST['prenom'])) ? trim($_POST['prenom']) : null;
    $email = isset($_POST['email']) && !empty(trim($_POST['email'])) ? trim($_POST['email']) : null;
    $sexe = isset($_POST['sexe']) && !empty($_POST['sexe']) ? $_POST['sexe'] : null;
    $password = isset($_POST['password']) && !empty($_POST['password']) ? $_POST['password'] : null;
    $password_confirm = isset($_POST['password_confirm']) && !empty($_POST['password_confirm']) ? $_POST['password_confirm'] : null;
    $club_principal = isset($_POST['club_principal']) && !empty($_POST['club_principal']) && $_POST['club_principal'] != '0' ? $_POST['club_principal'] : null;
    $image = isset($_FILES['image']) ? $_FILES['image'] : null;

    // Vérification des champs obligatoires
    if (is_null($club_principal)) {
        echo "Erreur : veuillez sélectionner un club principal valide.";
        return;
    }

    // Vérification des mots de passe
    if (is_null($password) || is_null($password_confirm)) {
        echo "Erreur : les champs de mot de passe sont obligatoires.";
        return;
    }

    if ($password !== $password_confirm) {
        echo "Erreur : les mots de passe ne correspondent pas.";
        return;
    }

    // Expression régulière pour la stratégie de mot de passe
    $passwordStrengthPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

    // Vérification de la force du mot de passe
    if (!preg_match($passwordStrengthPattern, $password)) {
        echo "Erreur : Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial.";
        return;
    }

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

        $stmt->bindParam(':id_club_principal', $club_principal, PDO::PARAM_INT);
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

require_once __DIR__ . '/../views/page2_view.php'; // Appelle la vue
