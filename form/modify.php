<?php
session_start();

?>
<table>
  <thead>
    <th><td>Date</td><td>Catégorie</td><td>Titre</td><td>Contenu</td><td>Action</td></th>
  </thead>
  <tbody>
    <form action="#" method="post">
      <?php
      $serveur="mysql:host=localhost; dbname=resaendirect-dev-code";
      $user="root";
      $pass="";
      $connect=new PDO($serveur,$user,$pass);
      $selection=$connect->query("SELECT * FROM article WHERE id='".$_GET['numArticle']."'");
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
      <td><textarea name="contenu">'.$r->contenu_article.'</textarea></td>';
      ?>
      <td>
        <input type="submit" value="Sauvegarder">
        <a href="../admin-article.php"><button>Retour</button></a>
      </td>

    </form>
</tbody>
</table>

<?php
/* insérer en BDD */

if (!empty($_POST["titre"])) {
  $connect->exec("UPDATE article SET titre_article='".$_POST["titre"]."', contenu_article='".$_POST["contenu"]."', categorie_article='".$_POST["categorie2"]."' WHERE id=".$_GET['numArticle']."");
  $ancre = $_GET['numArticle'];
  header("Location: ../admin-article.php#$ancre");//redirection
}

 ?>
