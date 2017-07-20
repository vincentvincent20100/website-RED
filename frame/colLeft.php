<div class="col-left">

  <?php
  $serveur="mysql:host=localhost; dbname=resaendirect-dev-code";
  $user="root";
  $pass="";
  $connect=new PDO($serveur,$user,$pass);

if (!empty($_GET['show'])) {
  $show = $_GET['show'];
  $id = $_GET['id'];

  if ($show == 'true') {
    $connect->exec("UPDATE image SET publier='oui' WHERE id = '".$id."'");
  }else{
    $connect->exec("UPDATE image SET publier='non' WHERE id = '".$id."'");
  }
  header("Location: ../admin-annonce.php");
}
  $affichees = $connect->query("SELECT * FROM image WHERE publier = 'oui'");
  while ($af=$affichees->fetch(PDO::FETCH_OBJ)) {
    echo "<img src='$af->url' width='230px'>";
  }
// position :
// créer le champ position dans la table image
// créer un tableau
// rataché à l'index du tableau la position définie


  ?>

</div>
<div class="corps">
