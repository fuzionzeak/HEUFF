<?php
namespace Model;
use PDO;

class GestionCommentaires {
    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

    // Ajouter un commentaire
    public function ajouterCommentaire($idNews, $idUser, $contenu) {
        $stmt = $this->cnx->prepare("
            INSERT INTO COMMENTAIRES (ID_NEWS, ID_UTI, CONTENU_COMMENTAIRE, DATE_COMMENTAIRE)
            VALUES (:id_news, :id_uti, :contenu, NOW())
        ");
        $stmt->bindParam(':id_news', $idNews, PDO::PARAM_INT);
        $stmt->bindParam(':id_uti', $idUser, PDO::PARAM_INT);
        $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        return $stmt->execute();
    }
    

    // Récupérer les commentaires d'une news
    public function getCommentairesParNews($idNews) {
        $stmt = $this->cnx->prepare("
            SELECT c.CONTENU_COMMENTAIRE, c.DATE_COMMENTAIRE, u.NOM_UTI, u.PRENOM_UTI 
            FROM COMMENTAIRES c
            JOIN UTILISATEUR u ON c.ID_UTI = u.ID_UTI
            WHERE c.ID_NEWS = :id_news
            ORDER BY c.DATE_COMMENTAIRE DESC
        ");
        $stmt->bindParam(':id_news', $idNews, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
