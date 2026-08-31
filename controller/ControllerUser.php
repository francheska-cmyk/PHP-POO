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

    public function registerUser():void{
        //Vérifier si je reçoit le formulaire d'inscription
        if(isset($_POST['submitInscription'])){
            //Vérifier les champs vides
            if(empty($_POST['pseudoInscription']) || empty($_POST['emailInscription']) || empty($_POST['passwordInscription']) || empty($_POST['passwordVerify'])){
                $this->getView()->setMessage('Veuillez remplir tous les champs.');
                return;
            }

            //Vérifier le format de l'email
            if(!filter_var($_POST['emailInscription'], FILTER_VALIDATE_EMAIL)){
                $this->getView()->setMessage("L'Email n'est pas au bon format.");
                return;
            }

            //Vérifier la concordance des mots de passe
            if($_POST['passwordInscription'] !== $_POST['passwordVerify']){
                $this->getView()->setMessage("Vos mots de passe ne correspondent pas.");
                return;
            }

            //Nettoyer les données
            $pseudo = Utils::sanitize($_POST['pseudoInscription']);
            $email = Utils::sanitize($_POST['emailInscription']);
            $password = Utils::sanitize($_POST['passwordInscription']);

            //Hasher le mot de passe
            $password = password_hash($password, PASSWORD_DEFAULT);

            //Je vais fournir au modèle ces données
            $this->getModel()->setPseudo($pseudo)->setEmail($email)->setPassword($password);

            //Vérifier si le pseudo est libre
            $data = $this->getModel()->findByPseudo();
            if($data){
                $this->getView()->setMessage("Ce pseudo n'est pas disponible.");
                return;
            }

            //Vérifier si l'email est libre
            $data = $this->getModel()->findByEmail();
            if($data){
                $this->getView()->setMessage("Cet email est déjà pris.");
                return;
            }

            //Lancement de l'insertion en BDD
            $this->getModel()->addUser();

            $this->getView()->setMessage("Vous avez bien été enregistré.");
        }
    }

    //polymorphisme de la méthode render 
    public function render():void{
        // Vérifier si l'utilisateur est connecté pour ne pas afficher les formulaires
        
    }

}


