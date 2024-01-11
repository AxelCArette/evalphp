<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connexionbdd.php');
include('header.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !empty($_POST['userName']) && 
        !empty($_POST['userFirstName']) && 
        !empty($_POST['userEmail']) && 
        !empty($_POST['pswd']) && 
        !empty($_POST['userVerifPswd'])
    ) {
        // On récupère les infos du formulaire et les stocke dans des variables
        $nom = $_POST['userName'];
        $prenom = $_POST['userFirstName'];
        $email = $_POST['userEmail'];
        $pswd = $_POST['pswd'];
        $verifPswd = $_POST['userVerifPswd'];

        // Vérifie si l'adresse e-mail existe déjà
        $sql = "SELECT * FROM `user` WHERE userEmail = :email";
$query = $db->prepare($sql);
$query->bindValue(":email", $email, PDO::PARAM_STR);
$query->execute();
$verifEmail = $query->fetch();


        if ($verifEmail === false) {
            // Vérification des 2 mots de passe identiques
            if ($pswd === $verifPswd) {
                // Hachage du mot de passe
                $motdepassehash = password_hash($pswd, PASSWORD_DEFAULT);

                // Insertion des données dans la base de données
                $requete = 'INSERT INTO `user`(`userName`, `userFirstName`, `userEmail`, `pswd`) VALUES (:userName, :userFirstName, :userEmail, :pswd)';
                $query = $db->prepare($requete);

                // Association d'une valeur à un paramètre de l'objet PDOStatement
                $query->bindValue(':userName', $nom, PDO::PARAM_STR);
                $query->bindValue(':userFirstName', $prenom, PDO::PARAM_STR);
                $query->bindValue(':userEmail', $email, PDO::PARAM_STR);
                $query->bindValue(':pswd', $motdepassehash, PDO::PARAM_STR);

                $query->execute();

                // Fermeture du curseur : la requête peut être de nouveau exécutée
                $query->closeCursor();

            } else {
                echo 'Les mots de passe ne correspondent pas. Veuillez réessayer.';
            }
        } else {
            echo 'Adresse e-mail déjà utilisée. Veuillez choisir une autre adresse e-mail.';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <div class="formulaire">
        <form action="" method="post">
            <h2>Inscription</h2>
            <label for="userName">Nom :</label>
            <input type="text" id="userName" name="userName" required>

            <label for="userFirstName">Prénom :</label>
            <input type="text" id="userFirstName" name="userFirstName" required>

            <label for="userEmail">Adresse mail :</label>
            <input type="email" id="userEmail" name="userEmail" required>

            <label for="pswd">Mot de passe :</label>
            <input type="password" id="pswd" name="pswd" required>

            <label for="userVerifPswd">Vérification du mot de passe :</label>
            <input type="password" id="userVerifPswd" name="userVerifPswd" required>

            <button type="submit">Inscription</button>
        </form>
    </div>
</body>
</html>
