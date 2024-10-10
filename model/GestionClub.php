<<<<<<< HEAD
<<<<<<< HEAD
<?php

namespace Model;

use PDO;

class GestionClub {

    private PDO $cnx;

    // Constructeur qui prend la connexion PDO
    public function __construct(PDO $cnx) {
        $this->cnx = $cnx;
    }

    // Méthode pour récupérer tous les clubs de Ligue 1
    public function getAllClubs(): array {
        $sql = "SELECT ID_CLUB, NOM_CLUB, LIGUE_CLUB FROM CLUB WHERE LIGUE_CLUB = 'L1'";
        $stmt = $this->cnx->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
=======
<?php

namespace Model;

use PDO;

class GestionClub {

    private PDO $cnx;

    // Constructeur qui prend la connexion PDO
    public function __construct(PDO $cnx) {
        $this->cnx = $cnx;
    }

    // Méthode pour récupérer tous les clubs de Ligue 1
    public function getAllClubs(): array {
        $sql = "SELECT NOM_CLUB, LIGUE_CLUB FROM CLUB WHERE LIGUE_CLUB = 'L1'";
        $stmt = $this->cnx->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
>>>>>>> 45817e33f25d270d1a9a29bf228b1b53a0ac5675
=======
<?php

namespace Model;

use PDO;

class GestionClub {

    private PDO $cnx;

    // Constructeur qui prend la connexion PDO
    public function __construct(PDO $cnx) {
        $this->cnx = $cnx;
    }

    // Méthode pour récupérer tous les clubs de Ligue 1
    public function getAllClubs(): array {
        $sql = "SELECT NOM_CLUB, LIGUE_CLUB FROM CLUB WHERE LIGUE_CLUB = 'L1'";
        $stmt = $this->cnx->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
>>>>>>> 42ad1d4a2e39c27072b5bbdccbc2fabe720ec015
