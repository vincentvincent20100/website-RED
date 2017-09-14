<?php include "frame/header-admin.php";
echo date("d-m-Y")."<br>";?>

<!--  - - - - - - - - - - - - formulaire - - - - - - - - - - - -  -->
<form class="" action="#" method="post">
  <select class="" name="plage">
    <option value="1">24 heures</option>
    <option value="7">1 semaine</option>
    <option value="30">1 mois</option>
    <option value="10000">Début</option>
  </select>
  <button type="submit" name="button">OK</button>
</form>
<?php

/* - - - - - - - - - - - - traitement du formulaire - - - - - - - - - - - - */
if (!empty($_POST['plage'])) {$plage = $_POST['plage'];} else {$plage = 1;}
switch ($plage) {
  case 1:
  echo "<h2>Statistiques sur les dernières 24 heures</h2>";
  break;
  case 7:
  echo "<h2>Statistiques sur la dernière semaine</h2>";
  break;
  case 30:
  echo "<h2>Statistiques sur le dernièr mois</h2>";
  break;
  case 10000:
  echo "<h2>Statistiques depuis le début</h2>";
  break;
}
?>

<table>
  <tr>
    <th>URL de la page</th><th>Nombre de vue</th><th>Moyenne / jour</th>
  </tr>
  <?php
  $ppv= $connect->query("SELECT url_courante, COUNT(url_courante) AS nbVue, COUNT(url_courante)/".$plage." AS moy  FROM log WHERE DATEDIFF( now(), date_log )<".$plage." GROUP BY url_courante ORDER BY COUNT(url_courante) DESC");
  while ($ppvF = $ppv->fetch(PDO::FETCH_OBJ)) {
    echo "<tr><td>".substr($ppvF->url_courante, 30)."</td>
    <td>$ppvF->nbVue</td>
    <td>$ppvF->moy</td></tr>";
  }


  $nbid= $connect->query("SELECT COUNT(DISTINCT ip) AS nbId FROM log WHERE DATEDIFF( now(), date_log )<".$plage."");
  $nbidF = $nbid->fetch(PDO::FETCH_OBJ);
  echo "nombre de visiteurs uniques : ".$nbidF->nbId."<br>";

  $nbP= $connect->query("SELECT COUNT(id_log) AS nbP FROM log WHERE DATEDIFF( now(), date_log )<".$plage."");
  $nbPF = $nbP->fetch(PDO::FETCH_OBJ);
  echo "nombre de pages vues : ".$nbPF->nbP."<br>";
  ?>



<table>
  <tr>
    <th>URL de la page</th><th>Nombre d'acheminement</th><th>Moyenne / jour</th>
  </tr>
  <?php
  echo "source de traffic la plus importante :";
  $sti= $connect->query("SELECT url_precedante, COUNT(url_precedante)AS c, COUNT(url_precedante)/".$plage." AS moy FROM log WHERE DATEDIFF( now(), date_log )<".$plage." GROUP BY url_precedante ORDER BY COUNT(url_precedante) DESC");
  while ($stiF = $sti->fetch(PDO::FETCH_OBJ)) {
    echo "<tr><td>".substr($stiF->url_precedante, 46)."</td>
    <td>$stiF->c</td>
    <td>$stiF->moy</td></tr>";

  }

   ?>
</table>
</table><br>
<?php








 ?>


<br><br><br>
<hr>
<h2 id='infoPHP'>info PHP</h2>
<?php
// echo $_SERVER['SERVER_NAME'];
echo $_SERVER['PHP_SELF']."<p>Le nom du fichier du script en cours d'exécution, par rapport à la racine web</p>";
echo $_SERVER['GATEWAY_INTERFACE']."<p>Numéro de révision de l'interface CGI du serveur</p>";
echo $_SERVER['SERVER_ADDR']."<p>L'adresse IP du serveur sous lequel le script courant est en train d'être exécuté</p>";
echo $_SERVER['SERVER_NAME']."<p>Le nom du serveur hôte qui exécute le script suivant</p>";
echo $_SERVER['SERVER_SOFTWARE']."<p>Chaîne d'identification du serveur, qui est donnée dans les en-têtes lors de la réponse aux requêtes</p>";
echo $_SERVER['SERVER_PROTOCOL']."<p>Nom et révision du protocole de communication</p>";
echo $_SERVER['REQUEST_METHOD']."<p>Méthode de requête utilisée pour accéder à la page</p>";
echo $_SERVER['REQUEST_TIME']."<p>Le temps Unix du début de la requête</p>";
echo $_SERVER['REQUEST_TIME_FLOAT']."<p>Le timestamp du début de la requête, avec une précision à la microseconde</p>";
echo $_SERVER['QUERY_STRING']."<p>La chaîne de requête, si elle existe, qui est utilisée pour accéder à la page</p>";
echo $_SERVER['DOCUMENT_ROOT']."<p>La racine sous laquelle le script courant est exécuté, comme défini dans la configuration du serveur</p>";
echo $_SERVER['']."<p></p>";
echo $_SERVER['']."<p></p>";
echo $_SERVER['']."<p></p>";
echo $_SERVER['']."<p></p>";

?>

<?php include "frame/footer-admin.php"; ?>
