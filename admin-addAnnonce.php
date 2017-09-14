<?php include "frame/header-admin.php"; ?>


<h2>Ajouter une annonce</h2>
<form action="" method="post" enctype="multipart/form-data">
  <label for="img-dl">Sélectionner un fichier </label><input type="file" name="img-dl"><br>
  <label for="contenu">Ajouter un commentaire (facultatif) </label><textarea name="contenu" class="textarea-align-top"></textarea><br>
  <!-- <button type="submit" name="button">Valider</button> -->
  <button>Charger le fichier</button>
</form>


<?php
// variable contenant un éventuel message d'erreur
$error = "";
if (!empty($_POST['contenu'])) {
  $contenu = htmlentities($_POST['contenu']);
}

if (!empty($_FILES)){
  echo '<pre>';
  print_r($_FILES);
  echo '</pre>';


  /* enregistrement image serveur */

  // récupére le chemin complet vers le fichier temporaire, ex : C:\wamp64\tmp\phpED29.tmp
  $tmpName = $_FILES['img-dl']['tmp_name']; // img-dl était la valeur du input name
  // déplacement du fichier
  if (empty($error)){
  //extrait l'extension, et la convertie en minuscule
  $extension = strtolower(pathinfo($_FILES['img-dl']['name'], PATHINFO_EXTENSION)); // retourne jpg par exemple
  //on génère un nouveau nom, sécuritaire et unique, pour ce fichier
  $newName = uniqid() . "." . $extension; //on concaténe un point et l'extension, retourne 5967725b1e49e.jpg par exemple
  //déplace le fichier temporaire vers un autre endroit
  move_uploaded_file($tmpName, "img/$newName");


  /* enregistrement url image BDD */

  // récupére le chemin complet vers le fichier
  $url = "http://localhost/MesProjets/code-resaendirect/img/".$newName;
  $connect->exec("INSERT INTO image (type, url, commentaire, publier) VALUES ('annonce', '$url', '$contenu', 'non')");
  header("Location:admin-annonce.php");
  }
}


 ?>
