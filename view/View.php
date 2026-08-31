<?php
namespace View;

class View {
    //ATTRIBUTS
    private ?array $data;
    private ViewFooter $viewFooter;
    private ViewHeader $viewHeader;
    private string $buffer = '';

    //CONSTRUCTOR
    public function __construct(string $title, string $link){
        $this->viewFooter = new ViewFooter();
        $this->viewHeader = new ViewHeader($title, $link);
    }

    //GETTER et SETTER
    public function getData():?array{
        return $this->data;
    }

    public function setData(array $newData):self{
        $this->data = $newData;
        return $this;
    }

    public function getBuffer():?string{
        return $this->buffer;
    }

    public function setBuffer(string $newBuffer):self{
        $this->buffer = $newBuffer;
        return $this;
    }

    //METHODS
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