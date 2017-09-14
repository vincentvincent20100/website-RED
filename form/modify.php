<?php
session_start();

?>
<table>
  <thead>
    <th><td>Date</td><td>Catégorie</td><td>Titre</td><td>Image</td><td>Contenu</td><td>Action</td></th>
  </thead>
  <tbody>
    <form action="#" method="post">
      <?php
      $serveur="mysql:host=localhost; dbname=resaendirect-dev-code";
      $user="root";
      $pass="";
      $connect=new PDO($serveur,$user,$pass);
      $selection=$connect->query("SELECT * FROM article INNER JOIN image ON article.image_article = image.id_image WHERE id='".$_GET['numArticle']."'");
      $selection2=$connect->query("SELECT * FROM categorie_article");

      $r=$selection->fetch(PDO::FETCH_OBJ);
      echo '<tr><td></td><td><input type="text" name="date" value="'.$r->date_article.'"</td>
      <td><select name="categorie2">';
        while ($r2=$selection2->fetch(PDO::FETCH_OBJ)) {
          if ($r->categorie_article == $r2->libelle_categorie){$selected = 'selected';}else{$selected = '';}
          echo '<option value="'.$r2->libelle_categorie.'"'.$selected.'>'.$r2->libelle_categorie.'</option>';
        }
      echo '</select></td>
      <td><input type="text" name="titre" value="'.$r->titre_article.'"</td>
      <td><img src="'.$r->url.'" height="100px"><br>
      </td>
      <td><textarea name="contenu">'.$r->contenu_article.'</textarea></td>';
      $urlImageARemplcer = $r->url;
      ?>
      <td>
        <input type="submit" value="Sauvegarder">
        <a href="../admin-article-liste.php">Retour</a>
      </td>
    </tbody>
</table>
<div>
  </form><!-- sélection d'une nouvelle image -->
  <form action="#" method="post" enctype="multipart/form-data">
    <input type="file" name="imgRpl"><br>
    <button>Changer l'image</button>
  </form>
</div>

<?php
/* changer image sur serveur */
if (!empty($_FILES)){
  $newName = uniqid().'.'.strtolower(pathinfo($_FILES['imgRpl']['name'], PATHINFO_EXTENSION));
  move_uploaded_file($_FILES['imgRpl']['tmp_name'], "C:/wamp64/www/MesProjets/code-resaendirect/img/".$newName);
  $url = "http://localhost/MesProjets/code-resaendirect/img/".$newName;
/* changer url image en BDD */
  $idImage = $connect->query("SELECT id_image FROM image WHERE url='".$urlImageARemplcer."'");
  while ($idI=$idImage->fetch(PDO::FETCH_OBJ)) {
    $connect->exec("UPDATE image SET url='".$url."' WHERE id_image='$idI->id_image'");
    echo "Nouvelle image : <br><img src='$url' height='300px'>";
  }
}


/* insérer en BDD */

if (!empty($_POST["titre"])) {
  $connect->exec("UPDATE article SET titre_article='".$_POST["titre"]."', contenu_article='".$_POST["contenu"]."', categorie_article='".$_POST["categorie2"]."' WHERE id=".$_GET['numArticle']."");
  $ancre = $_GET['numArticle'];
  header("Location: ../admin-article-liste.php#$ancre");//redirection
}

 ?>
