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

use Model\ModelUser;
use View\ViewUser;
use Utils\Utils; 
class ControllerUser{
    //ATTRIBUTS
    private ModelUser $modelUser;
    private ?ViewUser $viewUser;
    private ?string $titre;
  

    //CONSTRUCTEUR
    public function __construct(ModelUser $model, ViewUser $view){
        $this->modelUser = $model;
        $this->viewUser = $view;
    }

    //GETTER ET SETTER
    public function setTitre($newTitre):self{
        $this->titre = newTitre;
        return $this;
    }
    public function getTitre(){
        return $this->titre;
    }
    /**
     * Get the value of modelUser
     *
     * @return ModelUser
     */
    public function getModelUser(): ModelUser {
        return $this->modelUser;
    }

    /**
     * Set the value of modelUser
     *
     * @param ModelUser $modelUser
     *
     * @return self
     */
    public function setModelUser(ModelUser $modelUser): self {
        $this->modelUser = $modelUser;
        return $this;
    }

    /**
     * Get the value of viewUser
     *
     * @return ?ViewUser
     */
    public function getViewUser(): ?ViewUser {
        return $this->viewUser;
    }

    /**
     * Set the value of viewUser
     *
     * @param ?ViewUser $viewUser
     *
     * @return self
     */
    public function setViewUser(?ViewUser $viewUser): self {
        $this->viewUser = $viewUser;
        return $this;
    }

    //METHODS
    public function render(){
        //Appel du model pour récupération des données
        $data = $this->modelUser->findAll();

        //2. Fournir les datas à la viewUser
        $this->viewUser->setDataUsers($data);

        //Appel de la view pour effectuer l'affichage
        $title = "Mes Utilisateurs";
        $this->viewUser->displayAll();
    }

    public function seConnecter() :void{
        //verifier si le formulaire est soumis
        if (isset ($_POST["submit"])) {
            //test si les 3 champs sont remplis
            if (
                !empty($_POST["pseudo"]) &&
                !empty($_POST["email"]) &&
                !empty($_POST["password"]))
            {
        //verifier le format des données
                if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                    {
                 //nettoyer les données
                    $email = Utils::sanitize($_POST["email"]); 
                    $pseudo = Utils::sanitize($_POST["pseudo"]);
                    $password= Utils::sanitize($_POST["password"]);
                    // $_POST = sanitize_array($_POST);
                    //appel de ModelUser pour récuperer email avec la  la méthode findByEmail
                    $user = $this -> getModel()->setEmail($email)->findByEmail(); 
                    // $user = $this->ModelUser->findByEmail($_POST["email"]);
                    //verifier si l'email existe
                    if(!empty($user)){
                    //verifier le mot de passe 
                        if(password_verify($password, $user["password"])){
                            //connexion de l'utilisateur avec super globale $_SESSION
                            //Attention il faut démarrer la session dans index qui est notre routeur pour accéder à la SESSION
                            // $_SESSION["status"]=true; 
                            $_SESSION["email"] =$user["email"]; 
                            $_SESSION["pseudo"] =$user["pseudo"]; 
                            $_SESSION["role"] =$user["role"]; 
                            $_SESSION["created_at"] =$user["created_at"]; 
                            $_SESSION["id"] =$user["id"]; 
                            $this->getviewUser()->setMessage("Connexion réussie"); 
                            } else {
                                $this->getviewUser()->setMessage('Les informations de connexion sont incorrectes'); 
                            }
                        } else {
                            $this->getviewUser()->setMessage("Les informations de connexion sont incorrectes"); 
                        }
                    } else {
                        $this->getviewUser()->setMessage("L'email est invalide");
                    }
                    }else{
                        $this->getviewUser()->setMessage("Veuillez remplir tous les champs");
            }
        }
        // include './view/viewUser.php';

    }
}
