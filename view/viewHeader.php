<?php
namespace View;

//Class ViewHeader
class ViewHeader{
    //ATTRIBUTS
    private ?string $title;
    private ?string $linkScript;
    private ?string $buffer;

    //CONSTRUCTOR
    public function __construct(?string $title = "Mon Super Site", ?string $linkScript = ''){
        $this->title = $title;
        $this->linkScript = $linkScript;
    }

    //GETTER ET SETTER

    //METHOD
    //Méthode pour mettre en mémoire tampon un template HTML
    public function launchBuffer():self{
        ob_start();
?>
        <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title> <?php echo $this->title ?></title>
                <link rel="stylesheet" href="./public/src/css/style.css">
                <script src=" <?php echo $this->linkScript ?>" defer></script>
            </head>
            <body>
                <header>
                    <nav>
                        <a href=<?php echo $_ENV['utilisateurs'] ?> >Utilisateurs</a>
                        <a href=<?php echo $_ENV['articles'] ?> >Articles</a>
                    </nav>
                </header>
<?php
        $this->buffer = ob_get_clean();
        return $this;
    }

    //Method pour afficher le contenu de la mémoire tampon
    public function display():void{
        echo $this->buffer;
    }
}

?>