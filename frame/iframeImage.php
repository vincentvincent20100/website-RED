<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../frame/frame.css">
    <title>Tableau de bord</title>
  </head>
  <body>

      <form class="" action="#" method="post" enctype="multipart/form-data">
        <p>Banque d'image</p>
        <input type="file" name="img-dl">
        <button type="submit" name="button">Ajouter</button>
      </form>
      <br>

    <?php
    // création connexion bdd pour toutes les pages de l'admin
    $connect=new PDO("mysql:host=localhost; dbname=resaendirect-dev-code","root",""); //PDO php data object
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING); // afficher les erreurs
    /* enregistrement image serveur */
    if (!empty($_FILES['img-dl'])) {
      $newName = uniqid() . "." . strtolower(pathinfo($_FILES['img-dl']['name'], PATHINFO_EXTENSION));
      move_uploaded_file($_FILES['img-dl']['tmp_name'], "img/$newName");
    /* enregistrement url image BDD */
    $url = "http://localhost/MesProjets/code-resaendirect/img/".$newName;
    $connect->exec("INSERT INTO image (type, url, commentaire, publier) VALUES ('img', '$url', NULL, 'non')");
    }
    /* affiche toutes les images */
    $annonces = $connect->query('SELECT * FROM image ORDER BY id_image DESC'); //
    while ($a = $annonces->fetch(PDO::FETCH_OBJ)) {
      echo
      "<div class='blocGlobal'>
      <div class='bloc'>
        <img class='image' src='$a->url'>
      </div>";

    }
    ?>


<script src="form/modifyCommentImage.js" charset="utf-8"></script>
