<?php
$dbname = "exam";
$dbhost = "localhost";
$dbuser = "axelcarrette";
$dbpass = "Greta1234!";

try {
    $dsn = "mysql:dbname=".$dbname.";host=".$dbhost;
    $db = new PDO($dsn, $dbuser, $dbpass);
    $db->exec("SET NAMES utf8");
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}catch(PDOException $e) {
    die($e->getMessage());
}
?>

<!-- On peut se connecter et s'inscrire sur le site. 
Il va y avoir des articles (je vais vous donner la table article) et il sera possible de les ajouter à votre liste de souhaits.
Faire une page pour ajouter des articles.
Mettre le projet sur git en public et m'envoyer le lien du repository pour demain matin.
Le but n'est pas forcément de réussir à tout finir, mais d'essayer d'aller le plus loin possible.
Je vous mets une image en exemple. Ici quand le coeur est plein, c'est que l'utilisateur a aimé l'article.

Tâche à faire : 

- Liste de souhaits .

Tâche en cours : 

- Le systéme de like . 

Tâche finie : 
,
- Inscription
- Connexion 
- Page pour ajouter des articles.  -->

