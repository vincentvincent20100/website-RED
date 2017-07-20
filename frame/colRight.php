</div>

<div class="col-right">
  <div class="widget">
    <h4>Derniers articles</h4>
    <?php
    $connect = new PDO ("mysql:host=localhost; dbname=resaendirect-dev-code", "root");
    $selection = $connect->query("SELECT * FROM article");
    while ($se = $selection->fetch(PDO::FETCH_OBJ)) {
      echo "<div>
        <h5>$se->titre_article</h5>
        <p>$se->date_article</p>
        <p class='contentArticleWidget'>$se->contenu_article</p>
      </div>";
    }


     ?>
  </div>

  <!-- Fil d'actualité facebook -->
  <div class="widget">
    <div class="fb-page" data-href="https://www.facebook.com/FairBooking" data-tabs="timeline, messages, events" data-width="230" data-height="700" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false">
      <blockquote cite="https://www.facebook.com/FairBooking" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/FairBooking">Fairbooking</a></blockquote></div>
  </div>

</div>
