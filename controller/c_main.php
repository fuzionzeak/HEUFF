<?php
require_once __DIR__ . '/../model/GestionBDD.php';
require_once __DIR__ . '/../model/GestionNews.php';
require_once __DIR__ . '/../model/GestionCommentaires.php';
require_once __DIR__ . '/../model/News.php';

use Model\GestionBDD;
use Model\GestionNews;
use Model\GestionCommentaires;
use Model\News;
session_start();

// Connexion à la base de données
$gestionBDD = new GestionBDD('ligue1');
$cnx = $gestionBDD->connect();
$gestionNews = new GestionNews($cnx);
$gestionCommentaires = new GestionCommentaires($cnx);

// Pagination
$newsPerPage = 5;
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$offset = ($page - 1) * $newsPerPage;

// Récupérer les news paginées
$newsList = $gestionNews->getNewsPaginated($newsPerPage, $offset);
$totalNews = $gestionNews->countNews();
$totalPages = ceil($totalNews / $newsPerPage);

// Ajouter les commentaires à chaque news
foreach ($newsList as $news) {
    $newsCommentaires = $gestionCommentaires->getCommentairesParNews($news->getId());
    $news->setCommentaires($newsCommentaires);
}

// Appeler la vue
require_once __DIR__ . '/../views/main_view.php';
