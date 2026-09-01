//Exploitation de l'API, route utilisateurs.php

//1. Fetch()
const API = async() =>{
    let response = await fetch('http://localhost:8000/Demo/API/Back-end/utilisateurs.php',{
        method : "GET", //Méthode HTTP utilisé
//         body : JSON.stringify ({//Envoie de données au format JSON au seun du Body pour les méthodes POST, PUT, ET DELETE
//             nom : 'DEPRIESTER',
//             prenom : 'Yoann',
//             pseudo: 'yoyo',
//             password: '12345'
// })
    }); 
//2.Récupératin des données
    let data = await response.json();
//3.exploitation des donées
    console.log(data);
}

API();