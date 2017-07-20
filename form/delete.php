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
  header("Location: ../admin-article.php#beginTable");//redirection
}

// supression d'image
if (!empty($_GET['idImage'])) {
  $articleSupprime = $connect->exec("DELETE FROM image WHERE id = ".$_GET['idImage']."");
  header("Location: ../admin-annonce.php");//redirection
}

 ?>
