<?php
$title = "Article";
include "frame/header.php";
include "frame/colLeft.php";

$connect=new PDO("mysql:host=localhost; dbname=resaendirect-dev-code","root");
$Selection = $connect->query("SELECT * FROM article INNER JOIN image ON article.image_article = image.id_image
  WHERE categorie_article='".$_GET['libCat']."'
  ");
  $unTour = true;
while ($r = $Selection->fetch(PDO::FETCH_OBJ)) {
  if ($unTour) {
    echo "<h1>Catégorie : $r->categorie_article</h1>";
    $unTour = false;
  }
  echo "
  <div class='blocArticle'>
    <div class='imgArticleCat'>
      <img src='$r->url' height='200px'>
      <p class='catArticle'>$r->categorie_article</p>
    </div>
    <div class='txtArticleCat'>
      <p class='title'>$r->titre_article</p>
      <div class='contentCat'>".str_replace('img','param class=\'h\'',$r->contenu_article)."</div>
      <a href='pageArticle.php?id=$r->id'><p class='btnLireCat'>Lire l'article</p></a>
      <p class='dateArticleCat'>Le ".substr($r->date_article, 8, 2)."/".substr($r->date_article, 5, 2)."/".substr($r->date_article, 0, 4)."</p>
    </div>

  </div>
  <br>
  ";
}

 ?>

 <?php
 include "frame/colRight.php";
 include "frame/footer.php";
 ?>
