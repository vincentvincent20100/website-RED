<?php include "frame/header-admin.php";?>
<?php $connect=new PDO("mysql:host=localhost; dbname=resaendirect-dev-code","root"); ?>

<form class="" action="#" method="post" enctype="multipart/form-data">

<div class="entete">
  <label for="nomCampagne">Dénomination campagne : </label><input type="text" name="nomCampagne"><br>
</div>
<div id="blocGlobal">

  <div id="zoneCrea" onkeyup="preView(this, 'previewDiv');" onclick="preView(this, 'previewDiv');">

      <br><h4>Contenu : </h4>
        <label for="titrePopup">Titre : </label><input type="text" name="titrePopup" id="titrePopup" value="Inscrivez-vous à la newsletter">
        <input type="number" value="18" name="tailleTitre" id="tailleTitre">
        <input type="color" value="#000000" name="couleurTitre" id="couleurTitre">
        <select name="epaisseurTitre" id="epaisseurTitre"><option value="normal">Normal</option><option value="bold" selected>Gras</option></select>
        <select name="alignement" id="alignement"><option value="center">Centre</option><option value="left" selected>Gauche</option><option value="right">Droite</option></select></label><br>
        <label for="message">Message : </label><textarea name="message" id="message" value="Recevez toute notre actualité">Toute notre actu</textarea>
        <input type="number" value="12" name="tailleTexte" id="tailleTexte">
        <input type="color" value="#000000" name="couleurTexte" id="couleurTexte">
        <select name="epaisseurTexte" id="epaisseurTexte"><option value="normal">Normal</option><option value="bold">Gras</option></select>
        <select name="alignementMessage" id="alignementMessage"><option value="center">Centre</option><option value="left">Gauche</option><option value="right">Droite</option></select></label><br><br>
      <br><h4>Formulaire de saisie : </h4>
        <label for="titreSaisie">Titre : </label><input type="text" name="titreSaisie" id="titreSaisie" value="Saisissez votre email">
        <input type="number" value="12" name="tailleSaisie" id="tailleSaisie">
        <input type="color" value="#000000" name="couleurFormu" id="couleurFormu">
        <select name="epaisseurSaisie" id="epaisseurSaisie"><option value="normal">Normal</option><option value="bold">Gras</option></select>
        <select name="alignementTitreForm" id="alignementTitreForm"><option value="center">Centre</option><option value="left">Gauche</option><option value="right">Droite</option></select></label><br><br>
        <label for="zoneSaisie">Suggestion de saisie d'email : </label><input type="text" name="zoneSaisie" id="zoneSaisie" value="machin@truc.com"><br>
        <label for="texteBtn">Bouton : </label><input type="text" name="texteBtn" id="texteBtn" value="Valider">
        <input type="number" value="12" name="tailleBtn" id="tailleBtn">
        <select name="epaisseurBtn" id="epaisseurBtn"><option value="normal">Normal</option><option value="bold">Gras</option></select>
        <label for="couleurTexteBtn">Texte </label><input type="color" value="#000000" name="couleurTexteBtn" id="couleurTexteBtn">
        <label for="couleurBtn">Fond </label><input type="color" value="#e1e1e1" name="couleurBtn" id="couleurBtn">
        <label for="alignementBtn">Alignement du bouton :<select name="alignementBtn" id="alignementBtn"><option value="a">à coté</option><option value="b">en dessous</option></select></label><br>
      <br><h4>Mise en page : </h4>
        <label for="tailleFenetre">Largeur </label><input type="number" value="300" name="tailleFenetre" id="tailleFenetre"> px<br>
        <label for="margeHaut">Marge en haut :</label><input type="number" name="margeHaut" id="margeHaut" value="8">
        <label for="margeBas">Marge en bas :</label><input type="number" name="margeBas" id="margeBas" value="8">
        <label for="margeGauche">Marge à gauche :</label><input type="number" name="margeGauche" id="margeGauche" value="10">
        <label for="margeDroite">Marge à droite :</label><input type="number" name="margeDroite" id="margeDroite" value="10"><br>
        <label for="tailleBordure">Taille de la bordure :</label><input type="number" name="tailleBordure" id="tailleBordure" value="1"> pixel<br>
        <label for="couleurFond">Couleur de fond :</label><input type="color" value="#fefaf5" name="couleurFond" id="couleurFond"><br>
        <label for="couleurBordure">Couleur de la bordure :</label><input type="color" value="#000000" name="couleurBordure" id="couleurBordure"><br>
      <br><h4>Comportement : </h4>
      <label for="delais">Délais d'affichage</label><input type="number" name="delais" id="delais" value="1"> secondes<br>

      <hr>
      <button type="submit" name="button" class="goToSite">Enregistrer</button>
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

    // var divPopUp = document.querySelector("#previewDiv").appendChild(document.createElement('div'));
    // divPopUp.id = "divPopUp";
    //   // 1-Accroche
