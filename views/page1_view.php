<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des clubs</title>
    <link rel="stylesheet" href="/HEUFF/css/style.css"> <!-- Chemin vers votre fichier CSS -->
</head>
<body>

<h1>Liste des clubs de foot</h1>

<table>
    <thead>
        <tr>
            <th>Nom du club</th>
            <th>Ligue</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clubs as $club): ?>
            <tr>
                <td><?= htmlspecialchars($club['NOM_CLUB'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($club['LIGUE_CLUB'], ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
