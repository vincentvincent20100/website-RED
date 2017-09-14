

<?php
$connect=new PDO("mysql:host=localhost; dbname=resaendirect-dev-code","root");
$connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING); // afficher les erreurs
/**
* Activation - désactivation - modification - suppression popup facebook
*/
if (!empty($_GET['f'])) {
  if ($_GET['f'] == 'non-active') {
    $connect->exec("UPDATE popup_activite SET etat_popup = 'non-active' WHERE popup = 0");
  }elseif ($_GET['f'] == 'active') {
    $connect->exec("UPDATE popup_activite SET etat_popup = 'active' WHERE popup = 0");
  }
  header("Location:admin-popup.php");
}

/**
* Activation - désactivation - modification - suppression popup (post depuis admin-popup)
*/
if (!empty($_GET['p'])) {
  if ($_GET['p'] == 'non-active') { //désactivation
    $connect->exec("UPDATE popup SET etatCampagne = 'non-active' WHERE id_popup = '".$_GET['id']."'");
    $connect->exec("UPDATE popup_activite SET etat_popup = 'non-active', date_fin = DEFAULT WHERE id_popup_activite = '".$_GET['id2']."'");
  }elseif ($_GET['p'] == 'active') { // Activation
    $connect->exec("UPDATE popup SET etatCampagne = 'non-active'"); // désactivation de toutes les popup
    $connect->exec("UPDATE popup SET etatCampagne = 'active' WHERE id_popup = '".$_GET['id']."'"); // activation de la popup sélectionnée
    $connect->exec("UPDATE popup_activite SET etat_popup = 'non-active', date_fin = DEFAULT");
    $connect->exec("INSERT INTO popup_activite (date_debut, date_fin, etat_popup, popup) VALUES (DEFAULT, NULL, 'active', '".$_GET['id']."')");
  }elseif ($_GET['p'] == 'supprime') {
    $connect->exec("DELETE FROM popup WHERE id_popup = '".$_GET['id']."'");
  }
  header("Location:admin-popup.php");
}

/**
* Filtre pour que la popup
*   ne s'affiche qu'une fois par session
*   sauf pour les admin
*/
if ($_SESSION['showPopup'] !== 'yes' OR $_SESSION['connexion'] == "connecté") {
  $_SESSION['showPopup'] = 'yes';



/**
* extraction de la bdd des paramètre de la popup facebook configurée dans admin_popup.php
*/
$selectionEtat = $connect->query("SELECT etat_popup FROM popup_activite WHERE popup =0");
$se = $selectionEtat->fetch(PDO::FETCH_OBJ);
echo "<input type='hidden' id='etat_popup' value='".$se->etat_popup."'>";
/**
* extraction de la bdd des paramètre de la popup configurée dans admin_popup.php
*/
$selection = $connect->query("SELECT * FROM popup WHERE etatCampagne = 'active'");
echo "-----------r----------";
while ($selP = $selection->fetch(PDO::FETCH_OBJ)) {
  echo "<input type='hidden' id='idPopup' value='".$selP->id_popup."'>";
  echo "<input type='hidden' id='titrePopup' value='".$selP->titrePopup."'>";
  echo "<input type='hidden' id='tailleTitre' value='".$selP->tailleTitre."'>";
  echo "<input type='hidden' id='epaisseurTitre' value='".$selP->epaisseurTitre."'>";
  echo "<input type='hidden' id='couleurTitre' value='".$selP->couleurTitre."'>";
  echo "<input type='hidden' id='alignement' value='".$selP->alignement."'>";
  echo "<input type='hidden' id='message' value='".$selP->message."'>";
  echo "<input type='hidden' id='tailleTexte' value='".$selP->tailleTexte."'>";
  echo "<input type='hidden' id='epaisseurTexte' value='".$selP->epaisseurTexte."'>";
  echo "<input type='hidden' id='couleurTexte' value='".$selP->couleurTexte."'>";
  echo "<input type='hidden' id='alignementMessage' value='".$selP->alignementMessage."'>";
  echo "<input type='hidden' id='titreSaisie' value='".$selP->titreSaisie."'>";
  echo "<input type='hidden' id='tailleSaisie' value='".$selP->tailleSaisie."'>";
  echo "<input type='hidden' id='epaisseurSaisie' value='".$selP->epaisseurSaisie."'>";
  echo "<input type='hidden' id='couleurFormu' value='".$selP->couleurFormu."'>";
  echo "<input type='hidden' id='alignementTitreForm' value='".$selP->alignementTitreForm."'>";
  echo "<input type='hidden' id='zoneSaisie' value='".$selP->zoneSaisie."'>";
  echo "<input type='hidden' id='texteBtn' value='".$selP->texteBtn."'>";
  echo "<input type='hidden' id='tailleBtn' value='".$selP->tailleBtn."'>";
  echo "<input type='hidden' id='epaisseurBtn' value='".$selP->epaisseurBtn."'>";
  echo "<input type='hidden' id='couleurBtn' value='".$selP->couleurBtn."'>";
  echo "<input type='hidden' id='couleurTexteBtn' value='".$selP->couleurTexteBtn."'>";
  echo "<input type='hidden' id='alignementBtn' value='".$selP->alignementBtn."'>";
  echo "<input type='hidden' id='tailleFenetre' value='".$selP->tailleFenetre."'>";
  echo "<input type='hidden' id='couleurFond' value='".$selP->couleurFond."'>";
  echo "<input type='hidden' id='tailleBordure' value='".$selP->tailleBordure."'>";
  echo "<input type='hidden' id='couleurBordure' value='".$selP->couleurBordure."'>";
  echo "<input type='hidden' id='margeHaut' value='".$selP->margeHaut."'>";
  echo "<input type='hidden' id='margeBas' value='".$selP->margeBas."'>";
  echo "<input type='hidden' id='margeGauche' value='".$selP->margeGauche."'>";
  echo "<input type='hidden' id='margeDroite' value='".$selP->margeDroite."'>";
  echo "<input type='hidden' id='delais' value='".$selP->delais."'>";
}
}
 ?>



