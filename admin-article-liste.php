<?php include "frame/header-admin.php";?>

<?php
/* - - - - - - - - - - - - - - Enregistrement en base : article depuis addArticle - - - - - - - - - - - - - - */
if (!empty($_POST["texte"])) {
  $texte = str_replace('\'','’',htmlentities($_POST["texte"])); // remplacer les ' par ’
  $titre = htmlentities($_POST["titre"]);
  $categorie = htmlentities($_POST["categorie"]);
  $imagePresentation = htmlentities($_POST["imagePresentation"]);

  $connect->exec("INSERT INTO article (titre_article, contenu_article, date_article, categorie_article, image_article)
  VALUES ('".$titre."', '".$texte."', now(), '".$categorie."', (SELECT id_image FROM Image WHERE url = '".$imagePresentation."'))")
  ;
}

/* Modification en base : date */
if (!empty($_POST['dateModifie'])) {
  $connect->exec("UPDATE article SET date_article='".$_POST['dateModifie']."' WHERE id='".$_POST['id']."'");
}
/* Modification en base : catégorie */
if (!empty($_POST['categorieModifie'])) {
  $connect->exec("UPDATE article SET categorie_article='".$_POST['categorieModifie']."' WHERE id='".$_POST['id']."'");
}
/* Modification en base : titre */
if (!empty($_POST['titreModifie'])) {
  $connect->exec("UPDATE article SET titre_article='".$_POST['titreModifie']."' WHERE id='".$_POST['id']."'");
}
 ?>

  <table id="beginTable">
    <figcaption><h2>Tous les articles</h2></figcaption>
    <thead>
      <tr><th></th><th>Publication</th><th>Catégorie</th><th>Illustration</th><th>Titre</th><th></th></tr>
    </thead>
    <tbody>



        <?php
        $selection=$connect->query('SELECT * FROM article LEFT JOIN image ON article.image_article = image.id_image ORDER BY id DESC');
        // $selection=$connect->query('SELECT * FROM article');
        while ($r=$selection->fetch(PDO::FETCH_OBJ)) {
          /*tant que il ya qqch dans $r, $r sera le resulat sous forme d'objet,
          fletch c'est du tri de donnée, ici il transforme le resultat en objet */
          echo "<tr id='l$r->id'><td>$r->id</td>
          <td id='i$r->id'>$r->date_article <span onclick='modifyDate($r->id, \"$r->date_article\")'><img src='img/pictogramme/edit-buttons.png' title='Modifier date' class='img_modify pointer'></span></td>
          <td id='k$r->id'>$r->categorie_article <span onclick='modifyCategory($r->id, \"$r->categorie_article\")'><img src='img/pictogramme/edit-buttons.png' title='Modifier catégorie' class='img_modify pointer'></span></td>
          <td><img src='$r->url' class='imgListeArticle'></td>
          <td id='j$r->id'>$r->titre_article <span onclick='modifyTitle($r->id, \"$r->titre_article\")'><img src='img/pictogramme/edit-buttons.png' title='Modifier titre' class='img_modify pointer'></span></td>
          <td><a href='pageArticle.php?id=$r->id'><img src='img/pictogramme/go.png' title='Aperçu article' class='img_go'></a></td>
          <td><a href='form/modify-article.php?numArticle=$r->id'><img src='img/pictogramme/edit-buttons.png' title='Modifier article' class='img_modify'></a></td>
          <td><a href='form/delete.php?numArticle=$r->id'><img src='img/pictogramme/Supprimer.png' title='Supprimer article' class='img_modify'></a></td>
          </tr>";
        }//<td><a href='form/modify.php?numArticle=$r->id'><img src='img/pictogramme/edit-buttons.png' title='modifier' class='img_modify'></a></td>

        ?>
        <?php // on va chercher en bdd toutes les catégories existantes pour les filer à la fonction JS ModifierViaJS
        $selection2 = $connect->query("SELECT * FROM categorie_article");
        while ($s=$selection2->fetch(PDO::FETCH_OBJ)) {
           echo "<option id='hidden' value=".$s->libelle_categorie.">$s->libelle_categorie</option>";
        }
        ?>


<script type="text/javascript">
/* modification date */
function modifyDate(id, date){
  var tr = "#l"+id;
  var td = "#i"+id;
  var tdNew = document.createElement('td');
  var formu = tdNew.appendChild(document.createElement('form'));
    formu.method = "post";
    formu.action = "#";
    var inputId = formu.appendChild(document.createElement('input'));
    inputId.type = 'hidden';
    inputId.name = 'id';
    inputId.value = id;
    var inputContent = formu.appendChild(document.createElement('input'));
    inputContent.type = 'text';
    inputContent.name = 'dateModifie';
    inputContent.value = date;
    var inputBtn = formu.appendChild(document.createElement('button'));
    inputBtn.type = 'submit';
    inputBtn.innerHTML = "<img src='img/pictogramme/check.png' class='imgCheck'>";
  document.querySelector(tr).replaceChild(tdNew, document.querySelector(td));
}
/* modification titre */
function modifyTitle(id,title){
  var tr = "#l"+id;
  var td = "#j"+id;
  var tdNew = document.createElement('td');
  var formu = tdNew.appendChild(document.createElement('form'));
    formu.method = "post";
    formu.action = "#";
    var inputText = formu.appendChild(document.createElement('input'));
    inputText.type = 'text';
    inputText.value = title;
    inputText.name = 'titreModifie';
    var inputHiden = formu.appendChild(document.createElement('input'));
    inputHiden.type = 'hidden';
    inputHiden.value = id;
    inputHiden.name = 'id';
    var inputBtn = formu.appendChild(document.createElement('button'));
    inputBtn.type = 'submit';
    var imgBtn = inputBtn.appendChild(document.createElement('img'));
    imgBtn.src = 'img/pictogramme/check.png';
    imgBtn.className = 'imgCheck';
  document.querySelector(tr).replaceChild(tdNew, document.querySelector(td));
}

/* modification categorie */
function modifyCategory(id,categorie){
  var tr = "#l"+id;
  var td = "#k"+id;
  var tdNew = document.createElement('td');
  var formu = tdNew.appendChild(document.createElement('form'));
    formu.method = "post";
    formu.action = "#";
    var inputHiden = formu.appendChild(document.createElement('input'));
    inputHiden.type = 'hidden';
    inputHiden.value = id;
    inputHiden.name = 'id';
    var selectCategorie = formu.appendChild(document.createElement('select'));
    selectCategorie.name = 'categorieModifie';
      var options = document.querySelectorAll('option');
      for (var i = 0; i < options.length; i++) {
        var option = selectCategorie.appendChild(document.createElement('option'));
        option.value = options[i].innerText;
        option.innerText = options[i].innerText;
        option.className = options[i].innerText;
        // if (options[i].innerText == document.querySelector(td).innerText) {
        if (option.matches('.'+document.querySelector(td).innerText)) {
          option.selected = "selected";
        }
      }
    var inputBtn = formu.appendChild(document.createElement('button'));
    inputBtn.type = 'submit';
    inputBtn.innerHTML = "<img src='img/pictogramme/check.png' class='imgCheck'>";
  document.querySelector(tr).replaceChild(tdNew, document.querySelector(td));
}

</script>


    </tbody>
  </table>





<?php include "frame/footer-admin.php"; ?>
