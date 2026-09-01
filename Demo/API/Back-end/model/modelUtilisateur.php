<?php
//Récupère la liste des utilisateurs en BDD
function lireUtilisateurs($bdd){
    //ATTENTION : on ne sélectionne JAMAIS le mot de passe pour une lecture publique.
    //Diffuser les hashs par l'API, c'est les offrir au bruteforce hors ligne.
    $req = $bdd->prepare('SELECT id, nom, prenom, pseudo, email, dob FROM utilisateurs');

    $req->execute();

    $data = $req->fetchAll(PDO::FETCH_OBJ);

    return $data;
}

function lireUtilisateursByPseudo($bdd, $pseudo){
    $req = $bdd->prepare('SELECT id, nom, prenom, pseudo, email, dob FROM utilisateurs WHERE pseudo = ?');

    $req->bindParam(1,$pseudo,PDO::PARAM_STR);

    $req->execute();

    $data = $req->fetchAll(PDO::FETCH_OBJ);

    return $data;
}

function lireUtilisateursByMail($bdd, $mail){
    //Ici on garde le mdp : cette fonction servira AUSSI à la connexion (password_verify).
    //C'est un bon exemple : une même table se lit différemment selon l'usage.
    $req = $bdd->prepare('SELECT id, nom, prenom, pseudo, email, mdp, dob FROM utilisateurs WHERE email = ?');

    $req->bindParam(1,$mail,PDO::PARAM_STR);

    $req->execute();

    $data = $req->fetchAll(PDO::FETCH_OBJ);

    return $data;
}

function enregistrerUtilisateur($bdd, $pseudo, $email, $mdp, $nom = NULL, $prenom = NULL, $dob = NULL){
    $req = $bdd->prepare('INSERT INTO utilisateurs (nom, prenom, dob, pseudo, email, mdp) VALUES (?,?,?,?,?,?)');
    
    //bindParam accepte NULL : PARAM_STR suffit, pas besoin de PDO::PARAM_NULL
    $req->bindParam(1,$nom,PDO::PARAM_STR);
    $req->bindParam(2,$prenom,PDO::PARAM_STR);
    $req->bindParam(3,$dob,PDO::PARAM_STR);
    //On bind le reste des champs obligatoires
    $req->bindParam(4,$pseudo,PDO::PARAM_STR);
    $req->bindParam(5,$email,PDO::PARAM_STR);
    $req->bindParam(6,$mdp,PDO::PARAM_STR);

    //Exécution de la requête.
    //ATTENTION : connect() configure PDO en ERRMODE_EXCEPTION. Dans ce mode, execute()
    //ne renvoie JAMAIS false : en cas d'erreur il LEVE une exception. C'est donc le
    //try/catch de la route qui la traitera, et pas un if sur la valeur de retour.
    $req->execute();
    
}


?>
