<?php
$title = "Actualité";
include "frame/header.php";
include "frame/colLeft.php";
?>

<?php


$selection=$connect->query('SELECT * FROM article INNER JOIN image ON article.image_article = image.id_image');
while ($r=$selection->fetch(PDO::FETCH_OBJ)) {
  echo "
  <div class='blocArticle'>
    <div class='imgArticle'>
      <a href='pageArticle.php?id=$r->id'><img src='$r->url' height='100px'></a>
      <p class='catArticle'>$r->categorie_article</p>
    </div>
    <div class='txtArticle'>
      <p class='title'><a href='pageArticle.php?id=$r->id'>$r->titre_article</a></p>
      <div class='content'>".str_replace('img','a class=\'h\'',$r->contenu_article)."</div>
      <p class='dateArticle'>Le ".substr($r->date_article, 8, 2)."/".substr($r->date_article, 5, 2)."/".substr($r->date_article, 0, 4)."</p>
    </div>
    <div class='annexeArticle'>
      <a href='pageArticle.php?id=$r->id'><p class='btnLire'>Lire l'article</p></a>
    </div>
  </div>
  <br>
  ";
}

?>







<?php
include "popup.php";
include "frame/colRight.php";
include "frame/footer.php"; ?>
