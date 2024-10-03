<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="/HEUFF/css/style.css">
</head>
<body>

<!-- Liens vers les différentes pages contrôleur -->
<header>
    <nav>
        <ul class="menu">
            <li><a href="index.php?page=page1">Liste des clubs</a></li>
            <li><a href="index.php?page=page2">S'inscrire</a></li>
            <li><a href="index.php?page=page3">Voir Page 3</a></li>
        </ul>
    </nav>
</header>

<!-- Inclusion du routeur pour gérer les différentes pages -->
<?php
require_once 'router.php';
?>

</body>
</html>
