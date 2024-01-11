<?php
include('connexionbdd.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like'])) {
    $article_id = $_POST['article_id'];
    $user_id = $_SESSION['user_id'];

    // Ajoutez le like dans la base de données
    $sql_add_like = "INSERT INTO likes (id_user, id_article, shouait) VALUES (:user_id, :article_id, 1)";
    $query_add_like = $db->prepare($sql_add_like);
    $query_add_like->execute([':user_id' => $user_id, ':article_id' => $article_id]);

    // Redirigez l'utilisateur vers la page actuelle
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
