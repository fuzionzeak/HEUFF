<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon compte</title>
    <link rel="stylesheet" href="/HEUFF/css/style.css">
</head>
<body>

<h1>Mon compte</h1>

<div class="user-info">
    <p><strong>Nom :</strong> <?= htmlspecialchars($user['NOM_UTI']) ?></p>
    <p><strong>Prénom :</strong> <?= htmlspecialchars($user['PRENOM_UTI']) ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($user['MAIL_UTI']) ?></p>
    <p><strong>Club préféré :</strong> <?= htmlspecialchars($user['NOM_CLUB']) ?></p>
</div>

<div class="deconnexion-container">
    <a href="index.php?page=deconnexion" class="deconnexion">Se déconnecter</a>
</div>

</body>
</html>
