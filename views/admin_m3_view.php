<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Publier une news</title>
    <link rel="stylesheet" href="/HEUFF/css/style.css">
</head>
<body>

<h1>Publier une News</h1>

<form action="index.php?page=admin_m3" method="POST" id="newsForm">
    <div>
        <label for="contenu">Contenu de la news :</label>
        <textarea id="contenu" name="contenu" rows="5" required></textarea>
        <span id="contenu-error" style="color: red;"></span>
    </div>

    <div>
        <label for="club">Sélectionnez un club :</label>
        <select id="club" name="club" required>
            <option value="">Choisissez un club</option>
            <!-- Ajoutez ici les clubs disponibles -->
            <option value="1">Paris-SG</option>
            <option value="2">Marseille</option>
            <!-- Ajoutez plus de clubs -->
        </select>
        <span id="club-error" style="color: red;"></span>
    </div>

    <button type="submit">Publier la news</button>
</form>

<!-- Affichage des erreurs côté serveur -->
<?php if (!empty($validationErrors)): ?>
    <ul style="color: red;">
        <?php foreach ($validationErrors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<script>
// Validation côté client
document.getElementById('newsForm').addEventListener('submit', function(e) {
    var contenu = document.getElementById('contenu').value;
    var club = document.getElementById('club').value;
    var isValid = true;

    // Réinitialiser les erreurs
    document.getElementById('contenu-error').textContent = '';
    document.getElementById('club-error').textContent = '';

    // Validation du contenu
    if (contenu.length < 10) {
        document.getElementById('contenu-error').textContent = 'Le contenu doit contenir au moins 10 caractères.';
        isValid = false;
    }

    // Validation du club
    if (!club) {
        document.getElementById('club-error').textContent = 'Veuillez sélectionner un club.';
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault(); // Empêche l'envoi du formulaire s'il y a des erreurs
    }
});
</script>

</body>
</html>
