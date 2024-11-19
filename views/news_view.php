<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une News</title>
    <link rel="stylesheet" href="/HEUFF/css/style.css">
</head>
<body>

<h1>Ajouter une News</h1>

<div class="form-container">
    <form action="index.php?page=add_news" method="POST" onsubmit="return validateForm()">
        <label for="titre">Titre de la news :</label>
        <input type="text" id="titre" name="titre" required>

        <label for="club">Choisir un club :</label>
        <select id="club" name="club" required>
            <option value="">Sélectionnez un club</option>
            <?php foreach ($clubs as $club): ?>
                <option value="<?= htmlspecialchars($club['ID_CLUB']) ?>">
                    <?= htmlspecialchars($club['NOM_CLUB']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="contenu">Contenu de la news :</label>
        <textarea id="contenu" name="contenu" rows="4" required></textarea>

        <button type="submit">Publier la News</button>
    </form>
</div>


<script>
function validateForm() {
    const titre = document.getElementById('titre').value.trim();
    const club = document.getElementById('club').value.trim();
    const contenu = document.getElementById('contenu').value.trim();

    if (titre === '' || club === '' || contenu === '') {
        alert('Veuillez remplir tous les champs.');
        return false; // Empêche l'envoi du formulaire
    }
    return true; // Permet l'envoi du formulaire
}
</script>

</body>
</html>
