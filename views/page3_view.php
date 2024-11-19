<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Se connecter</title>
    <link rel="stylesheet" href="/HEUFF/css/style.css">
</head>
<body>

<h1>Connexion</h1>

<main>
    <form action="index.php?page=page3" method="POST">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <span id="email-error" style="color:red;"></span>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <span id="password-error" style="color:red;"></span>

        <!-- Affiche les erreurs de connexion ici -->
        <?php if (!empty($loginError)): ?>
            <p style="color:red;"><?= htmlspecialchars($loginError) ?></p>
        <?php endif; ?>

        <button type="submit">Se connecter</button>
    </form>
</main>

<script>
$(document).ready(function() {
    // Vérification que le formulaire est bien rempli
    $('form').on('submit', function(e) {
        var email = $('#email').val().trim();
        var password = $('#password').val().trim();
        
        if (email === '' || password === '') {
            e.preventDefault();
            alert('Veuillez remplir tous les champs.');
        }
    });
});
</script>

</body>
</html>
