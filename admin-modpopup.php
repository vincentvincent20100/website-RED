<?php include "frame/header-admin.php";?>
<?php $connect=new PDO("mysql:host=localhost; dbname=resaendirect-dev-code","root"); ?>


    <form class="" action="#" method="post" enctype="multipart/form-data">
<?php /*extraction de la bdd des paramètre de la popup configurée dans admin_popup.php*/
$selection = $connect->query("SELECT * FROM popup WHERE id_popup = '".$_GET['id']."'");
while ($selP = $selection->fetch(PDO::FETCH_OBJ)) {
  echo "<input type='hidden' id='idPopup' value='".$selP->id_popup."'>";
  echo '

      <div class="entete">
        <label for="nomCampagne">Dénomination campagne : </label><input type="text" name="nomCampagne" value="'.$selP->titrePopup.'"><br>
      </div>

      <div id="blocGlobal">
        <div id="zoneCrea" onkeyup="preView(this, \'previewDiv\');" onclick="preView(this, \'previewDiv\');">

      <br><p>Contenu : </p>
        <label for="titrePopup">Titre : </label><input type="text" name="titrePopup" id="titrePopup" value="Inscrivez-vous à la newsletter">
        <input type="number" value="'.$selP->tailleTitre.'" name="tailleTitre" id="tailleTitre">
        <input type="color" value="'.$selP->couleurTitre.'" name="couleurTitre" id="couleurTitre">
        <select name="epaisseurTitre" id="epaisseurTitre" value="'.$selP->epaisseurTitre.'"><option value="normal">Normal</option><option value="bold" selected>Gras</option></select>
        <select name="alignement" id="alignement" value="'.$selP->alignement.'"><option value="center">Centre</option><option value="left" selected>Gauche</option><option value="right">Droite</option></select></label><br>
        <label for="message">Message : </label><textarea name="message" id="message" value="Recevez toute notre actualité">'.$selP->message.'</textarea>
        <input type="number" value="'.$selP->tailleTexte.'" name="tailleTexte" id="tailleTexte">
        <input type="color" value="'.$selP->couleurTexte.'" name="couleurTexte" id="couleurTexte">
        <select name="epaisseurTexte" id="epaisseurTexte" value="'.$selP->epaisseurTexte.'"><option value="normal">Normal</option><option value="bold">Gras</option></select>
        <select name="alignementMessage" id="alignementMessage" value="'.$selP->alignementMessage.'"><option value="center">Centre</option><option value="left">Gauche</option><option value="right">Droite</option></select></label><br><br>
      <br><p>Formulaire de saisie : </p>
        <label for="titreSaisie">Titre :</label><input type="text" name="titreSaisie" id="titreSaisie" value="'.$selP->titreSaisie.'">
        <input type="number" value="'.$selP->tailleSaisie.'" name="tailleSaisie" id="tailleSaisie">
        <input type="color" value="'.$selP->couleurFormu.'" name="couleurFormu" id="couleurFormu">
        <select name="epaisseurSaisie" id="epaisseurSaisie"  value="'.$selP->epaisseurSaisie.'"><option value="normal">Normal</option><option value="bold">Gras</option></select>
        <select name="alignementTitreForm" id="alignementTitreForm" value="'.$selP->alignementTitreForm.'"><option value="center">Centre</option><option value="left">Gauche</option><option value="right">Droite</option></select></label><br><br>
        <label for="zoneSaisie">Suggestion de saisie d’email : </label><input type="text" name="zoneSaisie" id="zoneSaisie" value="'.$selP->zoneSaisie.'"><br>
        <label for="texteBtn">Bouton : </label><input type="text" name="texteBtn" id="texteBtn" value="'.$selP->texteBtn.'">
        <input type="number" value="'.$selP->tailleBtn.'" name="tailleBtn" id="tailleBtn">
        <select name="epaisseurBtn" id="epaisseurBtn" value="'.$selP->epaisseurBtn.'"><option value="normal">Normal</option><option value="bold">Gras</option></select>
        <label for="couleurTexteBtn">Texte </label><input type="color" value="'.$selP->couleurTexteBtn.'" name="couleurTexteBtn" id="couleurTexteBtn">
        <label for="couleurBtn">Fond </label><input type="color" value="'.$selP->couleurBtn.'" name="couleurBtn" id="couleurBtn">
        <label for="alignementBtn">Alignement du bouton :<select name="alignementBtn" id="alignementBtn" value="'.$selP->alignementBtn.'"><option value="a">à coté</option><option value="b">en dessous</option></select></label><br>
      <br><p>Mise en page : </p>
        <label for="tailleFenetre">Largeur </label><input type="number" value="'.$selP->tailleFenetre.'" name="tailleFenetre" id="tailleFenetre"> px<br>
        <label for="margeHaut">Marge en haut :</label><input type="number" name="margeHaut" id="margeHaut" value="'.$selP->margeHaut.'">
        <label for="margeBas">Marge en bas :</label><input type="number" name="margeBas" id="margeBas" value="'.$selP->margeBas.'">
        <label for="margeGauche">Marge à gauche :</label><input type="number" name="margeGauche" id="margeGauche" value="'.$selP->margeGauche.'">
        <label for="margeDroite">Marge à droite :</label><input type="number" name="margeDroite" id="margeDroite" value="'.$selP->margeDroite.'"><br>
        <label for="tailleBordure">Taille de la bordure :</label><input type="number" name="tailleBordure" id="tailleBordure" value="'.$selP->tailleBordure.'"> pixel<br>
        <label for="couleurFond">Couleur de fond :</label><input type="color" value="'.$selP->couleurFond.'" name="couleurFond" id="couleurFond"><br>
        <label for="couleurBordure">Couleur de la bordure :</label><input type="color" value="'.$selP->couleurBordure.'" name="couleurBordure" id="couleurBordure"><br>
      <br><p>Comportement : </p>
      <label for="delais">Délais d’affichage</label><input type="number" name="delais" id="delais" value="'.$selP->delais.'"> secondes<br>
      <hr><button type="submit" name="button" class="goToSite">Enregistrer</button>
';}
?>
    </form>
  </div>


  <div id="previewDiv">
  </div>
</div>


<script type="text/javascript">

/* - - - - - - - - - - - - - - - 1 - Construction du formulaire par défaut - - - - - - - - - - - - - - - */

var divPopUp = document.querySelector("#previewDiv").appendChild(document.createElement('div'));
  divPopUp.id = "divPopUp";
  divPopUp.style.position = "fixed";
  divPopUp.style.backgroundColor = document.querySelector('#couleurFond').value;
  divPopUp.style.width = document.querySelector('#tailleFenetre').value;
  divPopUp.style.borderWidth = document.querySelector('#tailleBordure').value;
  divPopUp.style.borderStyle = "solid";
  divPopUp.style.borderColor = document.querySelector('#couleurBordure').value;
  divPopUp.style.paddingTop = document.querySelector('#margeHaut').value;
  divPopUp.style.paddingBottom = document.querySelector('#margeBas').value;
  divPopUp.style.paddingLeft = document.querySelector('#margeGauche').value;
  divPopUp.style.paddingRight = document.querySelector('#margeDroite').value;
  // 1-Accroche
  var btnFermer = document.querySelector("#divPopUp").appendChild(document.createElement('button'));
  btnFermer.id = "croix";
  btnFermer.title = "Fermer";
  btnFermer.innerText = "x";
  btnFermer.style.float = "right";
  btnFermer.disabled = "disabled";
  var titre = document.querySelector("#divPopUp").appendChild(document.createElement('p'));
  titre.innerText = document.querySelector('#titrePopup').value;
  titre.style.fontSize = document.querySelector('#tailleTitre').value;
  titre.style.color = document.querySelector('#couleurTitre').value;
  titre.style.fontWeight = document.querySelector('#epaisseurTitre').value;
  titre.style.textAlign = document.querySelector('#alignement').value;
  var texte = document.querySelector("#divPopUp").appendChild(document.createElement('p'));
  texte.innerText = document.querySelector('#message').value;
  texte.style.fontSize = document.querySelector('#tailleTexte').value;
  texte.style.color = document.querySelector('#couleurTexte').value;
  texte.style.fontWeight = document.querySelector('#epaisseurTexte').value;
  texte.style.textAlign = document.querySelector('#alignementMessage').value;

  // 2-Formulaire
  var formu = document.querySelector("#divPopUp").appendChild(document.createElement('div'));

    var titreSaisie = formu.appendChild(document.createElement('p'));
    titreSaisie.innerText = document.querySelector('#titreSaisie').value;
    titreSaisie.style.color = document.querySelector('#couleurFormu').value;
    titreSaisie.style.fontSize = document.querySelector('#tailleSaisie').value;
    titreSaisie.style.fontWeight = document.querySelector('#epaisseurSaisie').value;
    titreSaisie.style.textAlign = document.querySelector('#alignementTitreForm').value;
    if (document.querySelector('#alignementBtn').value == "a") {

    }else if (document.querySelector('#alignementBtn').value == "b") {
      courriel.style.display = "block";
      courriel.style.margin = "auto";
      btnValider.style.display = "block";
      btnValider.style.margin = "auto";

    };
    var courriel = formu.appendChild(document.createElement('input'));
    courriel.type = "email";
    courriel.name = "emailNewsletter";
    courriel.placeholder = document.querySelector('#zoneSaisie').value;
    // courriel.value = "machin@truc.com"; pour les tests
    var btnValider = formu.appendChild(document.createElement('input'));
    btnValider.type = "submit";
    btnValider.value = document.querySelector('#texteBtn').value;
    btnValider.style.color = document.querySelector('#couleurTexteBtn').value;
    btnValider.style.backgroundColor = document.querySelector('#couleurBtn').value;
    btnValider.style.fontSize = document.querySelector('#tailleBtn').value;
    btnValider.style.fontWeight = document.querySelector('#epaisseurBtn').value;
    btnValider.disabled = "disabled";
    // var nomCampagne = formu.appendChild(document.createElement('input'));
    // nomCampagne.type = "hidden";
    // nomCampagne.name = "nomCampagne";
    // nomCampagne.value = document.querySelector('#nomCampagne').value;




/* - - - - - - - - - - - - - - - 2 - Modification dynamique du formulaire - - - - - - - - - - - - - - - */

function preView(textareaId, previewDiv){

  divPopUp.style.backgroundColor = document.querySelector('#couleurFond').value;
  divPopUp.style.width = document.querySelector('#tailleFenetre').value;
  divPopUp.style.borderWidth = document.querySelector('#tailleBordure').value;
  divPopUp.style.borderStyle = "solid";
  divPopUp.style.borderColor = document.querySelector('#couleurBordure').value;
  divPopUp.style.paddingTop = document.querySelector('#margeHaut').value;
  divPopUp.style.paddingBottom = document.querySelector('#margeBas').value;
  divPopUp.style.paddingLeft = document.querySelector('#margeGauche').value;
  divPopUp.style.paddingRight = document.querySelector('#margeDroite').value;

  titre.innerText = document.querySelector('#titrePopup').value;
  titre.style.fontSize = document.querySelector('#tailleTitre').value;
  titre.style.color = document.querySelector('#couleurTitre').value;
  titre.style.fontWeight = document.querySelector('#epaisseurTitre').value;
  titre.style.textAlign = document.querySelector('#alignement').value;

  texte.innerText = document.querySelector('#message').value;
  texte.style.fontSize = document.querySelector('#tailleTexte').value;
  texte.style.color = document.querySelector('#couleurTexte').value;
  texte.style.fontWeight = document.querySelector('#epaisseurTexte').value;
  texte.style.textAlign = document.querySelector('#alignementMessage').value;

    titreSaisie.innerText = document.querySelector('#titreSaisie').value;
    titreSaisie.style.color = document.querySelector('#couleurFormu').value;
    titreSaisie.style.fontSize = document.querySelector('#tailleSaisie').value;
    titreSaisie.style.fontWeight = document.querySelector('#epaisseurSaisie').value;
    titreSaisie.style.textAlign = document.querySelector('#alignementTitreForm').value;

    courriel.placeholder = document.querySelector('#zoneSaisie').value;

    btnValider.value = document.querySelector('#texteBtn').value;
    btnValider.style.color = document.querySelector('#couleurTexteBtn').value;
    btnValider.style.backgroundColor = document.querySelector('#couleurBtn').value;
    btnValider.style.fontSize = document.querySelector('#tailleBtn').value;
    btnValider.style.fontWeight = document.querySelector('#epaisseurBtn').value;
}

</script>





<?php

/* - - - - - - - - - - - - - - - enregistrement formulaire en bdd - - - - - - - - - - - - - - - */

if (!empty($_POST['nomCampagne'])) {
  $connect->exec("UPDATE popup SET nomCampagne='".$_POST['nomCampagne']."', etatCampagne='active', titrePopup='".$_POST['titrePopup']."', tailleTitre='".$_POST['tailleTitre']."', epaisseurTitre='".$_POST['epaisseurTitre']."',
   couleurTitre='".$_POST['couleurTitre']."', alignement='".$_POST['alignement']."', message='".$_POST['message']."', tailleTexte='".$_POST['tailleTexte']."', epaisseurTexte='".$_POST['epaisseurTexte']."', couleurTexte='".$_POST['couleurTexte']."',
    alignementMessage='".$_POST['alignementMessage']."', titreSaisie='".$_POST['titreSaisie']."', tailleSaisie='".$_POST['tailleSaisie']."', epaisseurSaisie='".$_POST['epaisseurSaisie']."', couleurFormu='".$_POST['couleurFormu']."',
    alignementTitreForm='".$_POST['alignementTitreForm']."', zoneSaisie='".$_POST['zoneSaisie']."', texteBtn='".$_POST['texteBtn']."', tailleBtn='".$_POST['tailleBtn']."', epaisseurBtn='".$_POST['epaisseurBtn']."',
    couleurBtn='".$_POST['couleurBtn']."', couleurTexteBtn='".$_POST['couleurTexteBtn']."', alignementBtn='".$_POST['alignementBtn']."', tailleFenetre='".$_POST['tailleFenetre']."', couleurFond='".$_POST['couleurFond']."',
    tailleBordure='".$_POST['tailleBordure']."', couleurBordure='".$_POST['couleurBordure']."', margeHaut='".$_POST['margeHaut']."', margeBas='".$_POST['margeBas']."', margeGauche='".$_POST['margeGauche']."',
    margeDroite='".$_POST['margeDroite']."', delais='".$_POST['delais']."' WHERE id_popup = '".$_GET['id']."'
    ");
    header('Location: admin-popup.php');

}

 ?>
 <?php include "frame/footer-admin.php"; ?>
