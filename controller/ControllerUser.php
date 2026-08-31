<?php
//CONTROLLER
//Indication de l'espace de nom possédant la class ControllerUser
namespace Controller;

/*Bonne pratique des namespaces :
- utiliser un namespace identique au nom du dossier
- La première lettre de chaque lettre d'un namespace commence par une Majuscule
=> le nom du dossier doit commencer par une Majuscule
- Le nom du fichier doit être identique au nom de la class, majuscule comprise
*/

use Controller\Controller;
use Utils\Utils;

class ControllerUser extends Controller{
    //ATTRIBUTS

    //CONSTRUCTEUR
    

    //GETTER ET SETTER
    

    //METHODS
    public function seConnecter():void{
        //1. Vérifier que l'on reçoive le formulaire de connexion
        if(isset($_POST['submitConnexion'])){
            
            //2. Vérifier les champs : champs vide, format des données, nettoyage
            if(empty($_POST['email']) || empty($_POST['password'])){
                $this->getView()->setMessage('Veuillez remplir tous les champs');
                return;
            }
                
            //Vérification du format d'email
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                $this->getView()->setMessage('Email pas au bon format');
                return;
            }

            //Nettoyer mes datas
            $email = Utils::sanitize($_POST['email']);
            $password = Utils::sanitize($_POST['password']);

            //3. Demander au model d'aller trouver le compte utilisateur
            //a. Donner l'email au Model, puis le Model lance findByEmail
            $data = $this->getModel()->setEmail($email)->findByEmail();

            //b. Vérifier la réponse : si je reçois un tableau de donnée utilisateur, ou un false
            if(!$data){
                $this->getView()->setMessage('Email et/ou Mot de Passe incorrect');
                return;
            }

            //4. Vérifier les mots de passe
            if(!password_verify($password, $data['password'])){
                //si l'email ne correspond à aucun compte
                $this->getView()->setMessage('Email et/ou Mot de Passe incorrect');
                return;
            }
                            
            //5. Connecter l'utilisateur
            $_SESSION['id'] = $data['id'];
            $_SESSION['pseudo'] = $data['pseudo'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['role'] = $data['role'];
            $_SESSION['createdAt'] = $data['created_at'];

            //6. Afficher le message de confirmation
            $this->getView()->setMessage('Vous êtes bien connecté. Youpie !');
        }            
    }
}