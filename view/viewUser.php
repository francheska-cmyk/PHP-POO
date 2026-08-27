<?php
namespace View;

class ViewUser{
    //ATTRIBUT
    //private string $listUsers = '';
    private ?array $dataUsers;
    private ViewFooter $viewFooter;
    private ViewHeader $viewHeader;
    private ?string $buffer;

    //CONSTRUCTEUR

    //GETTER ET SETTER
    public function setDataUsers(array $newData){
        $this->dataUsers = $newData;
        $this->viewFooter = new ViewFooter();
        $this->viewHeader = new ViewHeader("Utilisateurs","./public/src/script/scriptUser.js");
    }

    //METHODS
    //Mise en mémoire tampon
    public function launchBuffer():self{
        //1. traitement des données pour affichage 
        // foreach($this->dataUsers as $row){
        //         $this->listUsers .="<li>Pseudo :".$row['pseudo']." - Email : ".$row['email']." - Role :".$row['role']."</li>";
        // };

        ob_start();
?>
            <main>
                <h1>Liste des utilisateurs</h1>
                <ul>
<?php  
                // inclusion de la boucle foreach effectuer en 1. (plus haut) au sein du template HTML mis en buffer
                foreach($this->dataUsers as $row){
?>
                    <li>Pseudo : <?= $row['pseudo'] ?> - Email : <?= $row['email'] ?> - Role : <?= $row['role'] ?></li>
<?php    
                }
?>
                </ul>
            </main>
<?php
        //Récupération du buffer dans la propriété $this->buffer
        $this->buffer = ob_get_clean();
        return $this;
    }

    //Affichage du contenu de la mémoire tampon
    public function display():void{
        echo $this->buffer;
    }

    //Affichage de l'entièreté de la page
    public function displayAll():void{
        $this->viewHeader->launchBuffer()->display();
        $this->launchBuffer()->display();
        $this->viewFooter->launchBuffer()->display();
    }
}
