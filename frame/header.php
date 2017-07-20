<?php
  session_start(); //on declare la session pour toutes les pages
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!--pour le responsive-->
    <link rel="stylesheet" href="css/master.css">
    <title><?php echo $title ?></title>
  </head>
  <body>
    <div id="fb-root"></div>

<!-- script fil d'actualité Facebook -->
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.10";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    <header>
      <img id="img-entete" src="img/entete.png" alt="">
      <nav>
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li><a href="pageActu.php">Actualités</a></li>
          <li><a href="#">Adhésion FairBooking</a></li>
          <li><a href="#">RED Académie</a></li>
          <li><a href="#">Notre réseau de partenaires</a></li>
          <li><a href="#">Boutique</a></li>
        </ul>
      </nav>
    </header>
    <main>
