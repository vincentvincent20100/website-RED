<?php
  session_start();

  // vérification identification
  echo $_SESSION['connexion'];
  if ($_SESSION['connexion'] != "connecté") { // s'il n'est pas noté comme connecté, on propose les options suivantes
    echo "Vous devez vous connecter avec compte pour accéder à cette page<br>";
    echo "<p id='formulaireIdentification'>Connexion administration</p><br>";
    echo '<script src="form/connexion.js" charset="utf-8"></script>'; // script écoutant l'id 'formulaireIdentification' ci-dessus
    echo "<a href='index.php'>Accueil</a>";
    die();
  }else { // s'il est connecté, on propose un bouton déconnexion
    echo "<a href='form/connexion.php?out=oui'>Déconnexion</a><br>";
  }

  // création connexion bdd pour toutes les pages de l'admin
  $serveur="mysql:host=localhost; dbname=resaendirect-dev-code";
  $user="root";
  $pass="";
  $connect=new PDO($serveur,$user,$pass); //PDO php data object
  $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING); // afficher les erreurs
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Tableau de bord</title>
  </head>
  <body>
    <header>
      <a href="../admin.php"><h1>Tableau de bord</h1></a>
      <a href="index.php">Aller sur le site</a>
      <?php //echo "bonjour".$_SESSION['identifiant']; ?>
      <nav>
        <a href="../admin-article-liste.php">Article</a>
        <a href="../admin-article.php"><button>+</button></a>
        <a href="../admin-annonce.php">Annonce</a>
        <a href="../admin-addAnnonce.php"><button>+</button></a>
        <a href="../admin-popup.php">Pop-up</a>
        <a href="../admin-addpopup.php"><button>+</button></a>
        <?php if ($_SESSION['statu'] == "administrateur") {
          echo '<a href="../admin-utilisateur.php">Gestion des utilisateurs</a>';
        } ?>

        <a href="../admin-image.php">Gestion des images</a>
        <a href="../admin-duplication.php">Anti-duplication</a>
        <a href="../test-article.php">Test article</a>
        <a href="../test-article2.php">Test article origine</a>
        <a href="../test-article3.php">Test article 3</a>
      </nav>
    </header>
    <main>






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
</script>




<body onload="initDoc();">

  <div class="col-left col">
    <iframe src="../frame/iframeImage.php" width="100%" height="500px"></iframe>
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
      <img class="intLink" title="Clean" onclick="if(validateMode()&&confirm('Êtes-vous bien certain de tout effacer ?')){oDoc.innerHTML=sDefTxt};" src="../img/btn-text-editor2/clean.gif" />
      <img class="intLink" title="Print" onclick="printDoc();" src="../img/btn-text-editor2/print.png">
      <img class="intLink" title="Undo" onclick="formatDoc('undo');" src="../img/btn-text-editor2/undo.gif" />
      <img class="intLink" title="Redo" onclick="formatDoc('redo');" src="../img/btn-text-editor2/redo.gif" />
      <img class="intLink" title="Remove formatting" onclick="formatDoc('removeFormat')" src="../img/btn-text-editor2/removeFormat.png">
      <img class="intLink" title="Bold" onclick="formatDoc('bold');" src="../img/btn-text-editor2/bold.gif" />
      <img class="intLink" title="Italic" onclick="formatDoc('italic');" src="../img/btn-text-editor2/italic.gif" />
      <img class="intLink" title="Underline" onclick="formatDoc('underline');" src="../img/btn-text-editor2/underline.gif" />
      <img class="intLink" title="Left align" onclick="formatDoc('justifyleft');" src="../img/btn-text-editor2/gauche.gif" />
      <img class="intLink" title="Center align" onclick="formatDoc('justifycenter');" src="../img/btn-text-editor2/centre.gif" />
      <img class="intLink" title="Right align" onclick="formatDoc('justifyright');" src="../img/btn-text-editor2/droite.gif" />
      <img class="intLink" title="Numbered list" onclick="formatDoc('insertorderedlist');" src="../img/btn-text-editor2/listeNum.gif" />
      <img class="intLink" title="Dotted list" onclick="formatDoc('insertunorderedlist');" src="../img/btn-text-editor2/listePuce.gif" />
      <img class="intLink" title="Quote" onclick="formatDoc('formatblock','blockquote');" src="../img/btn-text-editor2/guillemet.gif" />
      <img class="intLink" title="Add indentation" onclick="formatDoc('outdent');" src="../img/btn-text-editor2/retraitG.gif" />
      <img class="intLink" title="Delete indentation" onclick="formatDoc('indent');" src="../img/btn-text-editor2/retraitD.gif" />
      <img class="intLink" title="Hyperlink" onclick="var sLnk=prompt('Write the URL here','http:\/\/');if(sLnk&&sLnk!=''&&sLnk!='http://'){formatDoc('createlink',sLnk)}" src="../img/btn-text-editor2/lien.gif" />
      <img class="intLink" title="Cut" onclick="formatDoc('cut');" src="../img/btn-text-editor2/cut.gif" />
      <img class="intLink" title="Copy" onclick="formatDoc('copy');" src="../img/btn-text-editor2/copy.gif" />
      <img class="intLink" title="Paste" onclick="formatDoc('paste');" src="../img/btn-text-editor2/paste.gif" />

    </div>




    <div class='blocArticleSolo'>
      <div contenteditable='true'>
        <?php
          $idArticle = $_GET['numArticle']; // récupère l'id de l'article à modifier depuis admin-article-list.php
          $selectionIdArticle = $connect->query("SELECT * FROM article LEFT JOIN image ON article.image_article=image.id_image WHERE id = '".$idArticle."'"); // récupère les données à modifier
          $si = $selectionIdArticle->fetch(PDO::FETCH_OBJ);
          echo "<h1 id='titreArticle'>$si->titre_article</h1>"; // titre
         ?>
      </div>
      <p class='catArticleSolo'>
        <select name="categorie" id="categorie">
          <?php // on va chercher en bdd toutes les catégories existantes
          $selection2 = $connect->query("SELECT * FROM categorie_article");
          while ($s=$selection2->fetch(PDO::FETCH_OBJ)) {
            if ($s->libelle_categorie == $si->categorie_article) {
              echo "<option value=".$s->libelle_categorie." selected>$s->libelle_categorie</option>"; // catégorie
            }else {
              echo "<option value=".$s->libelle_categorie.">$s->libelle_categorie</option>";
            }
          }
          ?>
        </select><br></p>
      <p class='dateSolo'><?php echo date("d-m-Y"); // ---------------- permettre mise à jour date ? ---------------?></p>
      <div class="content" contenteditable='true'>
        <?php
          echo "<p>$si->contenu_article</p>"; // contenu
         ?>
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
        <img src="<?php echo $si->url; ?>" class="image">
      </div>
    </div>
    <span onclick="save()"><img src="../img/btn-text-editor/diskette_icon-icons.com_64711.png" title="Enregistrer" class="btn-editor"></span>

  </div>




<script type="text/javascript">

function save(){
  if (!document.querySelector(".imgArtCol img")) {
    alert("Vous avez oublié d'ajouter une image de présentation")
  }else{
    var formu = document.querySelector(".col-right").appendChild(document.createElement('form'));
    formu.method = 'post';
    formu.action = '../admin-article-liste.php';
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
