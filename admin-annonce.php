<?php include "frame/header-admin.php"; ?>


<div class="blocGlobal2">
  <div class="listeAnnonces">

  <?php
  $annonces = $connect->query('SELECT * FROM image WHERE type = "annonce" ORDER BY ordre'); //
  while ($a = $annonces->fetch(PDO::FETCH_OBJ)) {
    echo
    "<div class='blocGlobal'>
    <div class='bloc'>
    <img class='pub' src='$a->url'>
    </div>
    <div class='bloc' id='ii$a->id_image'>";
    if ($a->publier == 'oui') {
      echo "
      <a href='frame/colLeft.php?show=false&id=$a->id_image'>Retirer</a>
      <form class='formPostion' action='frame/colLeft.php' method='post'>
      <input type='number' class='inputNum' name='position' value='$a->ordre'>
      <input type='hidden' name='id_image' value='$a->id_image'>
      <button type='submit' class='btnCheck'><img src='img/pictogramme/check.png' class='check11'></button>
      </form>
      <p class='commentaireAnn' id='i$a->id_image'>Commentaire : $a->commentaire<span class='btn' onclick='modifyComment1($a->id_image,\"$a->commentaire\")'> <img src='img/pictogramme/edit-buttons.png' title='Rédiger ou modifier' class='img_modify pointer'></span></p>
      <a href='form/delete.php?idImg=$a->id_image'><img src='img/pictogramme/Supprimer.png' title='Supprimer annonce' class='img_modify'></a>
      ";
    }elseif ($a->publier == 'non') {
      echo "
      <a href='frame/colLeft.php?show=true&id=$a->id_image&path=$a->url'>Publier</a>
      <p class='commentaireAnn' id='i$a->id_image'>Commentaire : $a->commentaire<span class='btn' onclick='modifyComment1($a->id_image,\"$a->commentaire\")'> <img src='img/pictogramme/edit-buttons.png' title='Rédiger ou modifier' class='img_modify pointer'></span></p>
      <a href='form/delete.php?idImg=$a->id_image'><img src='img/pictogramme/Supprimer.png' title='Supprimer annonce' class='img_modify'></a>
      ";
    }
    echo "</div></div>";
  }
  ?>
  </div>

  <div id="previewColLeft">
    <h3>Aperçu</h3>
    <?php include  "frame/colLeft.php"; ?>
    </div>
  </div>
</div>


<br><h3>Estimation du coût d'affichage : </h3>
<form action="#" method="post" id="form_cout" onsubmit="montant.value = tarif.value * duree.value; return false;">
  <label for="tarif">Tarif jour :</label><input type="number" name="tarif" value="2"> €<br>
  <label for="duree">Nombre de jour :</label><input type="number" name="duree" value="7"> jour(s)<br>
  <input type="submit" value="Calculer"> Montant :<output for="tarif duree" name="montant" form="form_cout"></output> €<br>

</form>






<script src="form/modifyCommentImage.js" charset="utf-8"></script>

<?php include "frame/footer-admin.php"; ?>
