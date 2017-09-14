<?php
$title = "Article";
include "frame/header.php";
include "frame/colLeft.php";

$connect=new PDO("mysql:host=localhost; dbname=resaendirect-dev-code","root");
$articleSelectionne = $connect->query("SELECT * FROM article  INNER JOIN image ON article.image_article = image.id_image WHERE id='".$_GET['id']."'");
while ($artS = $articleSelectionne->fetch(PDO::FETCH_OBJ)) {
  echo "
  <div class='blocArticleSolo'>
  <h1>$artS->titre_article</h1>
  <p class='catArticleSolo'>$artS->categorie_article</p>
  <p class='dateSolo'>Le ".substr($artS->date_article, 8, 2)."/".substr($artS->date_article, 5, 2)."/".substr($artS->date_article, 0, 4)."</p>
  <div>$artS->contenu_article</div>
  </div>
  ";
}//  <img class='imagePresentationArticle' src='$artS->url'>

 ?>
 <div class="blocBtnShare">
   <div class="btnShare fb-share-button" data-href="https://www.facebook.com/FairBooking" data-layout="button" data-size="small" data-mobile-iframe="true">
     <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.facebook.com%2FFairBooking&amp;src=sdkpreparse">Partager</a></div>
    <div class="btnShare">
      <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=Hello%20world">Tweeter</a>
    </div>
    <div class="btnShare">
      <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: fr_FR</script><script type="IN/Share" data-url="https://www.linkedin.com/company/fairbooking-com"></script>
    </div>
 </div>

 <?php
 include "frame/colRight.php";
 include "frame/footer.php";
 ?>
