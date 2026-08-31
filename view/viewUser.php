<?php
namespace View;

use View\View;

class ViewUser extends View{
        private string $message = '';
    //ATTRIBUT

    //CONSTRUCTEUR

    //GETTER ET SETTER
    public function setMessage(string $newMessage):self{
        $this->message = $newMessage;
        return $this;
    }
    
    //METHODS
    //Mise en mémoire tampon
    public function launchBuffer():self{
        //1. traitement des données pour affichage 
        // foreach($this->dataUsers as $row){
        //         $this->listUsers .="<li>Pseudo :".$row['pseudo']." - Email : ".$row['email']." - Role :".$row['role']."</li>";
        // };

        ob_start();
?>
            <main>
<!-- TODO : tester la SESSION pour afficher les 2 formulaire lorsque l'on n'est pas connecté -->
                <?php 
                    if(isset($_SESSION) && !empty($_SESSION)){
                        ?>
                                <a href=<?php echo $_ENV['moncompte'] ?> >Mon Compte</a>
                                <a href=<?php echo $_ENV['deconnexion'] ?> >Se Déconnecter</a>
                        <?php
                            }
                        ?>

                <h2>Connexion</h2>
                    <form action="" method="post">
                        <label for="email">Votre Email<input type="text" id="email" name="email"></label>
                        <label for="password">Votre Mot de Passe<input type="password" id="password" name="password"></label>
                        <input type="submit" name="submitConnexion" value="Se Connecter">
                    </form>
                    <p><?php echo $this->message ?></p>

                <h2>Formulaire d'inscription</h2>
                <form action="" method="post">
                        <label for="pseudo">Votre pseudo<input type="text" id="pseudo" name="pseudo"></label>
                        <label for="email">Votre Email<input type="text" id="email" name="email"></label>
                        <label for="password">Votre Mot de Passe<input type="password" id="password" name="password"></label>
                        <label for="passwordConfirmed">Confirmez votre mot de passe<input type="password" id="passwordConfirmed" name="passwordConfirmed"></label>
                        <input type="submit" name="submitInscription" value="Créer un compte">
                    </form>
                    <p><?php echo $this->message ?></p>

                <h2>Liste des utilisateurs</h2>
                <ul>
                <?php  
                // inclusion de la boucle foreach effectuer en 1. (plus haut) au sein du template HTML mis en buffer
                foreach($this->getData() as $row){
                ?>
                    <li>Pseudo : <?= $row['pseudo'] ?> - Email : <?= $row['email'] ?> - Role : <?= $row['role'] ?></li>
                <?php    
                }
                ?>
                </ul>

            </main>
<?php
        //Récupération du buffer dans la propriété $this->buffer
        $this->setBuffer(ob_get_clean());
        return $this;
    }

}