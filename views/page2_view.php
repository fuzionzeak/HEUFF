
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Inscription</title>
    <link rel="stylesheet" href="/HEUFF/css/style.css">
</head>
<body>

<h1>Formulaire d'inscription</h1>
<main>
    <form action="index.php?page=page2" method="POST" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <span id="nom-error" style="color:red;"></span>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
        <span id="prenom-error" style="color:red;"></span>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <span id="email-error" style="color:red;"></span>

        <label for="sexe">Sexe :</label>
        <select id="sexe" name="sexe" required>
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
            <option value="Autre">Autre</option>
        </select><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirm">Confirmer le mot de passe :</label>
        <input type="password" id="password_confirm" name="password_confirm" required>

        <label for="image">Image de profil :</label>
        <input type="file" id="image" name="image" accept="image/*"><br>

        <!-- Club préféré principal -->
        <label for="club_principal">Club préféré principal :</label>
        <select id="club_principal" name="club_principal" required>
            <option value="">Choisissez un club</option>
            <?php foreach ($clubs as $club): ?>
                <option value="<?= isset($club['ID_CLUB']) ? htmlspecialchars($club['ID_CLUB'], ENT_QUOTES, 'UTF-8') : '0'; ?>">
                    <?= isset($club['NOM_CLUB']) ? htmlspecialchars($club['NOM_CLUB'], ENT_QUOTES, 'UTF-8') : 'Nom inconnu'; ?>
                </option>
            <?php endforeach; ?>
        </select>




        <span id="club_principal-error" style="color:red;"></span>


        <!-- Checkbox pour clubs préférés -->
        <h3>Clubs préférés supplémentaires (facultatif) :</h3>
        <div class="clubs-preferes">
            <?php foreach ($clubs as $club): ?>
                <label>
                    <input type="checkbox" name="clubs[]" value="<?= htmlspecialchars($club['ID_CLUB'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    <?= htmlspecialchars($club['NOM_CLUB'] ?? 'Nom inconnu', ENT_QUOTES, 'UTF-8'); ?>
                </label>
            <?php endforeach; ?>
        </div>
        <button type="submit">S'inscrire</button>
    </form>


</main>
<script>
document.querySelector('form').addEventListener('submit', function(e) {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm_password').value;

    if (password !== confirmPassword) {
        e.preventDefault();  // Empêche l'envoi du formulaire
        alert('Les mots de passe ne correspondent pas.');
    }
});
</script>
<script>
$(document).ready(function() {
    // Détecter quand l'utilisateur quitte le champ email
    $('#email').on('blur', function() {
        var email = $(this).val(); // Récupérer la valeur de l'email
        var emailError = $('#email-error'); // Zone pour afficher l'erreur

        // Vérifier si l'email n'est pas vide avant de faire la requête AJAX
        if (email !== '') {
            $.ajax({
                url: 'API/check_email.php',  // Nouvelle URL pour pointer vers le fichier dans le dossier ajax
                type: 'POST',
                data: { email: email },
                success: function(response) {
                    if (response === 'exists') {
                        $('#email-error').text('Cet email est déjà utilisé.');
                    } else {
                        $('#email-error').text('');
                    }
                }
            });

        }
    });
});
</script>


</body>
</html>
