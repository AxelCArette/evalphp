<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


include('connexionbdd.php');
include('header.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['userEmail']) && !empty($_POST['pswd'])) {
        $email = $_POST['userEmail'];
        $password = $_POST['pswd'];

        $sql = "SELECT * FROM `user` WHERE userEmail = :email";
        $query = $db->prepare($sql);
        $query->bindValue(":email", $email, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();

        if ($user && password_verify($password, $user['pswd'])) {
            // Connexion réussie
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header('Location: produit.php');
            exit();
        } else {
            $error_message = 'Identifiants incorrects. Veuillez réessayer.';
        }
    } else {
        $error_message = 'Veuillez remplir tous les champs.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <div class="formulaire">
        <form action="" method="post">
            <h2>Connexion</h2>

            <label for="userEmail">Adresse mail :</label>
            <input type="email" id="userEmail" name="userEmail" required>

            <label for="pswd">Mot de passe :</label>
            <input type="password" id="pswd" name="pswd" required>

            <button type="submit">Connexion</button>
        </form>
    </div>
</body>
</html>
