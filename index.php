<?php
//ROUTEUR
//Autoloader Manuel (sans Composer)
//ATTENTION : les espaces de noms de vos class doivent respecter la nomeclature des dossiers et des fichiers.
// spl_autoload_register(function (string $fqcn): void {
//     // "Controller\ControllerUser" -> "D:\...\MVC\Controller\ControllerUser.php"
//     $chemin = __DIR__ . DIRECTORY_SEPARATOR
//             . str_replace('\\', DIRECTORY_SEPARATOR, $fqcn)
//             . '.php';

//     if (is_file($chemin)) {
//         require_once $chemin;
//     }
// });

//Autoloader de Composer
//AVANTAGE : les namespaces n'ont plus besoin de se conformer à l'arborescence
//De plus, il est possible de faire un auto-include des fichiers ne comportant pas de class (voir composer.json)
//1. Créer le fichier composer.json
//2. Dans un terminal ouvert dans votre projet, lancer composer install  (pour intaller le dossier ./vendor)
//3. Ajouter le dossier ./vendor au .gitignore
//4. require du fichier php qui s'occupera de l'autoload
require_once __DIR__ . '/vendor/autoload.php';

//import des ressources : obsolète depuis l'autoloader de Composer
// include('./env.php');
// include('./utils/utils.php');
// include('./Model/ModelUser.php');
// include('./Model/ModelArticle.php');
// include('./view/viewFooter.php');
// include('./view/viewHeader.php');
// include('./view/viewUser.php');
// include('./view/viewArticle.php');
// include('./Controller/ControllerArticle.php');

//Utilisation du namespace pour le ControllerUser
//Point important : pour utiliser une class provenant d'un espace de nom, je dois absolument include (ou require) le fichier contenant la classe en question
//include('./Controller/ControllerUser.php');

use Controller\ControllerUser as MonUser; // avec AS je fourni un alias au nom de ma classe
use Controller\ControllerArticle;
use Model\ModelUser;
use Model\ModelArticle;
use View\ViewUser;
use View\ViewArticle;
use Utils\Utils;

//1. Récupérer l'url demandé par l'utilisateur
$url = parse_url($_SERVER['REQUEST_URI']);

//2. Récupérer le path de l'url : ceux qui vient après le nom de domaine
$path = isset($url['path']) ? $url['path'] : '/';

//3. Appeler le Controller lié à la route demandée
switch ($path) {
    case '/':
    case $_ENV['utilisateurs']:
        // utilisation de l'alias pour le Controller\ControllerUser
        $controller = new MonUser(new ModelUser(Utils::connect()), new ViewUser());
        $controller->render();
        break;
    case $_ENV['articles'] :
        $controller = new ControllerArticle(new ModelArticle(Utils::connect()), new ViewArticle());
        $controller->render();
        break;
    default:
        echo "erreur 404";
        break;
}
