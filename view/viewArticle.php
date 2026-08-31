<?php
namespace View;

use View\View;

class ViewArticle extends View{
    //ATTRIBUT

    //CONSTRUCTOR

    //GETTER ET SETTER
    

    //METHODS
    //Methode pour mettre le code HTML en mémoire tampon
    public function launchBuffer():self{
        //Lancement de la mise en mémoire tampon
        ob_start();
?>
            <main>
                <h1>Liste des Articles</h1>
                <ul>
<?php
                    //Boucle d'affichage du tableau de donnée des articles au sein du template HTML
                    foreach($this->getData() as $row){
?>
                        <article>
                            <h2> <?= $row['title'] ?></h2>
                            <h3>By : <?= $row['pseudo'] ?></h3>
                        </article>
<?php
                    }
?>
                </ul>
            </main>
<?php
        //Récupération du Buffer et nettoyage de ce dernier
        $this->setBuffer(ob_get_clean());

        //Retour de l'objet pour permettre le chaînage de méthode
        return $this;
    }

}


?>