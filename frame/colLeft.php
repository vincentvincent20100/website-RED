<div class="col-left col">


  <?php
  $serveur="mysql:host=localhost; dbname=resaendirect-dev-code";
  $user="root";
  $pass="";
  $connect=new PDO($serveur,$user,$pass);

if (!empty($_GET['show'])) {
  $show = $_GET['show'];
  $id = $_GET['id'];


// Modification état publication
  if ($show == 'true') {
    $connect->exec("UPDATE image SET publier='oui' WHERE id_image = '".$id."'");
  }else{
    $connect->exec("UPDATE image SET publier='non' WHERE id_image = '".$id."'");
  }
  header("Location: ../admin-annonce.php#ii$id");
}
// Modification Position
if (!empty($_POST['position'])) {
  $position = $_POST['position'];
  $id_image= $_POST['id_image'];
  $connect->exec("UPDATE image SET ordre='".$position."' WHERE id_image='".$id_image."'");
  header("Location: ../admin-annonce.php");
}


// Affichage des images publiées
  $affichees = $connect->query("SELECT * FROM image WHERE publier = 'oui' ORDER BY ordre");
  while ($af=$affichees->fetch(PDO::FETCH_OBJ)) {
    echo "<img src='$af->url'>";
  }



  ?>

</div>
<div class="corps">
