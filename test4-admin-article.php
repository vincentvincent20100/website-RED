<?php include "frame/header-admin.php";?>

<script type="text/javascript">
var oDoc, sDefTxt;

function initDoc() {
  oDoc = document.querySelector(".content");
  sDefTxt = oDoc.innerHTML;
  if (document.compForm.switchMode.checked) { setDocMode(true); }
}

function formatDoc(sCmd, sValue) {
  if (validateMode()) { document.execCommand(sCmd, false, sValue); oDoc.focus(); }
}

function validateMode() {
  if (!document.compForm.switchMode.checked) { return true ; }
  alert("Uncheck \"Show HTML\".");
  oDoc.focus();
  return false;
}
//
// function setDocMode(bToSource) {
//   var oContent;
//   if (bToSource) {
//     oContent = document.createTextNode(oDoc.innerHTML);
//     oDoc.innerHTML = "";
//     var oPre = document.createElement("pre");
//     oDoc.contentEditable = false;
//     oPre.id = "sourceText";
//     oPre.contentEditable = true;
//     oPre.appendChild(oContent);
//     oDoc.appendChild(oPre);
//   } else {
//     if (document.all) {
//       oDoc.innerHTML = oDoc.innerText;
//     } else {
//       oContent = document.createRange();
//       oContent.selectNodeContents(oDoc.firstChild);
//       oDoc.innerHTML = oContent.toString();
//     }
//     oDoc.contentEditable = true;
//   }
//   oDoc.focus();
// }
//
// function printDoc() {
//   if (!validateMode()) { return; }
//   var oPrntWin = window.open("","_blank","width=450,height=470,left=400,top=100,menubar=yes,toolbar=no,location=no,scrollbars=yes");
//   oPrntWin.document.open();
//   oPrntWin.document.write("<!doctype html><html><head><title>Print<\/title><\/head><body onload=\"print();\">" + oDoc.innerHTML + "<\/body><\/html>");
//   oPrntWin.document.close();
// }
</script>




