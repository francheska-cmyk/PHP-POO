<?php
//Controller de la page Mon Compte
namespace Controller;

use Controller\Controller;

class ControllerAccount extends Controller {
    //ATTRIBUTS

    //CONSTRUTOR

    //GETTER ET SETTER

    //METHODS
    //Polymorphisme de la méthode render(). En effet, on ne donne pas les données à la View de la même manière que le Controller parent
    public function render():void{
        //1. Tester la Session pour savoir si l'utilisateur a le droit d'accéder à cette page
        if(!isset($_SESSION) || empty($_SESSION)){
            header('location:'.$_ENV['utilisateurs']);
            exit;
        }

        //2. Passer les données à la View depuis la SESSION
        $this->getView()->setData($_SESSION);

        //3. Affichage de la View
        $this->getView()->displayAll();
    }
}