//       var btnFermer = document.querySelector("#divPopUp").appendChild(document.createElement('button'));
//       btnFermer.id = "croix";
//       btnFermer.title = "Fermer";
//       btnFermer.innerText = "x";
//       var titre = document.querySelector("#divPopUp").appendChild(document.createElement('p'));
//       titre.innerText = document.querySelector('#titrePopup').value;
//       var texte = document.querySelector("#divPopUp").appendChild(document.createElement('p'));
//       texte.innerText = document.getElementsByName('#message').value;
//
//
//       // 2-Formulaire
//       var formu = document.querySelector("#divPopUp").appendChild(document.createElement('form'));
//       formu.method = "post";
//       formu.action = "#";
//         var nomCampagne = formu.appendChild(document.createElement('input'));
//         nomCampagne.type = "hidden";
//         nomCampagne.name = "nomCampagne";
//         nomCampagne.value = document.querySelector('#nomCampagne').value;
//         var titreSaisie = formu.appendChild(document.createElement('p'));
//         titreSaisie.innerText = document.querySelector('#titreSaisie').value;
//         var courriel = formu.appendChild(document.createElement('input'));
//         courriel.type = "email";
//         courriel.name = "emailNewsletter";
//         courriel.placeholder = document.querySelector('#zoneSaisie').value;
//         // courriel.value = "machin@truc.com"; pour les tests
//         var btnValider = formu.appendChild(document.createElement('input'));
//         btnValider.type = "submit";
//         btnValider.value = document.querySelector('#texteBtn').value;
//
//       //3-Style du bloc
//       divPopUp.style.width = document.querySelector('#tailleFenetre').value;
//       divPopUp.style.borderWidth = document.querySelector('#tailleBordure').value;
//       divPopUp.style.borderStyle = "solid";
//       divPopUp.style.borderColor = document.querySelector('#couleurBordure').value;
//       divPopUp.style.paddingTop = document.querySelector('#margeHaut').value;
//       divPopUp.style.paddingBottom = document.querySelector('#margeBas').value;
//       divPopUp.style.paddingLeft = document.querySelector('#margeGauche').value;
//       divPopUp.style.paddingRight = document.querySelector('#margeDroite').value;
//       // 3-Police
//       titre.style.fontSize = document.querySelector('#tailleTitre').value;
//       titre.style.fontWeight = document.querySelector('#epaisseurTitre').value;
//       texte.style.fontSize = document.querySelector('#tailleTexte').value;
//       texte.style.fontWeight = document.querySelector('#epaisseurTexte').value;
//       titreSaisie.style.fontSize = document.querySelector('#tailleSaisie').value;
//       titreSaisie.style.fontWeight = document.querySelector('#epaisseurSaisie').value;
//       btnValider.style.fontSize = document.querySelector('#tailleBtn').value;
//       btnValider.style.fontWeight = document.querySelector('#epaisseurBtn').value;
//
//       // 3-Position des éléments
//       titre.style.textAlign = document.querySelector('#alignement').value;
//       texte.style.textAlign = document.querySelector('#alignementMessage').value;
//       titreSaisie.style.textAlign = document.querySelector('#alignementTitreForm').value;
//       if (document.querySelector('#alignementBtn').value == "a") {
//
//       }else if (document.querySelector('#alignementBtn').value == "b") {
//         courriel.style.display = "block";
//         courriel.style.margin = "auto";
//         btnValider.style.display = "block";
//         btnValider.style.margin = "auto";
//
//       };
//
//       // 4-Couleur
//       titre.style.color = document.querySelector('#couleurTitre').value;
//       texte.style.color = document.querySelector('#couleurTexte').value;
//       titreSaisie.style.color = document.querySelector('#couleurFormu').value;
//       divPopUp.style.backgroundColor = document.querySelector('#couleurFond').value;
//       btnValider.style.color = document.querySelector('#couleurTexteBtn').value;
//       btnValider.style.backgroundColor = document.querySelector('#couleurBtn').value;
//
//       btnFermer.style.float = "right";
//
//   document.querySelector("#croix").addEventListener("click", close)
//   function close(){
//     divPopUp.style.display = "none";
//   }
}