<body onload="initDoc();">

  <div class="col-left col">
    <iframe src="frame/iframeImage.php" width="100%" height="500px"></iframe>
    <?php
    /* affiche toutes les images */
    // $annonces = $connect->query('SELECT * FROM image ORDER BY id_image DESC'); //
    // while ($a = $annonces->fetch(PDO::FETCH_OBJ)) {
    //   echo
    //   "
    //   <div>
    //     <img class='image' src='$a->url' onclick='formatDoc(\"insertImage\", \"$a->url\");'>
    //   </div>";
    //   // <div class='blocGlobal'>
    // }
    ?>
  </div>


  <div class='zoneCreaArticle'>

  <form name="compForm" method="post" action="#" onsubmit="if(validateMode()){this.myDoc.value=oDoc.innerHTML;return true;}return false;">
    <input type="hidden" name="myDoc">
    <div id="toolBar1">
      <select onchange="formatDoc('formatblock',this[this.selectedIndex].value);this.selectedIndex=0;">
      <option selected>- Structure -</option>
      <option value="h1">Titre 1 &lt;h1&gt;</option>
      <option value="h2">Titre 2 &lt;h2&gt;</option>
      <option value="h3">Titre 3 &lt;h3&gt;</option>
      <option value="h4">Titre 4 &lt;h4&gt;</option>
      <option value="h5">Titre 5 &lt;h5&gt;</option>
      <option value="h6">Sous-titre &lt;h6&gt;</option>
      <option value="p">Paragraphe &lt;p&gt;</option>
      <option value="pre">Preformaté &lt;pre&gt;</option>
      </select>
      <select onchange="formatDoc('fontname',this[this.selectedIndex].value);this.selectedIndex=0;">
      <option class="heading" selected>- Police -</option>
      <option>Arial</option>
      <option>Arial Black</option>
      <option>Courier New</option>
      <option>Times New Roman</option>
      </select>
      <select onchange="formatDoc('fontsize',this[this.selectedIndex].value);this.selectedIndex=0;">
      <option class="heading" selected>- Taille -</option>
      <option value="1">Very small</option>
      <option value="2">A bit small</option>
      <option value="3">Normal</option>
      <option value="4">Medium-large</option>
      <option value="5">Big</option>
      <option value="6">Very big</option>
      <option value="7">Maximum</option>
      </select>
      <select onchange="formatDoc('forecolor',this[this.selectedIndex].value);this.selectedIndex=0;">
      <option class="heading" selected>- Couleur -</option>
      <option value="red">Red</option>
      <option value="blue">Blue</option>
      <option value="green">Green</option>
      <option value="black">Black</option>
      </select>
      <select onchange="formatDoc('backcolor',this[this.selectedIndex].value);this.selectedIndex=0;">
      <option class="heading" selected>- Fond -</option>
      <option value="red">Red</option>
      <option value="green">Green</option>
      <option value="black">Black</option>
      </select>
    </div>
    <div id="toolBar2">
      <img class="intLink" title="Clean" onclick="if(validateMode()&&confirm('Êtes-vous bien certain de tout effacer ?')){oDoc.innerHTML=sDefTxt};" src="img/btn-text-editor2/clean.gif" />
      <img class="intLink" title="Print" onclick="printDoc();" src="img/btn-text-editor2/print.png">
      <img class="intLink" title="Undo" onclick="formatDoc('undo');" src="img/btn-text-editor2/undo.gif" />
      <img class="intLink" title="Redo" onclick="formatDoc('redo');" src="img/btn-text-editor2/redo.gif" />
      <img class="intLink" title="Remove formatting" onclick="formatDoc('removeFormat')" src="img/btn-text-editor2/removeFormat.png">
      <img class="intLink" title="Bold" onclick="formatDoc('bold');" src="img/btn-text-editor2/bold.gif" />
      <img class="intLink" title="Italic" onclick="formatDoc('italic');" src="img/btn-text-editor2/italic.gif" />
      <img class="intLink" title="Underline" onclick="formatDoc('underline');" src="img/btn-text-editor2/underline.gif" />
      <img class="intLink" title="Left align" onclick="formatDoc('justifyleft');" src="img/btn-text-editor2/gauche.gif" />
      <img class="intLink" title="Center align" onclick="formatDoc('justifycenter');" src="img/btn-text-editor2/centre.gif" />
      <img class="intLink" title="Right align" onclick="formatDoc('justifyright');" src="img/btn-text-editor2/droite.gif" />
      <img class="intLink" title="Numbered list" onclick="formatDoc('insertorderedlist');" src="img/btn-text-editor2/listeNum.gif" />
      <img class="intLink" title="Dotted list" onclick="formatDoc('insertunorderedlist');" src="img/btn-text-editor2/listePuce.gif" />
      <img class="intLink" title="Quote" onclick="formatDoc('formatblock','blockquote');" src="img/btn-text-editor2/guillemet.gif" />
      <img class="intLink" title="Add indentation" onclick="formatDoc('outdent');" src="img/btn-text-editor2/retraitG.gif" />
      <img class="intLink" title="Delete indentation" onclick="formatDoc('indent');" src="img/btn-text-editor2/retraitD.gif" />
      <img class="intLink" title="Hyperlink" onclick="var sLnk=prompt('Write the URL here','http:\/\/');if(sLnk&&sLnk!=''&&sLnk!='http://'){formatDoc('createlink',sLnk)}" src="img/btn-text-editor2/lien.gif" />
      <img class="intLink" title="Cut" onclick="formatDoc('cut');" src="img/btn-text-editor2/cut.gif" />
      <img class="intLink" title="Copy" onclick="formatDoc('copy');" src="img/btn-text-editor2/copy.gif" />
      <img class="intLink" title="Paste" onclick="formatDoc('paste');" src="img/btn-text-editor2/paste.gif" />

    </div>




    <div class='blocArticleSolo'>
      <div contenteditable='true'>
        <h1 id="titreArticle">Titre</h1>
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

    <!-- comment se débarasser de ce truc ?  -->
    <p id="editMode"><input type="hidden" name="switchMode" id="switchBox" onchange="setDocMode(this.checked);" />
      <!-- <label for="switchBox">Show HTML</label>-->
    </p>
  </form>
  </div>



  <div class="col-right col">
    <div class='artCol'>
      <p>Image de presentation</p>
      <div class='imgArtCol' contenteditable='true'>
        .
      </div>
    </div>
    <span onclick="save()"><img src="img/btn-text-editor/diskette_icon-icons.com_64711.png" title="Enregistrer" class="btn-editor"></span>

  </div>




<script type="text/javascript">

function save(){
  if (!document.querySelector(".imgArtCol img")) {
    alert("Vous avez oublié d'ajouter une image de présentation")
  }else{
    var formu = document.querySelector(".col-right").appendChild(document.createElement('form'));
    formu.method = 'post';
    formu.action = 'admin-article-liste.php';
    var titre = formu.appendChild(document.createElement('input'));
    titre.type = "hidden";
    titre.name = "titre";
    titre.value = document.querySelector("#titreArticle").innerText;
    var categorie = formu.appendChild(document.createElement('input'));
    categorie.type = "hidden";
    categorie.name = "categorie";
    categorie.value = document.querySelector("#categorie").value;
    var article = formu.appendChild(document.createElement('input'));
    article.type = "hidden";
    article.name = "texte";
    article.value = document.querySelector(".content").innerHTML;
    var article = formu.appendChild(document.createElement('input'));
    article.type = "hidden";
    article.name = "imagePresentation";
    // article.value = document.querySelector(".imgArtCol").innerHTML;
    article.value = document.querySelector(".imgArtCol img").src;
    formu.submit();
  }
}

</script>




<?php include "frame/footer-admin.php"; ?>
