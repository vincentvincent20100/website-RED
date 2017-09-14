<?php include "frame/header-admin.php";?>

<div id="blocGlobal">
  <div class="col-left col editor-commands">
    <a><img src="img/btn-text-editor/icons8-Annuler-26.png" data-command="undo" title="Annuler" class="btn-editor"></a>
    <a><img src="img/btn-text-editor/icons8-Refaire-26.png" data-command="redo" title="Refaire" class="btn-editor"></a><br>
    <a><img src="img/btn-text-editor/bold_icon-icons.com_64708.png" data-command="bold" title="Gras" class="btn-editor"></a>
    <a><img src="img/btn-text-editor/italic_icon-icons.com_64714.png" data-command="italic" title="Italique" class="btn-editor"></a><br>
    <a><img src="img/btn-text-editor/underline_icon-icons.com_64727.png" data-command="underline" title="Souligner" class="btn-editor"></a>
    <a><img src="img/btn-text-editor/icons8-Barré Filled-50.png" data-command="strikeThrough" title="Barer" class="btn-editor"></a><br>
    <a><img src="img/btn-text-editor/left-alignment_icon-icons.com_64716.png" data-command="justifyLeft" title="Gauche" class="btn-editor"></a>
    <a><img src="img/btn-text-editor/center-alignment_icon-icons.com_64710.png" data-command="justifyCenter" title="Centre" class="btn-editor"></a>
    <a><img src="img/btn-text-editor/right-alignment_icon-icons.com_64723.png" data-command="justifyRight" title="Droite" class="btn-editor"></a>
    <a><img src="img/btn-text-editor/justify-align_icon-icons.com_64715.png" data-command="justifyFull" title="Justifier" class="btn-editor"></a><br>
    <a><img src="img/btn-text-editor/icons8-Indentation.png" data-command="indent" title="Indentation" class="btn-editor"></a>
    <a><img src="img/btn-text-editor/icons8-DiminuerRetrait.png" data-command="outdent" title="Diminuer le retrait" class="btn-editor"></a><br>
    <a><img src="img/btn-text-editor/icons8-puces.png" data-command="insertUnorderedList" title="Puces" class="btn-editor"></a>
    <a><img src="img/btn-text-editor/icons8-Liste numérotée-50.png" data-command="insertOrderedList" title="Numérotation" class="btn-editor"></a><br>
    <a><img src="img/btn-text-editor/icons8-En-tête 1 Filled-50.png" data-command="html" data-command="h1" title="Titre 1" class="btn-editor"></a>
    <a><img src="img/btn-text-editor/icons8-En-tête 2 Filled-50.png" data-command="html" data-command="h2" title="Titre 2" class="btn-editor"></a>
    <a><img src="img/btn-text-editor/icons8-En-tête 3 Filled-50.png" data-command="html" data-command="h3" title="Titre 3" class="btn-editor"></a>
    <a><img src="img/btn-text-editor/icons8-Paragraphe Filled-50.png" data-command="html" data-command="p" title="paragraphe" class="btn-editor"></a><br>
    <a><img src="img/btn-text-editor/icons8-Indice-48.png" data-command="subscript" title="" class="btn-editor"></a>
    <a><img src="img/btn-text-editor/icons8-Exposant-48.png" data-command="superscript" title="Exposant" class="btn-editor"></a><br>
    <a data-command="insertHorizontalRule" class="btn-editor">_______________</a><br><br>

  <a><img src="img/btn-text-editor/bold_icon-icons.com_64708.png" data-command="fontSize" title="Taille" class="btn-editor"></a>
  <a><img src="img/btn-text-editor/icons8-Copie-50.png" data-command="copy" title="Copier" class="btn-editor"></a>
  <a><img src="img/btn-text-editor/icons8-Coller-50.png" data-command="paste" title="Coller" class="btn-editor"></a>


    <span onclick="toto()"><img src="img/btn-text-editor/diskette_icon-icons.com_64711.png" title="Enregistrer" class="btn-editor"></span>

  </div>





<div class='blocArticleSolo'>
  <div contenteditable='true'>
    <h1>Titre</h1>
  </div>
  <p class='catArticleSolo'>
    <select name="categorie" id="categorie">
      <?php // on va chercher en bdd toutes les catégories existantes
      $selection2 = $connect->query("SELECT * FROM categorie_article");
      while ($s=$selection2->fetch(PDO::FETCH_OBJ)) {
        echo "<option value=".$s->libelle_categorie.">$s->libelle_categorie</option>";
      }
      ?>
    </select><br></p>
  <p class='dateSolo'><?php echo date("d-m-Y"); ?></p>
  <div class="content" contenteditable='true'>
    <p>Texte</p>
  </div>
</div>


  <div class="col-right col">
    bouton partage ?
  </div>
</div>





<script type="text/javascript">
var commandButtons = document.querySelectorAll(".editor-commands a");
for (var i = 0; i < commandButtons.length; i++) {
  commandButtons[i].addEventListener("mousedown", function (e) {
      e.preventDefault();
      var commandName = e.target.getAttribute("data-command");
      if (commandName === "html") {
          var commandArgument = e.target.getAttribute("data-command-argument");
          document.execCommand('formatBlock', false, commandArgument);
      } else {
          document.execCommand(commandName, false);
      }
  });
}




function toto(){
  var formu = document.querySelector(".editor-commands").appendChild(document.createElement('form'));
  formu.method = 'post';
  var categorie = formu.appendChild(document.createElement('input'));
  categorie.type = "hidden";
  categorie.name = "categorie";
  categorie.value = document.querySelector("#categorie").value;
  var article = formu.appendChild(document.createElement('input'));
  article.type = "hidden";
  article.name = "texte";
  article.value = document.querySelector(".content").innerHTML;
  var btnValider = formu.appendChild(document.createElement('input'));
  btnValider.type = "submit";
  btnValider.value = 'Publier';
}

</script>
<?php /* - - - - - - - - - - - - - - Enregistrement en base - - - - - - - - - - - - - - */
if (!empty($_POST["texte"])) {
  $texte = str_replace('\'','’',$_POST["texte"]); // remplacer les ' par ’
  $categorie = $_POST["categorie"];
  echo $texte;
  $connect->exec("INSERT INTO article (titre_article, contenu_article, date_article, categorie_article, image_article)
  VALUES ('test-article-3', '".$texte."', now(), '".$categorie."', '81')")
  ;
}
 ?>
<?php include "frame/footer-admin.php"; ?>
