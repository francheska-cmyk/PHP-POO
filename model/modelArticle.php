<?php
namespace Model;

use PDO;
use Exception;
use Model\Model; 

class ModelArticle extends Model{
    //ATTRIBUT
    private ?int $id;
    private ?string $title;
    private ?string $content;
    private ?string $createdAt;
    private ?string $editedAt;
    private ?string $author;


    //GETTER ET SETTER

    //METHODS
    public function findAll():?array{
        try{
            //1. Preparer la requête
            $request = 'SELECT a.id, a.title, a.content, a.created_at, a.edited_at, u.pseudo FROM article a INNER JOIN user u ON u.id = a.user_id';

            $req = $this->getBDD()->prepare($request);
            //2. Exécution de la requête
            $req->execute();

            //3. Retourner les données
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){
            die($error->getMessage());
        }
    }
}
