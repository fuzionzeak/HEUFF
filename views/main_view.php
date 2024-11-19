<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Dernières News</title>
    <link rel="stylesheet" href="/HEUFF/css/style.css">
</head>
<body>

<h1>Dernières News</h1>

<div class="news-container">
    <?php if (!empty($newsList)): ?>
        <?php foreach ($newsList as $news): ?>
            <div class="news-item">
                <h2><?= htmlspecialchars($news->getTitre()) ?></h2>
                <p class="meta">
                    Publié le <?= htmlspecialchars($news->getDate()) ?> | 
                    Club : <?= htmlspecialchars($news->getNomClub()) ?>
                </p>
                <p><?= nl2br(htmlspecialchars($news->getArticle())) ?></p>

                <!-- Affichage des commentaires -->
                <div class="comments">
                    <h3>Commentaires :</h3>
                    <?php if (!empty($news->getCommentaires())): ?>
                        <?php foreach ($news->getCommentaires() as $comment): ?>
                            <p>
                                <strong><?= htmlspecialchars(($comment['NOM_UTI'] ?? 'Utilisateur') . ' ' . ($comment['PRENOM_UTI'] ?? 'Anonyme')) ?> :</strong>
                                <?= htmlspecialchars($comment['CONTENU_COMMENTAIRE'] ?? 'Commentaire indisponible') ?>
                            </p>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucun commentaire pour cette news.</p>
                    <?php endif; ?>
                </div>


                <!-- Formulaire pour ajouter un commentaire -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form action="index.php?page=add_comment" method="POST">
                        <input type="hidden" name="id_news" value="<?= htmlspecialchars($news->getId()) ?>">
                        <textarea name="contenu" rows="3" placeholder="Écrire un commentaire..." required></textarea>
                        <button type="submit">Poster</button>
                    </form>
                <?php else: ?>
                    <p><a href="index.php?page=page3">Connectez-vous</a> pour commenter cette news.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune news disponible pour le moment.</p>
    <?php endif; ?>
</div>

<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="index.php?page=main&p=<?= $page - 1 ?>">Précédent</a>
    <?php endif; ?>

    <?php if ($page < $totalPages): ?>
        <a href="index.php?page=main&p=<?= $page + 1 ?>">Suivant</a>
    <?php endif; ?>
</div>

</body>
</html>