<script type="text/javascript">

/* génération de pop-up facebook */

setTimeout(constructPopUp2,2000);
function constructPopUp2 (){
  if (document.querySelector('#etat_popup').value == 'active') {
    var divPopUp2 = document.querySelector("#divPopUps").appendChild(document.createElement('div'));
    divPopUp2.id = "divPopUp2";
    divPopUp2.class = "divPopUp";
    var texte3 = document.querySelector("#divPopUp2").appendChild(document.createElement('p'));
    texte3.innerText = "Suivez FairBooking sur facebook";
    var btnFb = document.querySelector("#divPopUp2").appendChild(document.querySelector('#widgetFbPopup'));
    document.querySelector('#widgetFbPopup').style.display = 'block';
  }
}

/* génération de pop-up newsletter */

// conteneur pour toutes les pop-up
var divPopUps = document.body.appendChild(document.createElement('div'));
divPopUps.id = "divPopUps";

setTimeout(constructPopUp,document.querySelector('#delais').value*1000);
function constructPopUp (){
  var divPopUp = document.querySelector("#divPopUps").appendChild(document.createElement('div'));
  divPopUp.id = "divPopUp";
    // 1-Accroche
    var btnFermer = document.querySelector("#divPopUp").appendChild(document.createElement('button'));
    btnFermer.id = "croix";
    btnFermer.title = "Fermer";
    btnFermer.innerText = "x";
    var titre = document.querySelector("#divPopUp").appendChild(document.createElement('p'));
    titre.innerText = document.querySelector('#titrePopup').value;
    var texte = document.querySelector("#divPopUp").appendChild(document.createElement('p'));
    texte.innerText = document.querySelector('#message').value;
    // 2-Formulaire
    var formu = document.querySelector("#divPopUp").appendChild(document.createElement('form'));
    formu.method = "post";
    formu.action = "#";
      var nomCampagne = formu.appendChild(document.createElement('input'));
      nomCampagne.type = "hidden";
      nomCampagne.name = "idPopup";
      nomCampagne.value = document.querySelector('#idPopup').value;
      var titreSaisie = formu.appendChild(document.createElement('p'));
      titreSaisie.innerText = document.querySelector('#titreSaisie').value;
      var courriel = formu.appendChild(document.createElement('input'));
      courriel.type = "email";
      courriel.name = "emailNewsletter";
      courriel.placeholder = document.querySelector('#zoneSaisie').value;
      // courriel.value = "machin@truc.com"; pour les tests
      var btnValider = formu.appendChild(document.createElement('input'));
      btnValider.type = "submit";
      btnValider.value = document.querySelector('#texteBtn').value;

    //3-Style du bloc
    divPopUp.style.width = document.querySelector('#tailleFenetre').value;
    divPopUp.style.borderWidth = document.querySelector('#tailleBordure').value;
    divPopUp.style.borderStyle = "solid";
    divPopUp.style.borderColor = document.querySelector('#couleurBordure').value;
    divPopUp.style.paddingTop = document.querySelector('#margeHaut').value;
    divPopUp.style.paddingBottom = document.querySelector('#margeBas').value;
    divPopUp.style.paddingLeft = document.querySelector('#margeGauche').value;
    divPopUp.style.paddingRight = document.querySelector('#margeDroite').value;
    // 3-Police
    titre.style.fontSize = document.querySelector('#tailleTitre').value;
    titre.style.fontWeight = document.querySelector('#epaisseurTitre').value;
    texte.style.fontSize = document.querySelector('#tailleTexte').value;
    texte.style.fontWeight = document.querySelector('#epaisseurTexte').value;
    titreSaisie.style.fontSize = document.querySelector('#tailleSaisie').value;
    titreSaisie.style.fontWeight = document.querySelector('#epaisseurSaisie').value;
    btnValider.style.fontSize = document.querySelector('#tailleBtn').value;
    btnValider.style.fontWeight = document.querySelector('#epaisseurBtn').value;

    // 3-Position des éléments
    titre.style.textAlign = document.querySelector('#alignement').value;
    texte.style.textAlign = document.querySelector('#alignementMessage').value;
    titreSaisie.style.textAlign = document.querySelector('#alignementTitreForm').value;
    if (document.querySelector('#alignementBtn').value == "a") {

    }else if (document.querySelector('#alignementBtn').value == "b") {
      courriel.style.display = "block";
      courriel.style.margin = "auto";
      btnValider.style.display = "block";
      btnValider.style.margin = "auto";

    };

    // 4-Couleur
    titre.style.color = document.querySelector('#couleurTitre').value;
    texte.style.color = document.querySelector('#couleurTexte').value;
    titreSaisie.style.color = document.querySelector('#couleurFormu').value;
    divPopUp.style.backgroundColor = document.querySelector('#couleurFond').value;
    btnValider.style.color = document.querySelector('#couleurTexteBtn').value;
    btnValider.style.backgroundColor = document.querySelector('#couleurBtn').value;

    btnFermer.style.float = "right";

document.querySelector("#croix").addEventListener("click", close)
function close(){
  divPopUp.style.display = "none";
}
}


  // conteneur pour toutes les pop-up
  // var divPopUps = document.body.appendChild(document.createElement('div'));
  // divPopUps.id = "divPopUps";


  // pop-up newsletter
  // setTimeout(constructPopUp,1000);
  // function constructPopUp (){
  //   var divPopUp = document.querySelector("#divPopUps").appendChild(document.createElement('div'));
  //   divPopUp.id = "divPopUp";
  //   divPopUp.class = "divPopUp";
  //     var texte = document.querySelector("#divPopUp").appendChild(document.createElement('p'));
  //     texte.innerText = "Ne ratez rien de FairBooking";
  //     var texte2 = document.querySelector("#divPopUp").appendChild(document.createElement('p'));
  //     texte2.innerText = "Inscrivez-vous à la newsletter";
  //     var formu = document.querySelector("#divPopUp").appendChild(document.createElement('form'));
  //     formu.method = "post";
  //       var courriel = formu.appendChild(document.createElement('input'));
  //       courriel.type = "email";
  //       courriel.name = "emailNewsletter";
  //       courriel.placeholder = "voter email";
  //       var btnValider = formu.appendChild(document.createElement('input'));
  //       btnValider.type = "submit";
  // }

  </script>

  <!-- bouton j'aime de facebook -->
  <p id="evenSee">popup zone</p>
  <div id='widgetFbPopup' class="widget">
    <div class="fb-like" data-href="https://www.facebook.com/FairBooking" data-layout="box_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
  </div>



  <?php
  /**
  * Enregistrement des adresse email en BDD
  */
  if (!empty($_POST['emailNewsletter'])) {
    $connect->exec("INSERT INTO client (email, date_ajout, popup) VALUES ('".htmlentities($_POST['emailNewsletter'])."', DEFAULT, '".$_POST['idPopup']."')");
    echo $_POST['emailNewsletter']."<br>";
    echo $_POST['idPopup']."<br>";
    echo "date :".date("Y-m-d H:i:s");
  }


  /**
   * Si l'IP est nouvelle : afficher pop-up
   * Si l'IP est connue : ne pas afficher pop-up
   */
 // $selectIP = $connect->query("SELECT * FROM connexion");
 // $ipConnue = false;
 // while ($sip = $selectIP->fetch(PDO::FETCH_OBJ)) {
 //   if ($sip->ip == $_SESSION['ip']) {
 //     $ipConnue = true;
 //   }
 //   if ($ipConnue == false) {
 //     # on appel les fonction en JS
 //   }
 // }


 ?>
