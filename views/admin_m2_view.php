<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Gestion des utilisateurs</title>
    <link rel="stylesheet" href="/HEUFF/css/style.css">
</head>
<body>

<h1>Gestion des utilisateurs</h1>

<div>
    <h2>Liste des utilisateurs</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Date d'inscription</th>
                <th>Dernière connexion</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur): ?>
            <tr>
                <td><?= htmlspecialchars($utilisateur['ID_UTI']) ?></td>
                <td><?= htmlspecialchars($utilisateur['PRENOM_UTI']) ?></td>
                <td><?= htmlspecialchars($utilisateur['NOM_UTI']) ?></td>
                <td><?= htmlspecialchars($utilisateur['MAIL_UTI']) ?></td>
                <td><?= htmlspecialchars($utilisateur['DATE_INSCRIPTION']) ?></td>
                <td><?= $utilisateur['derniere_connexion'] ? htmlspecialchars($utilisateur['derniere_connexion']) : 'Jamais connecté' ?></td>
                <td><?= $utilisateur['inactif'] ? 'Inactif' : 'Actif' ?></td>
                <td>
                    <?php if ($utilisateur['inactif']): ?>
                        <form method="POST" action="">
                            <input type="hidden" name="delete_user_id" value="<?= $utilisateur['ID_UTI'] ?>">
                            <button type="submit">Supprimer</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
