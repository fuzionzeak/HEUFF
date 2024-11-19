<?php
namespace Model;

class News {
    private $id;
    private $titre;
    private $article;
    private $date;
    private $idClub;
    private $nomClub;
    private $commentaires = [];

    public function __construct($id, $titre, $article, $date, $idClub, $nomClub = null) {
        $this->id = $id;
        $this->titre = $titre;
        $this->article = $article;
        $this->date = $date;
        $this->idClub = $idClub;
        $this->nomClub = $nomClub;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getArticle() {
        return $this->article;
    }

    public function getDate() {
        return $this->date;
    }

    public function getIdClub() {
        return $this->idClub;
    }

    public function getNomClub() {
        return $this->nomClub;
    }

    public function getCommentaires() {
        return $this->commentaires;
    }

    public function setCommentaires(array $commentaires) {
        $this->commentaires = $commentaires;
    }
}
