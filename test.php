<?php
include('connexionbdd.php');

// Sélectionnez tous les articles depuis la base de données
$sql_select_articles = "SELECT id, nom, description, image, prix FROM article";
$query_select_articles = $db->query($sql_select_articles);
$articles = $query_select_articles->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Articles</title>
</head>
<body>

<nav>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <h2><?= $article['nom'] ?></h2>
                <p><?= $article['description'] ?></p>
                <img src="<?= $article['image'] ?>" alt="<?= $article['nom'] ?>">
                <p>Prix: <?= $article['prix'] ?> €</p>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

</body>
</html>
