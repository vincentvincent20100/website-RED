<?php include "frame/header-admin.php"; ?>

<h2>Ajouter une annonce</h2>
<form action="" method="post" enctype="multipart/form-data">
  <label for="img-dl">Sélectionner un fichier </label><input type="file" name="img-dl"><br>
  <label for="contenu">Commentaire</label><textarea name="contenu" rows="8" cols="20"></textarea><br>
  <!-- <button type="submit" name="button">Valider</button> -->
  <button>Charger le fichier</button>
</form>

<?php
// variable contenant un éventuel message d'erreur
$error = "";
if (!empty($_POST['contenu'])) {
  $contenu = $_POST['contenu'];
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
  }
}



 ?>


<table border="1px">
  <figcaption><h2>Liste des annonces</h2></figcaption>
  <thead>
    <th><td>Type</td><td>URL</td><td>Image</td><td>Commentaire</td><td>Publication</td><td>Action</td></th>
  </thead>
  <tbody>

    <?php
    $annonces = $connect->query('SELECT * FROM image WHERE type = "annonce"'); //
    while ($a = $annonces->fetch(PDO::FETCH_OBJ)) {
      echo
      "<tr id='ii$a->id'>
      <td>$a->id</td>
      <td>$a->type</td>
      <td>$a->url</td>
      <td><img src='$a->url' alt='' height='300px'></td>
      <td id='i$a->id'>$a->commentaire<br><input type='button' value='Modifier' onclick='modifyComment($a->id,\"$a->commentaire\")'></td>
      <td>publié : $a->publier<br>
        <a href='frame/colLeft.php?show=true&id=$a->id&path=$a->url'>Publier</a>
        <a href='frame/colLeft.php?show=false&id=$a->id'>Retirer</a>
      </td>
      <td><a href='form/delete.php?idImage=$a->id'><button>Supprimer</button></a></td>
      </tr>";
    }
    ?>

  </tbody>
</table>

<script type="text/javascript">
  function modifyComment(id, contenu) {
    var tr = "#ii"+id; // un querySelector ne doit pas commencer par un chiffre
    var td = "#i"+id;

    // var formu = document.body.appendChild(document.createElement('form'));
    var tdNew = document.createElement('td');
    var formu = tdNew.appendChild(document.createElement('form'));
    formu.method = "post";
    formu.action = "form/modifyViaJS.php";
    var inputId = formu.appendChild(document.createElement('input'));
    inputId.type = 'hidden';
    inputId.name = 'idImage';
    inputId.value = id;
    var inputContent = formu.appendChild(document.createElement('input'));
    inputContent.type = 'text';
    inputContent.name = 'content';
    inputContent.value = contenu;
    var inputBtn = formu.appendChild(document.createElement('input'));
    inputBtn.type = 'submit';
    inputBtn.value = 'Enregistrer';
    document.querySelector(tr).replaceChild(tdNew, document.querySelector(td));

  }
</script>

<?php include "frame/footer-admin.php"; ?>