// prévisualisation

// var divPopUp = document.querySelector("#previewDiv").appendChild(document.createElement('div'));
// divPopUp.id = "divPopUp";
//
// divPopUp.style.backgroundColor = document.getElementsByName('couleurFond')[0].value;
// divPopUp.style.width = document.getElementsByName('tailleFenetre')[0].value;
// divPopUp.style.height = '200px';
</script>





<?php

/* - - - - - - - - - - - - - - - enregistrement formulaire en bdd - - - - - - - - - - - - - - - */

if (!empty($_POST['nomCampagne'])) {
  $connect->exec("INSERT INTO popup (nomCampagne, etatCampagne, titrePopup, tailleTitre, epaisseurTitre, couleurTitre, alignement, message, tailleTexte, epaisseurTexte, couleurTexte,
    alignementMessage, titreSaisie, tailleSaisie, epaisseurSaisie, couleurFormu, alignementTitreForm, zoneSaisie, texteBtn, tailleBtn, epaisseurBtn, couleurBtn, couleurTexteBtn, alignementBtn,
    tailleFenetre, couleurFond, tailleBordure, couleurBordure, margeHaut, margeBas, margeGauche, margeDroite, delais)
    VALUES ('".htmlentities($_POST['nomCampagne'])."', 'non-active', '".htmlentities($_POST['titrePopup'])."', '".htmlentities($_POST['tailleTitre'])."', '".htmlentities($_POST['epaisseurTitre'])."',
    '".htmlentities($_POST['couleurTitre'])."', '".htmlentities($_POST['alignement'])."', '".($_POST['message'])."',
    '".htmlentities($_POST['tailleTexte'])."', '".htmlentities($_POST['epaisseurTexte'])."', '".($_POST['couleurTexte'])."', '".($_POST['alignementMessage'])."',
    '".htmlentities($_POST['titreSaisie'])."', '".htmlentities($_POST['tailleSaisie'])."', '".($_POST['epaisseurSaisie'])."', '".($_POST['couleurFormu'])."', '".($_POST['alignementTitreForm'])."', '".($_POST['zoneSaisie'])."',
    '".htmlentities($_POST['texteBtn'])."', '".htmlentities($_POST['tailleBtn'])."', '".htmlentities($_POST['epaisseurBtn'])."', '".htmlentities($_POST['couleurBtn'])."', '".htmlentities($_POST['couleurTexteBtn'])."',
    '".htmlentities($_POST['alignementBtn'])."', '".htmlentities($_POST['tailleFenetre'])."', '".htmlentities($_POST['couleurFond'])."', '".htmlentities($_POST['tailleBordure'])."', '".htmlentities($_POST['couleurBordure'])."',
    '".htmlentities($_POST['margeHaut'])."', '".htmlentities($_POST['margeBas'])."', '".htmlentities($_POST['margeGauche'])."', '".htmlentities($_POST['margeDroite'])."', '".htmlentities($_POST['delais'])."')
    ");
    header('Location:admin-popup.php');

}

 ?>
 <?php include "frame/footer-admin.php"; ?>
