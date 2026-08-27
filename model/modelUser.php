<?php
//Class ModelUser
namespace Model;

use Model\Model;
use PDO;

//extends : la propriété pour l'héritage. Ici ModelUser hérite de la class Model
class ModelUser extends Model{
    //ATTRIBUTS
    //les attributs d'un model doivent correspondrent aux champs de la table correspondante en BDD
    private ?int $id; // le ? signifie que l'attribut a le droit d'être null
    private ?string $pseudo;
    private ?string $email;
    private ?string $password;
    private ?string $createdAt;
    private ?string $role;

    //CONSTRUCTEUR

    //GETTER ET SETTER

    //METHODS
    public function findAll():?array{
        try{
            //1. Préparer une requête pour SELECT les utilisateurs
            //On utilise l'objet PDO stocké dans l'attribut bdd de notre model ($this->bdd)
            $req = $this->getBDD()->prepare('SELECT u.id, u.pseudo, u.email, u.password, u.created_at, r.role FROM user u INNER JOIN role r ON r.id = u.role_id');

            //2. Exécution de la requête
            $req->execute();

            //3. Return des données utilisateurs
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){
            die($error->getMessage());
        }
    }
}
