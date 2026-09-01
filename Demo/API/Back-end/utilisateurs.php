<?php
// Pour récuperer liste des utilisateurs et l'envoyer au client 
// Fais office de controler ici (possède toute la logique client)


//inclure les ressources dont j'ai besoin pour faire fonctionner mon service / ma route
include './env.php';
include './utils/functions.php';
include './model/modelUtilisateur.php';

//mise en place de la fonction listeUtilisateurs()
function listeUtilisateurs($host,$dbname,$login,$password){

    //1. Headers requis (pour savoir qui a le droit d'accéder au service)
    // Accès depuis n'importe quel site ou appareil (*)
    header("Access-Control-Allow-Origin: *"); //(*) signifie l'entièrete du public

    // Format des données envoyées par le client (les données que le service accepte)
    header("Content-Type: application/json; charset=UTF-8");

    // Méthodes autorisées
    header("Access-Control-Allow-Methods: GET, OPTIONS");

    // Durée de vie de la requête lié à la requête Preflight, celle qui utilise la méthode OPTIONS. 
    // But : envoie requête pour tester autorisation d'accès. Intérêt : économie de ressources et éviter de surcharger service
    header("Access-Control-Max-Age: 3600");

    // Vérifier Entêtes autorisées au sein de la requête client 
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    //2. Vérification des METHODS HTTP
    // Réponse au preflight envoyé par le navigateur
    if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){ // On vérifie si la requête reçue par la SERVEUR du client a été envoyée en appliquant la méthode 'OPTIONS'. Verifie si la méthode HTTP envoyé par le client est égale à 'OPTIONS'. 
        http_response_code(204); // Tout s'est bien passé, mais je n'ai pas de contenu à t'envoyer. 
        return;
    }

    // Vérification de la méthode : si ce n’est pas la bonne, on renvoie une erreur
    // Le but de la route étant de lire les données, la réponse attendue est un METHOD GET
    if($_SERVER['REQUEST_METHOD'] != 'GET'){
        http_response_code(405);        
        echo json_encode(["message" => "La méthode n'est pas autorisée"]);
        return;
    }

    // 3. Mise en place de l'algo du service 
    //gestion d'erreur Try...Catch

    try{
        //A.Connexion à la BDD
        $bdd = connect($host,$dbname,$login,$password);

        //B.Récupération de la liste des utilisateurs
        $data = lireUtilisateurs($bdd);

        //C.Envoi des données au Client 
        // Code de réponse HTTP : 200 car la requête a aboutit avec succès
        http_response_code(200);
        // Encodage en JSON + affichage echo chez le client
        echo json_encode($data);
        return; //(juste pour sortir automatiquement de la fonction )

    }catch(Exception $error){
        //Une API doit répondre en JSON MEME quand elle plante
        http_response_code(500);
        //On n'envoie jamais $error->getMessage() : cela exposerait la structure de la BDD
        echo json_encode(["message" => "Une erreur est survenue"]);
        return;
    }
}                                               

// Lancement de la fonction vérifier que tout fonctionne
listeUtilisateurs($_ENV['dbhost'],$_ENV['dbname'],$_ENV['dblogin'],$_ENV['dbpassword']);