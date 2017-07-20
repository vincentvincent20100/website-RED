<?php
$title = "Actualité";
include "frame/header.php";
include "frame/colLeft.php";
?>



<?php

/*
stockage BDD via PDO
*/
$serveur="mysql:host=localhost; dbname=resaendirect-dev-code";
$user="root";
$pass="";
$connect=new PDO($serveur,$user,$pass); //PDO php data object

$selection=$connect->query('SELECT * FROM article');
while ($r=$selection->fetch(PDO::FETCH_OBJ)) {
  /*tant que il ya qqch dans $r, $r sera le resulat sous forme d'objet,
  fletch c'est du tri de donnée, ici il transforme le resultat en objet */
  echo '<p class="title">'.$r->titre_article.'</p>';
  echo '<p class="date">'.$r->date_article.'</p>';
  echo '<p class="content">'.$r->contenu_article.'</p>';
}


/*
stockage fichier txt
*/

// // 1 : on ouvre le fichier
// $monfichier = fopen('articles.txt', 'r+');
// // 2 : on fera ici nos opérations sur le fichier...
// $ligne = fgets($monfichier);
// // 3 : quand on a fini de l'utiliser, on ferme le fichier
// fclose($monfichier);
// echo $ligne;
?>








<?php
include "frame/colRight.php";
include "frame/footer.php"; ?>
