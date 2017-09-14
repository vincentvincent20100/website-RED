<?php
  session_start(); //on declare la session pour toutes les pages

  // création connexion bdd pour toutes les pages de l'admin
  $serveur="mysql:host=localhost; dbname=resaendirect-dev-code";
  $user="root";
  $pass="";
  $connect=new PDO($serveur,$user,$pass); //PDO php data object

  /* statistiques */
  /* Fonction renvoyant l'adresse de la page actuelle */
  function getURI(){
    $adresse = $_SERVER['PHP_SELF'];
    $i = 0;
    foreach($_GET as $cle => $valeur){
      $adresse .= ($i == 0 ? '?' : '&').$cle.($valeur ? '='.$valeur : '');
      $i++;
    }
    return $adresse;
  }
  // enregistrement en base
  if (!empty($_SERVER['HTTP_REFERER'])) {
    $connect->exec("INSERT INTO log (ip, url_courante, url_precedante) VALUES ('".$_SERVER['REMOTE_ADDR']."', '".getURI()."', '".$_SERVER['HTTP_REFERER']."')");
  }else {
    $connect->exec("INSERT INTO log (ip, url_courante, url_precedante) VALUES ('".$_SERVER['REMOTE_ADDR']."', '".getURI()."', 'Direct')");
  }
?>
<?php
/**
 * Récupérer la véritable adresse IP d'un visiteur
 */
function getIp() {
  // getenv() retourne la valeur d'une variable d'environnement
 $ip = ($ip = getenv('HTTP_FORWARDED_FOR')) ? $ip :
 ($ip = getenv('HTTP_X_FORWARDED_FOR'))     ? $ip :
 ($ip = getenv('HTTP_X_COMING_FROM'))       ? $ip :
 ($ip = getenv('HTTP_VIA'))                 ? $ip :
 ($ip = getenv('HTTP_XROXY_CONNECTION'))    ? $ip :
 ($ip = getenv('HTTP_CLIENT_IP'))           ? $ip :
 ($ip = getenv('REMOTE_ADDR'))              ? $ip :
 '0.0.0.0';
 return $ip;
}
$_SESSION['ip'] = getIp();
// echo "ip du visiteur :".$_SESSION['ip'];
// $connect->exec("INSERT INTO connexion (ip) VALUES ('".$ip."')");



 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!--pour le responsive-->
    <link rel="stylesheet" href="css/master.css">
    <title><?php echo $title ?></title>
  </head>
  <body onunload="javascript:alert('good bye !');">
    <div id="fb-root"></div>

<!-- script fil d'actualité Facebook -->
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.10";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- script bouton j'aime Facebook -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.10";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- script bouton partager sur Facebook -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.10";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- script bouton partager sur Twitter -->
<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);
  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };
  return t;
}(document, "script", "twitter-wjs"));</script>





    <header>

      <div id="en_tete">
        <!-- <img id="img-entete" src="img/entete.png" alt=""> -->
        <!-- <img id="img-entete" src="img/img.jpg" alt=""> -->
        <img id="img-entete" src="img/bandeau-plage3.png" alt="">
        <div id="zoneSearch2">
          <form class="formu" action="recherche.php" method="post">
            <input type="search" id="inputSearch2" name="rechercheSaisie" value="">
            <img id="btnSearch2" src="http://localhost/MesProjets/code-resaendirect/img/pictogramme/search-icon-png-100px.png" alt="" >
            <button type="submit" id="submitSearch2"><img id="btnSearch2" src="http://localhost/MesProjets/code-resaendirect/img/pictogramme/search-icon-png-100px.png" alt="" ></button>
          </form>
        </div>
      </div>
      <div id="zoneSearch">
        <form class="formu" action="recherche.php" method="post">
          <input type="search" id="inputSearch" name="rechercheSaisie" value="">
          <img id="btnSearch" src="http://localhost/MesProjets/code-resaendirect/img/pictogramme/search-icon-png-100px.png" alt="" >
          <button type="submit" id="submitSearch"><img id="btnSearch" src="http://localhost/MesProjets/code-resaendirect/img/pictogramme/search-icon-png-100px.png" alt="" ></button>
        </form>
      </div>
      <nav id="menu">
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li><a href="pageActu.php">Actualités</a>
            <ul>
              <?php
              $PDO = new PDO("mysql:host=localhost; dbname=resaendirect-dev-code","root");
              $selection = $PDO->query("SELECT * FROM categorie_article");
              while ($s = $selection->fetch(PDO::FETCH_OBJ)) {
                echo "<li><a href='pageCategorie.php?libCat=$s->libelle_categorie'>$s->libelle_categorie</a></li>";
              }
               ?>
            </ul>
          </li>
          <li class="picto" onmouseover="changeImg('#pictoV', 'img/pictogramme/voy(bleu).png')" onmouseout="changeImg('#pictoV', 'img/pictogramme/voy.png')">
            <a href="pageVoyageur.php" ><img src="img/pictogramme/voy.png" id="pictoV">Voyageurs</a></li>

          <li class="picto" onmouseover="changeImg('#pictoH', 'img/pictogramme/hot(transp-bleu).png')" onmouseout="changeImg('#pictoH', 'img/pictogramme/hot(transp).png')">
            <a href="pageHebergeurs.php" ><img src="img/pictogramme/hot(transp).png" id="pictoH">Hébergeurs</a>
            <ul>
              <li><a href="pageFormation.php">Formations pour hoteliers</a></li>
              <li><a href="pagePartenaires.php">Notre réseau de partenaires</a></li>
              <li><a href="pageBoutique.php">Boutique</a></li>
            </ul>
          </li>
          <li><a href="pageCooperative.php">Future coopérative</a></li>
          <!-- <li> -->

          <!-- </li> -->
        </ul>
      </nav>

    </header>
    <main>
