<?php
namespace Model;

use PDO;

class Model {
    //ATTRIBUT
    private PDO $bdd;

    //CONSTRUCTOR
    public function __construct(PDO $bdd){
        $this->bdd = $bdd;
    }

    //GETTER ET SETTER
    /** PHPDocs
    * getBDD() : renvoie l'objet de connexion PDO
    * @return PDO
    */
    public function getBDD():PDO{
        return $this->bdd;
    }

    /**
     * setBDD(): modifie l'attribut bdd de l'objet
     * @param PDO $bdd
     * @return self
     */
    public function setBDD(PDO $bdd):self{
        $this->bdd = $bdd;
        return $this;
    }
}