<?php
namespace View;

use View\View;

class ViewUser extends View{
    //ATTRIBUT

    //CONSTRUCTEUR

    //GETTER ET SETTER
    
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
                foreach($this->getData() as $row){
?>
                    <li>Pseudo : <?= $row['pseudo'] ?> - Email : <?= $row['email'] ?> - Role : <?= $row['role'] ?></li>
<?php    
                }
?>
                </ul>
            </main>
<?php
        //Récupération du buffer dans la propriété $this->buffer
        $this->setBuffer(ob_get_clean());
        return $this;
    }

}