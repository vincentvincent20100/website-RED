<?php include "frame/header-admin.php";

//$libelle = !empty($_POST["libelle"]) ? $_POST["libelle"] : NULL;

/* insérer catégorie en BDD */
if (!empty($_POST["libelle"])) {
  $connect->exec("INSERT INTO categorie_article (libelle_categorie)
  VALUES ('".$_POST["libelle"]."')");
}
/* enregistrement image sur serveur */
if (!empty($_FILES)){
  $newName = uniqid().'.'.pathinfo($_FILES['imageArticle']['name'], PATHINFO_EXTENSION); // concatene un nom unique et l'extension récupérée
  move_uploaded_file($_FILES['imageArticle']['tmp_name'], "img/$newName");  // remplace le chemin de stockage temporaire par le définitif
  /* enregistrement url image en BDD */
  $connect->exec("INSERT INTO image (type, url, commentaire, publier) VALUES ('image_article', 'http://localhost/MesProjets/code-resaendirect/img/$newName', '', '')");
}
/* insérer article en BDD */
if (!empty($_POST["titre"]) && !empty($_POST["contenu"]) && !empty($_POST["categorie"])) {
  $connect->exec("INSERT INTO article (titre_article, contenu_article, date_article, categorie_article, image_article)
  VALUES ('".$_POST["titre"]."', '".$_POST["contenu"]."', now(), '".$_POST["categorie"]."', (SELECT id_image FROM image WHERE url='http://localhost/MesProjets/code-resaendirect/img/$newName'))")
  // VALUES ('".$_POST["titre"]."', '".$_POST["contenu"]."', now(), '".$_POST["categorie"]."', '')")
  ;
}





?>
<h2>Ajouter une catégorie </h2>
<form action="" method="post">
  <label for="libelle">Titre</label><input type="text" name="libelle"><br>
  <button type="submit" name="button">Valider</button><br>
</form><br>

<?php
$selection1 = $connect->query("SELECT * FROM categorie_article");
  while ($s=$selection1->fetch(PDO::FETCH_OBJ)) {
    echo "<span>$s->id</span>-<span>$s->libelle_categorie</span>
    <input type='button' value='Modifier' onclick='modifycategory($s->id,\"$s->libelle_categorie\")'>
    <a href='form/delete.php?idCategorie=".$s->id."'><button>Supprimer</button></a><br>";
    // on extrait les catégorie pour les filer à JS au clic sur ModifierViaJS
    // $categories = $categories.",".$s->libelle_categorie;
  }
  // $tableauCategorie = explode(",", $categories);
  // $tailleTableau = sizeof($tableauCategorie);
  // for ($i=0; $i < $tailleTableau; $i++) {
  //   echo "<p class='cat'>$tableauCategorie[$i]</p>"; // bloqué ici
  // }
 ?>




<h2 id="r1">Ajouter un article</h2>
  <form action="" method="post" enctype="multipart/form-data">
    <label for="categorie">Catégorie</label>
    <select name="categorie">
      <?php // on va chercher en bdd toutes les catégories existantes
      $selection2 = $connect->query("SELECT * FROM categorie_article");
      while ($s=$selection2->fetch(PDO::FETCH_OBJ)) {
        echo "<option value=".$s->libelle_categorie.">$s->libelle_categorie</option>";
      }
      ?>
    </select><br>
    <label for="titre">Titre </label><input type="text" name="titre" autofocus><br>
    <label for="contenu">Contenu </label><textarea name="contenu" rows="8" cols="80"></textarea><br>
    <label for="imageArticle">Ajouter l'image de présentation </label><input type="file" name="imageArticle"><br>
    <button type="submit" name="button">Valider</button>
  </form><br>





  <table id="beginTable">
    <figcaption><h2>Tous les articles</h2></figcaption>
    <thead>
      <th><td>Date</td><td>Catégorie</td><td>Titre</td><td>Image</td><td>Contenu</td><td>Action</td></th>
    </thead>
    <tbody>

        <?php
        $selection=$connect->query('SELECT * FROM article LEFT JOIN image ON article.image_article = image.id_image');
        // $selection=$connect->query('SELECT * FROM article');
        while ($r=$selection->fetch(PDO::FETCH_OBJ)) {
          /*tant que il ya qqch dans $r, $r sera le resulat sous forme d'objet,
          fletch c'est du tri de donnée, ici il transforme le resultat en objet */
          echo "<tr id='$r->id'><td>$r->id</td>
          <td>$r->date_article</td>
          <td>$r->categorie_article</td>
          <td>$r->titre_article</td>
          <td><img src='$r->url' width='100px'></td>
          <td class='tdContenu'>$r->contenu_article</td>
          <td><a href='form/modify.php?numArticle=$r->id'><button>Modifier</button></a></td>
          <td><a href='form/delete.php?numArticle=$r->id'><button>Supprimer</button></a></td>
          <td><input type='button' onclick='modifyArticle($r->id, \"$r->date_article\", \"$r->titre_article\", \"$r->categorie_article\")' value='ModifierViaJS'></td></tr>";
        }
        ?>




<script type="text/javascript">
/* modification article */
function modifyArticle(id, date, titre, categorie) {
    alert('yeaaaaaaaaaaaaa'+id+" "+date+" "+titre+" "+categorie);
  var formu = document.body.appendChild(document.createElement('form'));
  formu.method = "post";
  formu.action = "form/modifyViaJS.php";
  var inputId = formu.appendChild(document.createElement('input'));
  inputId.type = 'hidden';
  inputId.name = 'id';
  inputId.value = id;
  var inputDate = formu.appendChild(document.createElement('input'));
  inputDate.type = 'text';
  inputDate.name = 'date';
  inputDate.value = date;
  var inputTitre = formu.appendChild(document.createElement('input'));
  inputTitre.type = 'text';
  inputTitre.name = 'titre';
  inputTitre.value = titre;
  var selectCategorie = formu.appendChild(document.createElement('select'));
  selectCategorie.name = 'categorie';
    var option1 = selectCategorie.appendChild(document.createElement('option'));
    option1.value = categorie;
    option1.innerText = categorie;
    option1.selected = 'selected';

    // var option2 = selectCategorie.appendChild(document.createElement('option'));
    // option2.value = 'option2';
    // option2.innerText = document.querySelector(".cat").innerText;

  var inputBtn = formu.appendChild(document.createElement('input'));
  inputBtn.type = 'submit';
  inputBtn.value = 'Enregistrer';
}

/* modification catégorie */
function modifycategory(id, lib) {
  document.querySelector('main').insertBefore(document.createElement('p').appendChild(document.createTextNode("Modification de :"+id+"-"+lib)), document.querySelector('#r1'));
  var formu2 = document.querySelector('main').insertBefore(document.createElement('form'), document.querySelector('#r1'));
  formu2.method = "post";
  formu2.action = "form/modifyViaJS.php";
  var inputId = formu2.appendChild(document.createElement('input'));
  inputId.type = 'hidden';
  inputId.name = 'idCategory';
  inputId.value = id;
  var inputIntitutle = formu2.appendChild(document.createElement('input'));
  inputIntitutle.type = 'text';
  inputIntitutle.name = 'Intitutle';
  inputIntitutle.value= lib;
  var inputBtn = formu2.appendChild(document.createElement('input'));
  inputBtn.type = 'submit';
  inputBtn.value = 'Enregistrer';
}
</script>


    </tbody>
  </table>




<?php include "frame/footer-admin.php"; ?>
