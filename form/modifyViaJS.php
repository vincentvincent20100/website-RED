<?php

    $serveur="mysql:host=localhost; dbname=resaendirect-dev-code";
    $user="root";
    $pass="";
    $connect=new PDO($serveur,$user,$pass);

    if (!empty($_POST["titre"])) { // modification article
      $connect->exec("UPDATE article SET date_article='".$_POST["date"]."' WHERE id='".$_POST["id"]."'");
      $connect->exec("UPDATE article SET titre_article='".$_POST["titre"]."' WHERE id='".$_POST["id"]."'");
      $connect->exec("UPDATE article SET categorie_article='".$_POST["categorie"]."' WHERE id='".$_POST["id"]."'");
      $connect->exec("UPDATE categorie_article SET libelle_categorie='".$_POST["categorie"]."' WHERE id='".$_POST["idCategory"]."'");
      $ancre = $_POST["id"];
      header("Location: ../admin-article-liste.php#$ancre");
    }elseif (!empty($_POST["Intitutle"])) { // modification catégorie seule
      $connect->exec("UPDATE categorie_article SET libelle_categorie='".$_POST["Intitutle"]."' WHERE id='".$_POST["idCategory"]."'");
      header("Location: ../admin-article.php");
    }elseif (!empty($_POST["idImage"])) { // modification commentaire image (depuis annonce)
      $connect->exec("UPDATE image SET commentaire='".$_POST["content"]."' WHERE id_image='".$_POST["idImage"]."'");
      $ancre = "ii".$_POST["idImage"];
      header("Location: ../admin-annonce.php#$ancre");
    }elseif (!empty($_POST["idImg"])) { // modification commentaire image (depuis annonce)
          $connect->exec("UPDATE image SET commentaire='".$_POST["content"]."' WHERE id_image='".$_POST["idImg"]."'");
          $ancre = "ii".$_POST["idImg"];
          header("Location: ../admin-image.php#$ancre");
    }




?>
