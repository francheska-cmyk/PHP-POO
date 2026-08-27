<?php
namespace View;

class ViewArticle{
    //ATTRIBUT
    private string $listArticles = '';
    private ?array $dataArticles;
    private ViewFooter $viewFooter;
    private ViewHeader $viewHeader;
    private ?string $buffer; 

    //CONSTRUCTOR
    public function __construct(){
        $this->viewFooter = new ViewFooter();
        $this->viewHeader = new ViewHeader("Articles","./public/src/script/scriptArticle.js");
    }

    //GETTER ET SETTER
    // Le Controlleur a besoin de cette méthode public pour donner les data des articles depuis le Model à la View
    public function setDataArticles(array $newArticles):self{
        $this->dataArticles = $newArticles;
        return $this; //return $this (l'objet en cours) est pratique pour utiliser du chaînage de méthode
    }

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
                    foreach($this->dataArticles as $row){
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
        $this->buffer = ob_get_clean();

        //Retour de l'objet pour permettre le chaînage de méthode
        return $this;
    }

    //MEthod pour afficher uniquement le HTML dédié à cette view
    public function display(){
        echo $this->buffer;
    }

    //Method pour recomposer l'entièreté de la page
    public function displayAll():void{
        $this->viewHeader->launchBuffer()->display();
        $this->launchBuffer()->display();
        $this->viewFooter->launchBuffer()->display();
    }

}


?>
