</main>
<footer>
  <a href="pageMentionsLegales">Mentions légales</a><span> - </span><a href="pageLocalisation.php">L</a><span> - </span><a href="pageBlanche.php">M</a><br>
  <p>Suivez notre actualité</p>
  <a href="https://www.facebook.com/FairBooking"><img src="http://localhost/MesProjets/wordpress-touttest/wp-content/themes/gambit-child/images/facebook.png"></a>
  <a href="https://www.facebook.com/ReservationEnDirect"><img src="http://localhost/MesProjets/wordpress-touttest/wp-content/themes/gambit-child/images/facebook.png"></a>
  <a href="https://twitter.com/fairbooking"><img src="http://localhost/MesProjets/wordpress-touttest/wp-content/themes/gambit-child/images/twitter.png"></a>
  <a href="https://plus.google.com/+FAIRBOOKINGTOURISM?hl=fr"><img src="http://localhost/MesProjets/wordpress-touttest/wp-content/themes/gambit-child/images/googleplus.png"></a>
  <a href="https://www.linkedin.com/company/fairbooking-com"><img src="http://localhost/MesProjets/wordpress-touttest/wp-content/themes/gambit-child/images/linkedin.png"></a>
  <a href="https://www.youtube.com/channel/UCGw5IxLIu4tAjQuubI49WtA"><img src="http://localhost/MesProjets/wordpress-touttest/wp-content/themes/gambit-child/images/youtube.png"></a>
  <a href="https://www.instagram.com/fairbooking/?hl=fr"><img src="http://localhost/MesProjets/wordpress-touttest/wp-content/themes/gambit-child/images/instagram.png"></a>
  <p id="formulaireIdentification2">Connexion administration</p>
  <?php
  // si l'utilisateur est connecté
  if (!empty($_SESSION['connexion']) AND $_SESSION['connexion'] == "connecté") {
    echo "<div class='avatar'>
    <p>".$_SESSION['identifiant']." [".$_SESSION['statu']."]</p>
    <a href='admin.php'> Administration du site</a><span> - </span><a href='form/connexion.php?out=oui'>Déconnexion</a>
    </div>";
  }
   ?>

  <!-- Formulaire de connexion au tableau de bord -->
  <form id="formConnexion" action="form/connexion.php" method="post">
    <button type="button" class="croix" title = 'Fermer'>x</button>
      <legend>Administration</legend>
      <input type="text" name="identifiant" placeholder="Identifiant"><br>
      <input type="password" name="code" placeholder="Mot de passe" id="password">
      <button type="button" class="unmaski" title = 'démasquer votre saisie'><img src="img/pictogramme/show_password.png" width="30px"></button><br>
      <button type="submit" class="valider">Valider</button>
  </form>

</footer>
</body>
</html>





<script src="form/connexion.js" charset="utf-8"></script>
<script type="text/javascript">

// Affiche la fenetre de connexion
document.querySelector('#formulaireIdentification2').addEventListener('click', function(){
  document.querySelector('#formConnexion').style.display = 'block';
});
// Ferme la fenetre de connexion
document.querySelector('.croix').addEventListener('click', function(){
  document.querySelector('#formConnexion').style.display = 'none';
});


/* démasque champs password */
document.querySelector('.unmaski').addEventListener('mousedown', function(){
    this.previousElementSibling.type = 'text';
    this.previousElementSibling.id = 'password';
    document.querySelector('.unmaski img').src = "img/pictogramme/hide_password.png";
  });
  document.querySelector('.unmaski').addEventListener('mouseup', function(){
    this.previousElementSibling.type = 'password';
    document.querySelector('.unmaski img').src = "img/pictogramme/show_password.png";
  });


/* Bouton recherche : déployer le champs de saisie */
document.querySelector('#zoneSearch').addEventListener("mouseover",saisie);
function saisie(){
  document.querySelector('#inputSearch').style.display = "inline-block";
  document.querySelector('#inputSearch').placeholder = "Votre recherche";
  document.querySelector('#btnSearch').style.display = "none";
  document.querySelector('#submitSearch').style.display = "inline-block";
  document.querySelector('#menu').style.margin = "1px 0px 4px 0px";

document.querySelector('#zoneSearch').addEventListener("mouseout",sortie);
}
function sortie(){
  document.querySelector('#inputSearch').style.display = "none";
  document.querySelector('#btnSearch').style.display = "inline-block";
  document.querySelector('#submitSearch').style.display = "none";
  document.querySelector('#menu').style.margin = "1px auto 4px auto";
}
/* Bouton recherche 2 : déployer le champs de saisie */
document.querySelector('#zoneSearch2').addEventListener("mouseover",saisie2);
function saisie2(){
  document.querySelector('#inputSearch2').style.display = "inline-block";
  document.querySelector('#inputSearch2').placeholder = "Votre recherche";
  document.querySelector('#btnSearch2').style.display = "none";
  document.querySelector('#submitSearch2').style.display = "inline-block";

document.querySelector('#zoneSearch2').addEventListener("mouseout",sortie2);
}
function sortie2(){
  document.querySelector('#inputSearch2').style.display = "none";
  document.querySelector('#btnSearch2').style.display = "inline-block";
  document.querySelector('#submitSearch2').style.display = "none";
}

/* Menu : colorié en bleu les picto au survol */
function changeImg(id, img){
  document.querySelector(id).src = img;
}
function resetImg(id, imgInit){
  document.querySelector(id).src = imgInit;
}
</script>
