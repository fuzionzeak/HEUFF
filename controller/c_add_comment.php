<?php
require_once __DIR__ . '/../model/GestionBDD.php';
require_once __DIR__ . '/../model/GestionCommentaires.php';

use Model\GestionBDD;
use Model\GestionCommentaires;

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $idUser = $_SESSION['user_id'];
    $idNews = $_POST['id_news'] ?? null;
    $contenu = isset($_POST['contenu']) ? trim($_POST['contenu']) : null;

    // Debugging pour vérifier les données transmises
    if (is_null($idNews) || $idNews === '') {
        echo "ID de la news manquant ou vide.";
        exit;
    }
    if (is_null($contenu) || $contenu === '') {
        echo "Contenu du commentaire manquant ou vide.";
        exit;
    }

    if (!empty($idNews) && !empty($contenu)) {
        $gestionBDD = new GestionBDD('ligue1');
        $cnx = $gestionBDD->connect();

        // Vérifier si la news existe
        $stmt = $cnx->prepare("SELECT ID_NEWS FROM NEWS WHERE ID_NEWS = :id_news");
        $stmt->bindParam(':id_news', $idNews, PDO::PARAM_INT);
        $stmt->execute();
        $newsExists = $stmt->fetchColumn();

        if ($newsExists) {
            $gestionCommentaires = new GestionCommentaires($cnx);

            if ($gestionCommentaires->ajouterCommentaire($idNews, $idUser, $contenu)) {
                header('Location: index.php?page=main');
                exit();
            } else {
                echo "Erreur lors de l'ajout du commentaire.";
                exit;
            }
        } else {
            echo "La news sélectionnée n'existe pas.";
            exit;
        }
    } else {
        echo "Veuillez remplir tous les champs.";
        exit;
    }
} else {
    echo "Vous devez être connecté pour commenter.";
    exit;
}
