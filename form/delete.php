<?php
session_start();

$serveur="mysql:host=localhost; dbname=resaendirect-dev-code";
$user="root";
$pass="";
$connect=new PDO($serveur,$user,$pass);

// supression de catégorie
if (!empty($_GET['idCategorie'])) {
  $connect->exec("DELETE FROM categorie_article WHERE id = ".$_GET['idCategorie']."");
  header("Location: ../admin-article.php");//redirection
}

// supression d'article
if (!empty($_GET['numArticle'])) {
  $articleSupprime = $connect->exec("DELETE FROM article WHERE id = ".$_GET['numArticle']."");
  $categorieSupprime = $connect->exec("DELETE FROM categorie_article WHERE id = ".$_GET['numCategorie']."");
  // $a = $connect->exec("DELETE FROM image WHERE id = ".$_GET['numImage']"");
  header("Location: ../admin-article-liste.php#beginTable");//redirection
}


// supression d'image
if (!empty($_GET['idImg'])) {
  // suppression fichier sur serveur
  $selection = $connect->query("SELECT url FROM image WHERE id_image = ".$_GET['idImg']."");
  $r=$selection->fetch(PDO::FETCH_OBJ); // récupération URL depuis BDD
  $dossier_traite = "C:/wamp64/www/MesProjets/code-resaendirect/img";
  $repertoire = opendir($dossier_traite); // On ouvre le dossier (dans une variable qui sera utilisée par la suite).
    $chemin = $dossier_traite."/".substr($r->url, 50); // On définit le chemin du fichier à effacer.
    unlink($chemin); // On efface.
  closedir($repertoire); // On ferme le dossier

  // suppression url en BDD
  $articleSupprime = $connect->exec("DELETE FROM image WHERE id_image = ".$_GET['idImg']."");
  if ($_SERVER['HTTP_REFERER'] == "http://localhost/MesProjets/code-resaendirect/admin-annonce.php") {
    header("Location: ../admin-annonce.php");
  }else if($_SERVER['HTTP_REFERER'] == "http://localhost/MesProjets/code-resaendirect/admin-image.php") {
    header("Location: ../admin-image.php");
  }
}

 ?>
