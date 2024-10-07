<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="/HEUFF/css/style.css">
</head>
<body>

<h1>Formulaire d'inscription</h1>

<form action="index.php?page=page2" method="POST" enctype="multipart/form-data">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required><br>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required><br>

    <label for="sexe">Sexe :</label>
    <select id="sexe" name="sexe" required>
        <option value="Homme">Homme</option>
        <option value="Femme">Femme</option>
        <option value="Autre">Autre</option>
    </select><br>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required><br>

    <label for="image">Image de profil :</label>
    <input type="file" id="image" name="image" accept="image/*" required><br>

    <h3>Clubs préférés :</h3>
    <div class="clubs-preferes">
        <?php foreach ($clubs as $club): ?>
            <label>
                <input type="checkbox" name="clubs[]" value="<?= htmlspecialchars($club['ID_CLUB'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                <?= htmlspecialchars($club['NOM_CLUB'] ?? 'Nom Inconnu', ENT_QUOTES, 'UTF-8'); ?>
            </label>
        <?php endforeach; ?>
    </div>



    <button type="submit">S'inscrire</button>
</form>

</body>
</html>
