<?php
$title = "Actualité";
include "frame/header.php";
include "frame/colLeft.php";
?>
<div class="corpsAccueil">
  <h2>Actualité du moment</h2>

  <div class="blocAccueil3">
    <div class='blocArticleAcc'>
      <a href="pageCooperative.php"><img src='img/visuel/cooperative.jpg'></a>
    </div>
  </div>
  <div class="blocAccueil">
    <?php

    $selection=$connect->query('SELECT * FROM article INNER JOIN image ON article.image_article = image.id_image WHERE categorie_article="Hotel" LIMIT 1');
    $r=$selection->fetch(PDO::FETCH_OBJ);
    echo "
    <div class='blocArticleAcc'>
    <img src='$r->url''>
    <p class='titleBlocAcc'>Hotel à la Une</p>
    <p class='titleAcc'>$r->titre_article</p>
    </div>
    <br>
    ";
    $selection=$connect->query('SELECT * FROM article INNER JOIN image ON article.image_article = image.id_image WHERE categorie_article="Hotel" LIMIT 1');
    $r=$selection->fetch(PDO::FETCH_OBJ);
    echo "
    <div class='blocArticleAcc'>
    <img src='$r->url''>
    <p class='titleBlocAcc'>Info à la Une</p>
    <p class='titleAcc'>$r->titre_article</p>
    </div>
    <br>
    ";

    ?>
  </div>
  <h2>Nous proposons</h2>
  <div class="blocAccueil2">
    <div class='blocArticleAcc'>
      <img src='img/visuel/carte-de-visite-fairbooker.jpg'>
    </div>
    <div class='blocArticleAcc'>
      <a href="pageFormation.php"><img src='img/visuel/REDacademie.png'></a>
    </div>
  </div>
  <h2>Réservation en Direct ?</h2>
  <p>Fairbooking est édité par l'association Réservation en Direct. Le but de cette association est de fédérer les hébergeurs professionnels face aux grands distributeurs en ligne.
  <br>Grace à Fairbooking les hoteliers ne paient pas de commission sur les réservation à un intermédiaire.
  <br>Fairbooking permet aux consommateurs de bénéficier des meilleures prestations en se mettant en contact direct avec l’hôtelier.

  </p>

</div>


<?php
include "frame/colRight.php";
include "frame/footer.php";
/*
stockage fichier txt
*/

// // 1 : on ouvre le fichier
// $monfichier = fopen('articles.txt', 'r+');
// // 2 : on fera ici nos opérations sur le fichier...
// $ligne = fgets($monfichier);
// // 3 : quand on a fini de l'utiliser, on ferme le fichier
// fclose($monfichier);
// echo $ligne;
?>
