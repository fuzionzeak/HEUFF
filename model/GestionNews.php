<?php
namespace Model;

use PDO;
use Model\News;

class GestionNews {
    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

    // Ajouter une news
    public function ajouterNews($titre, $article, $idClub) {
        $stmt = $this->cnx->prepare("
            INSERT INTO NEWS (TITRE, ARTICLE_NEWS, ID_CLUB, DATE_NEWS)
            VALUES (:titre, :article, :id_club, NOW())
        ");
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':article', $article);
        $stmt->bindParam(':id_club', $idClub, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Récupérer les news avec pagination
    public function getNewsPaginated($limit, $offset) {
        $stmt = $this->cnx->prepare("
            SELECT N.ID_NEWS, N.TITRE, N.ARTICLE_NEWS, N.DATE_NEWS, N.ID_CLUB, C.NOM_CLUB
            FROM NEWS N
            LEFT JOIN CLUB C ON N.ID_CLUB = C.ID_CLUB
            ORDER BY N.DATE_NEWS DESC
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Convertir en objets News
        $newsList = [];
        foreach ($results as $row) {
            $newsList[] = new News(
                $row['ID_NEWS'],
                $row['TITRE'],
                $row['ARTICLE_NEWS'],
                $row['DATE_NEWS'],
                $row['ID_CLUB'],
                $row['NOM_CLUB']
            );
        }

        return $newsList;
    }

    // Compter le nombre total de news
    public function countNews() {
        $stmt = $this->cnx->query("SELECT COUNT(*) FROM NEWS");
        return $stmt->fetchColumn();
    }
}
