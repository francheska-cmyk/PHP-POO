<?php
namespace Controller;

use Model\ModelArticle;
use View\ViewArticle;

class ControllerArticle{
    //ATTRIBUTS
    private ModelArticle $modelArticle;
    private ViewArticle $viewArticle;
    private ?string $titre;

    //CONSTRUCTOR
    public function __construct(ModelArticle $model, ViewArticle $view){
        $this->modelArticle = $model;
        $this->viewArticle = $view;
    }

    //Getter et Setter

    //METHODS
    public function render():void{
        //1. Appel du model pour récupérer les données des articles
        $data = $this->modelArticle->findAll();

        //2.Passage des data à la View et son Appel pour afficher les data traitées
        $this->viewArticle->setDataArticles($data)
            ->displayAll();
    }
}