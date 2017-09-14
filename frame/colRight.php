</div>

<div class="col-right col">
    <!-- Liste des derniers articles -->
  <div class="widget">
    <h4>Derniers articles</h4>
    <?php
    $connect = new PDO ("mysql:host=localhost; dbname=resaendirect-dev-code", "root");
    $selection = $connect->query("SELECT * FROM article INNER JOIN image ON article.image_article = image.id_image ORDER BY date_article DESC LIMIT 5");
    while ($se = $selection->fetch(PDO::FETCH_OBJ)) {
      echo "<div class='artCol'>
        <a href='http://localhost/MesProjets/code-resaendirect/pageArticle.php?id=$se->id'><p class='titleArtCol'>$se->titre_article</p></a>
        <a href='http://localhost/MesProjets/code-resaendirect/pageArticle.php?id=$se->id'><img src='$se->url' class='imgArtCol'></a>
        <p class='catArticle'>$se->categorie_article</p>
      </div>";
    }


     ?>
  </div>

  <!-- Fil d'actualité facebook -->
  <div class="widget">
    <div class="fb-page" data-href="https://www.facebook.com/FairBooking" data-tabs="timeline, messages, events" data-width="200" data-height="700" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false">
      <blockquote cite="https://www.facebook.com/FairBooking" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/FairBooking">Fairbooking</a></blockquote></div>
  </div>

</div>
