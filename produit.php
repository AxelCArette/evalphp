<?php
include('connexionbdd.php');
include('header.php');

session_start();

$sql_select_articles = "SELECT id, nom, description, image, prix FROM article";
$query_select_articles = $db->query($sql_select_articles);
$articles = $query_select_articles->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image, Prix et Description</title>
    <link rel="stylesheet" href="styles.css">
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
                <form method="post" action="traitement_like.php">
            <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
            <!-- <button type="submit" name="like">Like</button> -->
        </form>
            </li>
        <?php endforeach; ?>




</nav>
</body>
</html>
