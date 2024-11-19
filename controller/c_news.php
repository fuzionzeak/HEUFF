<?php
require_once __DIR__ . '/../model/GestionBDD.php';
require_once __DIR__ . '/../model/GestionClub.php';

use Model\GestionBDD;
use Model\GestionClub;

$gestionBDD = new GestionBDD('ligue1');
$cnx = $gestionBDD->connect();

$gestionClub = new GestionClub($cnx);
$clubs = $gestionClub->getAllClubs();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre'] ?? '');
    $idClub = trim($_POST['club'] ?? '');
    $article = trim($_POST['contenu'] ?? '');
    
    if (!empty($titre) && !empty($idClub) && !empty($article)) {
        $stmt = $cnx->prepare("INSERT INTO NEWS (TITRE, ID_CLUB, ARTICLE_NEWS, DATE_NEWS) VALUES (:titre, :id_club, :article, NOW())");
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':id_club', $idClub, PDO::PARAM_INT);
        $stmt->bindParam(':article', $article);
        
        if ($stmt->execute()) {
            echo "News publiée avec succès !";
        } else {
            echo "Erreur lors de la publication de la news.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
    
}

require_once __DIR__ . '/../views/news_view.php';
