<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="/HEUFF/css/style.css">
</head>
<body>

<h1>Dashboard Admin</h1>

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
            </tr>
        </thead>
        <tbody>
            <?php if (count($utilisateurs) > 0): ?>
                <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td><?= htmlspecialchars($utilisateur['ID_UTI']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['PRENOM_UTI']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['NOM_UTI']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['MAIL_UTI']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['DATE_INSCRIPTION']) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Aucun utilisateur trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div>
    <h3>Utilisateurs inactifs</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Date d'inscription</th>
                <th>Dernière connexion</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($inactive_users) > 0): ?>
                <?php foreach ($inactive_users as $inactive_user): ?>
                <tr>
                    <td><?= htmlspecialchars($inactive_user['ID_UTI']) ?></td>
                    <td><?= htmlspecialchars($inactive_user['NOM_UTI']) ?></td>
                    <td><?= htmlspecialchars($inactive_user['MAIL_UTI']) ?></td>
                    <td><?= htmlspecialchars($inactive_user['DATE_INSCRIPTION']) ?></td>
                    <td>
                        <?= $inactive_user['derniere_connexion'] ? htmlspecialchars($inactive_user['derniere_connexion']) : 'Jamais connecté' ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Aucun utilisateur inactif trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
