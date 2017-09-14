<?php include "frame/header-admin.php";?>

<div id="blocGlobal">
  <div class="carousel">
    <?php
    $selection = $connect->query("SELECT url FROM image");
    while ($si = $selection->fetch(PDO::FETCH_OBJ)) {
      echo "<img src='$si->url' onclick='insertImage(\"$si->url\")'>";
    }
     ?>
  </div>
    <div id='zoneCrea' >
      <form action="" method="post">
      <p>
        <input type="button" value="G" onclick="insertBalise('<gras>','</gras>','textarea');" />
        <input type="button" value="I" onclick="insertBalise('<italique>','</italique>','textarea');" />
        <input type="button" value="Lien" onclick="insertBalise('<lien>','</lien>','textarea');" />
        <input type="button" value="Image" onclick="insertBalise('<image>','</image>','textarea');" />

        <input type="number" name="tailleTexte" id="tailleTexte" value="14" onclick="modif();">
        <input type="number" name="tailleTexte" id="tailleTexte2" value="14" onchange="insertBalise('<taille>','</taille>','textarea');" onclick="modif();">

        <select onchange="insertBalise('<' + this.value + '>', '</' + this.value + '>','textarea');">
          <option value="none" class="selected" selected="selected">Titre</option>
          <option value="h1">Titre 1</option>
          <option value="h2">Titre 2</option>
          <option value="h3">Titre 3</option>
          <option value="h4">Titre 4</option>
          <option value="h5">Titre 5</option>
          <option value="h6">Titre 6</option>
          <option value="l">Légende</option>
        </select>


        <label for="previsualisation">Prévisualisation</label><input name="previsualisation" type="checkbox" id="previsualisation" value="previsualisation" checked />
        <input type="submit" value="Enregistrer" />
      </p>

      <textarea name="texte" onkeyup="preView(this, 'previewDiv');" onselect="preView(this, 'previewDiv');" cols="90" rows="100"></textarea>

    </form>
    </div>

    <div id="previewDiv"></div>

</div>




<script type="text/javascript">
// document.forms["B"].apres.value =
function toto(){alert('totoooooo');}



/* - - - - - - - - - - - - - - modif dynamique pour input type number  - - - - - - - - - - - - - - */
function modif(){
  document.querySelector(".tailleZone").style.fontSize = document.querySelector("#tailleTexte2").value;
  document.querySelector('#previewDiv').style.fontSize = document.querySelector('#tailleTexte').value;
}
/* - - - - - - - - - - - - - - Images - - - - - - - - - - - - - - */
function insertImage(url){
  document.querySelector('textarea').value += '<image>'+url+'</image>';
}



function insertBalise(debutBalise, finBalise, textareaId, typeBalise) {
  if (document.querySelector(".tailleZone")  && debutBalise=="<taille>") { // évite que les balises s'accumulent lorsqu'on change la taille d'un texte

  }else {

    var zoneTexte = document.querySelector(textareaId);
    var curseur = zoneTexte.scrollTop;  // On met en mémoire la position du curseur (scrollTop : Obtient le nombre de pixels défilés)
    zoneTexte.focus(); // On remet le focus sur la zone de texte, suivant les navigateurs, on perd le focus en appelant la fonction.

    var beforeSelection = zoneTexte.value.substring(0, zoneTexte.selectionStart); // récupérer le contenu avant la sélection
    var currentSelection = zoneTexte.value.substring(zoneTexte.selectionStart, zoneTexte.selectionEnd); // récupérer la sélection courante
    var afterSelection = zoneTexte.value.substring(zoneTexte.selectionEnd); // récupérer le contenu après la sélection
    zoneTexte.value = beforeSelection + debutBalise + currentSelection + finBalise + afterSelection; // remplacer le contenu de la zone de texte par le nouveau contenu comprenant les balises
    zoneTexte.focus(); // On remet le focus sur la zone de texte

    zoneTexte.setSelectionRange(beforeSelection.length + debutBalise.length, beforeSelection.length + debutBalise.length + currentSelection.length); // sélectionner le contenu nouvellement encadré
    zoneTexte.scrollTop = curseur; // et on redéfinit le curseur
  }
}


function preView(textareaId, previewDiv) {

	var field = textareaId.value;
	if (document.getElementById('previsualisation').checked && field) {

		field = field.replace(/&/g, '&amp;');
		field = field.replace(/</g, '&lt;').replace(/>/g, '&gt;');
		field = field.replace(/\n/g, '<br />').replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
		field = field.replace(/&lt;gras&gt;([\s\S]*?)&lt;\/gras&gt;/g, '<strong>$1</strong>');
		field = field.replace(/&lt;italique&gt;([\s\S]*?)&lt;\/italique&gt;/g, '<em>$1</em>');
		field = field.replace(/&lt;lien&gt;([\s\S]*?)&lt;\/lien&gt;/g, '<a href="$1">$1</a>');
		field = field.replace(/&lt;lien url="([\s\S]*?)"&gt;([\s\S]*?)&lt;\/lien&gt;/g, '<a href="$1" title="$2">$2</a>');
		field = field.replace(/&lt;image&gt;([\s\S]*?)&lt;\/image&gt;/g, '<img src="$1" alt="Image" />');
		field = field.replace(/&lt;taille valeur=\"(.*?)\"&gt;([\s\S]*?)&lt;\/taille&gt;/g, '<span class="$1">$2</span>');

    // mes tests
    field = field.replace(/&lt;h1&gt;([\s\S]*?)&lt;\/h1&gt;/g, '<h1>$1</h1>');
    field = field.replace(/&lt;h2&gt;([\s\S]*?)&lt;\/h2&gt;/g, '<h2>$1</h2>');
    field = field.replace(/&lt;h3&gt;([\s\S]*?)&lt;\/h3&gt;/g, '<h3>$1</h3>');
    field = field.replace(/&lt;h4&gt;([\s\S]*?)&lt;\/h4&gt;/g, '<h4>$1</h4>');
    field = field.replace(/&lt;h5&gt;([\s\S]*?)&lt;\/h5&gt;/g, '<h5>$1</h5>');
    field = field.replace(/&lt;h6&gt;([\s\S]*?)&lt;\/h6&gt;/g, '<h6>$1</h6>');
    field = field.replace(/&lt;l&gt;([\s\S]*?)&lt;\/l&gt;/g, '<p class="legende">$1</p>');
    field = field.replace(/&lt;taille&gt;([\s\S]*?)&lt;\/taille&gt;/g, '<span class="tailleZone">$1</span>');

		document.getElementById(previewDiv).innerHTML = field;
	}
  // modification taille texte sélectionné
  if (document.querySelector(".tailleZone")) {
      document.querySelector(".tailleZone").style.fontSize = document.querySelector("#tailleTexte2").value;
  }
}




</script>




<?php /* - - - - - - - - - - - - - - Enregistrement en base - - - - - - - - - - - - - - */
if (!empty($_POST["texte"])) {
  $texte = str_replace('\'','’',$_POST["texte"]); // remplacer les ' par ’
  echo $texte;
  $connect->exec("INSERT INTO article (titre_article, contenu_article, date_article, categorie_article, image_article)
  VALUES ('test-article', '".$texte."', now(), 'merdouillon', '81')")
  ;
}
 ?>



<?php include "frame/footer-admin.php"; ?>
