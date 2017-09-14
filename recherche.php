<?php
$title = "Actualité";
include "frame/header.php";
include "frame/colLeft.php";
$compteur = 0;
?>



<?php
if (!empty($_POST['rechercheSaisie'])) {
  $texte = str_replace('\'','’',htmlentities($_POST["rechercheSaisie"]));

  /* ---- Affichage nombre de résultats ---- */
  $result = $connect->query("SELECT * FROM article WHERE contenu_article LIKE '%$texte%' OR titre_article LIKE '%$texte%'");
  $nb = $result->fetchAll();
  switch (count($nb)) {
    case 0:
      $annonce  = 'Aucun résultat ne correspond à votre recherche';
      break;
    case 1:
      $annonce  = '<span id="nbrResults">'.count($nb).'</span> Résultat correspond à votre recherche';
      break;
    default:
      $annonce  = '<span id="nbrResults">'.count($nb).'</span> Résultats correspondent à votre recherche';
      break;
  }
  echo '<p id="rechercheTapee">Votre recherche : <span>'.$texte.'</span></p>'.$annonce.'<br><br>';

  /* ---- Affichage des résultats ---- */
  $selection = $connect->query("SELECT * FROM article INNER JOIN image ON article.image_article = image.id_image WHERE contenu_article LIKE '%$texte%'  OR titre_article LIKE '%$texte%'");
  while ($selT = $selection->fetch(PDO::FETCH_OBJ)) {
    // $compteur = ++$compteur;
    // echo $compteur.'<br>';
    echo "
    <div class='blocResultSearch'>
      <div class='imgResultSearch'>
        <img src='$selT->url' height='100px'>
      </div>
      <div class='headerResultSearch'>
        <p class='catResultSearch'>$selT->categorie_article</p>
        <p class='titreResultSearch'>".str_replace ($texte, "<span style='background:yellow' >".$texte."</span>", $selT->titre_article)."</p>
        <p class='dateResultSearch'>Le ".substr($selT->date_article, 8, 2)."/".substr($selT->date_article, 5, 2)."/".substr($selT->date_article, 0, 4)."</p>
      </div>
      <div class='txtResultSearch'><p>".
        str_replace ($texte, "<span style='background:yellow' >".$texte."</span>", $selT->contenu_article)
      ."<br></p></div>
    </div>
    <a href='pageArticle.php?id=$selT->id><p class='btnLire'>Consulter la page de l'article</p></a>
    ";
  }

}


?>



<?php

include "frame/colRight.php";
include "frame/footer.php"; ?>
