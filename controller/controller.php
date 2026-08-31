<?php
namespace Controller;
use Model\Model;
use View\View;

//Class Controller regrouper le code commun à tous les Controller
class Controller{
    //ATTRIBUT
    private Model $model; //Peut contenir n'importe quelle class héritant de Model
    private View $view;

    //CONSTRUCTOR
    public function __construct(Model $model, View $view){
        $this->model = $model;
        $this->view = $view;
    }

    //GETTER ET SETTER
    public function getModel():Model{
        return $this->model;
    }

    public function setModel(Model $newModel):self{
        $this->model= $newModel;
        return $this;
    }

    public function getView():View{
        return $this->view;
    }

    public function setView(View $newView):self{
        $this->view = $newView;
        return $this;
    }

    //METHODS
    public function render():void{
        //1. Appel du model pour récupérer les données des articles
        $data = $this->model->findAll();

        //2.Passage des data à la View et son Appel pour afficher les data traitées
        $this->view->setData($data)->displayAll();
    }
}