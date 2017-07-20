<?php
  session_start();

  /*
  stockage BDD via PDO
  */

  $serveur="mysql:host=localhost; dbname=resaendirect-dev-code";
  $user="root";
  $pass="";
  $connect=new PDO($serveur,$user,$pass); //PDO php data object
  // echo "<br>connexion enclanchée";
  // $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING); // afficher les erreurs
  // $connect->beginTransaction();
  // echo "<br>transaction prete";

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/admin.css">
    <title>Tableau de bord</title>
  </head>
  <body>
    <header>
      <h1>Tableau de bord</h1>
      <a href="index.php">Aller sur le site</a>
      <nav>
        <a href="admin-article.php">Articles</a>
        <a href="admin-annonce.php">Annonces</a>
      </nav>
    </header>
    <main>
