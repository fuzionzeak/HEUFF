<?php
namespace Model;
use PDO;

class GestionUser {
    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

    // Rechercher un utilisateur par email
    public function getUserByEmail($email) {
        $stmt = $this->cnx->prepare("SELECT * FROM UTILISATEUR WHERE MAIL_UTI = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new User($data['ID_UTI'], $data['NOM_UTI'], $data['PRENOM_UTI'], $data['MAIL_UTI'], $data['PASSWORD_UTI']);
        }

        return null;
    }

    // Mettre à jour la date de dernière connexion
    public function updateLastConnection($userId) {
        $stmt = $this->cnx->prepare("UPDATE UTILISATEUR SET derniere_connexion = NOW() WHERE ID_UTI = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
