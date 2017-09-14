<?php include "frame/header-admin.php"; ?>

<form class="" action="#" method="post" enctype="multipart/form-data">
  <p>Ajouter une image</p>
  <input type="file" name="img-dl">
  <button type="submit" name="button"><img src="img/pictogramme/check18px.png" alt=""></button>
</form>

    <?php
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
      </div>
      <div class='bloc' id='ii$a->id_image'>
        <p class='$a->type'>Type : $a->type</p>
        <p class='t0-8' id='i$a->id_image'>Commentaire : $a->commentaire<span class='btn' onclick='modifyComment2($a->id_image,\"$a->commentaire\")'> <img src='img/pictogramme/edit-buttons.png' title='modifier' class='img_modify'></span></p>
        <p class='t0-6'>$a->url</p>
        <a href='form/delete.php?idImg=$a->id_image'><img src='img/pictogramme/Supprimer.png' title='Supprimer' class='img_modify'></a>
      </div></div>";

    }
    ?>


<script src="form/modifyCommentImage.js" charset="utf-8"></script>
