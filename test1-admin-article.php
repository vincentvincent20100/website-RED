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
  VALUES ('".$_POST["titre"]."', '".$_POST["contenu"]."', now(), '".$_POST["categorie"]."', (SELECT id_image FROM image WHERE url='http://localhost/MesProjets/code-resaendirect/img/$newName'))");
  header('Location:admin-article-liste.php');
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






<script type="text/javascript">


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
