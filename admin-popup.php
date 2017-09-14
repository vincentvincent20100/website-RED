<?php include "frame/header-admin.php";?>

<div id="blocGlobal">
  <div id="zoneCrea">

    <h3>Fenêtre pop-up réseaux sociaux</h3>
      <?php
      $selectionEtat = $connect->query("SELECT etat_popup FROM popup_activite WHERE popup =0");
      $se = $selectionEtat->fetch(PDO::FETCH_OBJ);
      if ($se->etat_popup == "non-active") {
        echo "<span class='non'> pop-up facebook</span> - <span><a href='popup.php?f=active&id=0'>Activer</a></span>";
      }elseif ($se->etat_popup == "active") {
        echo "<span class='oui'> pop-up facebook</span> - <span><a href='popup.php?f=non-active&id=0'>Désactiver</a></span>";
      }
      ?>


      <h3>Les fenêtre pop-up créées</h3>
      <table class="liste">
        <tr>
          <th></th><th></th><th class="thLong">Nombre d'adresses collectées</th><th class="thLong">Nombre de période d'activité</th><th class="thLong">Activité cumulée (sec)</th><th>Ratio</th><th class="thLong">1ère mise en activité</th>
        </tr>

        <?php
        // $selectionPopup = $connect->query("SELECT id_popup, nomCampagne, COUNT(email) ,etatCampagne FROM popup INNER JOIN client ON popup.id_popup=client.popup GROUP BY nomCampagne");
        $selectionPopup = $connect->query("SELECT id_popup, nomCampagne,etatCampagne,COUNT(id_popup_activite) AS nbPeriod,MAX(id_popup_activite) AS id_popup_activite,
        COUNT(email) AS email,sum(TIMESTAMPDIFF(SECOND, date_debut, date_fin)) AS cumul,sum(TIMESTAMPDIFF(SECOND, date_debut, date_fin))/COUNT(email) AS ratio, MIN(date_debut) AS ratio2
        FROM client  RIGHT JOIN popup ON popup.id_popup=client.popup LEFT JOIN popup_activite ON popup.id_popup=popup_activite.popup GROUP BY id_popup");
        while ($sp = $selectionPopup->fetch(PDO::FETCH_OBJ)) {
          if ($sp->etatCampagne == "non-active") {
            echo "<tr>
            <td class='non'>$sp->nomCampagne</td>
            <td>
            <a href='popup.php?p=active&id=$sp->id_popup'>Activer</a><br>
            </td>";
          }elseif ($sp->etatCampagne == "active") {
            echo "<tr>
            <td class='oui'>$sp->nomCampagne</td>
            <td>
            <a href='popup.php?p=non-active&id=$sp->id_popup&id2=$sp->id_popup_activite'>Désctiver</a>
            </td>";
          }
          echo "
          <td class='bold'>$sp->email</td>
          <td>$sp->nbPeriod</td>
          <td>$sp->cumul</td>
          <td>$sp->ratio</td>
          <td>$sp->ratio2</td>
          <td><a href='admin-modpopup.php?id=$sp->id_popup'><img src='img/pictogramme/edit-buttons.png' title='modifier' class='img_modify' ></a></td>
          <td><a href='popup.php?p=supprime&id=$sp->id_popup'><img src='img/pictogramme/Supprimer.png' title='Supprimer' class='img_modify'></a></td>
          </tr>";
        }


        // message d'avertissment
        $comptePopup = $connect->query("SELECT COUNT(etatCampagne)AS nb FROM popup WHERE etatCampagne='active'");
        $aa = $comptePopup->fetch(PDO::FETCH_OBJ);
        if ($aa->nb > 1) {
          echo "<p class='avertissement'>Veillez à n'activer qu'une pop-up à la fois</p><br>";
        }
        ?>
      </table>

  </div>

  <div id="previewDivPopup">
    <iframe src="pageActu.php" width="100%" height="500px"></iframe>
  </div>

</div>

<h3>adresses email collectées</h3>
<table class="liste">
  <tr>
    <th>Adresse électronique</th><th>Date d'ajout</th>
    <th>
      <form action="#" method="post" id="selectCampagne"> <!-- la soumission de ce formulaire se fait via javascript -->
        <select class="selectCampagne" name="selectCampagne">
          <option value="">Campagne</option>
          <option value=""> -- Toutes les campagnes -- </option>
          <?php
          $selectCampagne = $connect->query("SELECT nomCampagne FROM popup");
          while ($sc = $selectCampagne->fetch(PDO::FETCH_OBJ)) {
            echo "<option value='$sc->nomCampagne'>$sc->nomCampagne</option>";
          }
             ?>
        </select>
      </form>
    </th>
  </tr>
  <?php
  // selon la campagne choisie -> affichage des email collectés
  if (!empty($_POST["selectCampagne"])) {
    $CampagneSelected = $_POST["selectCampagne"];
    $selectEmail = $connect->query("SELECT * FROM client INNER JOIN popup ON popup.id_popup=client.popup WHERE nomCampagne = '".$CampagneSelected."'");
    while ($a = $selectEmail->fetch(PDO::FETCH_OBJ)) {
      echo "<tr>
      <td>$a->email</td><td>$a->date_ajout</td><td>$a->nomCampagne</td>
      </tr>";
    }
  }else{
    $selectEmail = $connect->query("SELECT * FROM client INNER JOIN popup ON popup.id_popup=client.popup");
    while ($a = $selectEmail->fetch(PDO::FETCH_OBJ)) {
      echo "<tr>
      <td>$a->email</td><td>$a->date_ajout</td><td>$a->nomCampagne</td>
      </tr>";
    }
  }
  ?>
</table>


<!-- extraction email BDD avec select dynamique -->
<script type="text/javascript">
  document.querySelector('.selectCampagne').addEventListener('change', function(){
    document.querySelector('#selectCampagne').submit();
  })
</script>




<?php include "frame/footer-admin.php"; ?>
