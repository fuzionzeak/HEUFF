<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="/HEUFF/css/style.css">
</head>
<body>

<!-- Liens vers les différentes pages contrôleur -->
<header>
    <nav>
    <div class="logo">
    <a href="index.php?page=main">
        <img src="/HEUFF/images/Logo_Ligue1.png" alt="Logo Ligue 1">
    </a>
    </div>
        <ul class="menu">
            <li><a href="index.php?page=page1">Liste des clubs</a></li>
            <li><a href="index.php?page=news">News</a></li>
            <li><a href="index.php?page=page2">S'inscrire</a></li>
            <li><a href="index.php?page=page3">Se connecter</a></li>
            <li><a href="index.php?page=mon_compte">Mon compte</a></li>
        </ul>
    </nav>
</header>

<!-- Inclusion du routeur pour gérer les différentes pages -->
<?php
require_once 'router.php';
?>

</body>
</html>
