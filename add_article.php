<?php
include('connexionbdd.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('header.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article'])) {
    // Valider et traiter les données d'ajout d'article
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $prix = $_POST['prix'];

    $sql = "INSERT INTO article (nom, description, image, prix) VALUES (:nom, :description, :image, :prix)";
    $query = $db->prepare($sql);

    $query->bindParam(':nom', $nom);
    $query->bindParam(':description', $description);
    $query->bindParam(':image', $image);
    $query->bindParam(':prix', $prix);

    if ($query->execute()) {
        echo 'Article ajouté avec succès.';
    } else {
        echo 'Erreur lors de l\'ajout de l\'article.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Article</title>
    <!-- Vous pouvez ajouter vos propres styles ici -->
</head>
<body>

<div>
    <h2>Ajouter un Article</h2>

    <form method="post" action="add_article.php">
        <div>
            <label for="nom">Nom de l'article:</label>
            <input type="text" id="nom" name="nom" required>
        </div>

        <div>
            <label for="description">Description de l'article:</label>
            <textarea id="description" name="description" required></textarea>
        </div>

        <div>
            <label for="image">URL de l'image:</label>
            <input type="text" id="image" name="image" required>
        </div>

        <div>
            <label for="prix">Prix de l'article:</label>
            <input type="number" id="prix" name="prix" required>
        </div>

        <button type="submit" name="add_article">Ajouter</button>
    </form>
</div>

</body>
</html>
