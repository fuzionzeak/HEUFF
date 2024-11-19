<?php

class Router {
    private array $routes;

    public function __construct() {
        $this->routes=[]; // creation d'un tableau vide
    }

    // Ajoute une route au routeur
    public function addRoute($url, $controllerFile) {
        $this->routes[$url] = $controllerFile;
    }

    // Traite la demande actuelle
    public function execute($url) {
        if (array_key_exists($url, $this->routes)) {
            // Si l'URL correspond à une route, incluez le fichier du contrôleur
            $controllerFile = $this->routes[$url];
            if (file_exists($controllerFile)) {
                include_once($controllerFile);
            } else {
                // Gérer les erreurs si le fichier du contrôleur n'existe pas
                echo "Erreur : Contrôleur non trouvé";
            }
        } else {
            // Gérer les erreurs 404 si l'URL n'est pas trouvée
            echo "Page non trouvée (Erreur 404)";
        }
    }
}


// Configuration du routeur
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home'; // Page par défaut
}

// Charger le contrôleur en fonction de la route
switch ($page) {
    case 'page1':
        require_once 'controller/c_page1.php';
        break;
    case 'page2':
        require_once 'controller/c_page2.php';
        break;
    case 'page3':
        require_once 'controller/c_page3.php';
        break;
    case 'page4' :
        require_once 'controller/c_page4.php';
        break;
    case 'admin_m1' :
        require_once 'controller/admin_m1.php';
        break;
    case 'admin_m2' :
        require_once 'controller/admin_m2.php';
        break;
    case 'admin_m3' :
        require_once 'controller/admin_m3.php';
        break;
    case 'mon_compte' :
        require_once 'controller/mon_compte.php';
        break;
    case 'deconnexion':  // Nouvelle case pour gérer la déconnexion
        require_once 'controller/deconnexion.php';
        break;
    case 'main':
        require_once 'controller/c_main.php';
        break;
    case 'news':
        require_once 'controller/c_news.php';
        break;
    case 'add_news':
        require_once 'controller/c_news.php';
        break;
    case 'add_comment':
        require_once 'controller/c_add_comment.php';
        break;
    default:
        echo "Page non trouvée.";
        break;
}
