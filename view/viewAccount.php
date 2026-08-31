<?php
//La View pour la page Mon Compte
namespace View;

use View\View;

class ViewAccount extends View {
    //ATTRIBUT

    //CONSTRUCTOR

    //GETTER ET SETTER

    //METHODS
    //la méthode qui stocket en mémoire tampon le HTML à afficher
    public function launchBuffer():self{
        $data = $this->getData();
        ob_start();
?>
        <main>
            <h1>Mon Compte Utilisateur</h1>
            <h2> Pseudo : <?php echo $data['pseudo'] ?></h2>
            <h2> Email : <?php echo $data['email'] ?></h2>
            <h2> Role : <?php echo $data['role'] ?></h2>
        </main>
<?php
        //Récupération du HTML à afficher dans l'Attribur Buffer commun à toutes les Views (voir la class View)
        $this->setBuffer(ob_get_clean());
        //Retour de l'objet entier pour permettre le chaînage de méthode
        return $this;
    }
}