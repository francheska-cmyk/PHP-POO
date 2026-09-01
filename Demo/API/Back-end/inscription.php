<?php

//inclure les ressources dont j'ai besoin pour faire fonctionner mon service / ma route
include './env.php';
include './utils/functions.php';
include './model/modelUtilisateur.php';

//mise en place de la fonction inscrireUtilisateurs()
function inscrireUtilisateurs($host,$dbname,$login,$password){
    // Headers requis
    // Accès depuis n'importe quel site ou appareil (*)
    header("Access-Control-Allow-Origin: *");

    // Format des données envoyées
    header("Content-Type: application/json; charset=UTF-8");

    // Méthodes autorisées
    header("Access-Control-Allow-Methods: POST, OPTIONS");

    // Durée de vie de la requête
    header("Access-Control-Max-Age: 3600");

    // Entêtes autorisées
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        
    // Réponse au preflight envoyé par le navigateur
    if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
        http_response_code(204);
        return;
    }
// Vérification de la méthode
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        http_response_code(405);
        echo json_encode(["message" => "La méthode n'est pas autorisée"]);
        return;
    }

    //lecture des données reçu en JSON (ici $data est un objet)
    $data = json_decode(file_get_contents("php://input"));

    //Vérification du décodage : le body peut être vide ou le JSON malformé
    if(!is_object($data)){
        http_response_code(400);
        echo json_encode(["message" => "Corps de requête invalide ou absent"]);
        return;
    }
