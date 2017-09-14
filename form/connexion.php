
<?php

session_start();
$connect = new PDO ("mysql:host=localhost; dbname=resaendirect-dev-code", "root");

/* déconnexion */
if (!empty($_GET['out'])) {
  $_SESSION['connexion'] = "déconnecté";
  header("Location: ../index.php");
} ;

/* connexion : vérifie existance identifiant, puis de son code associé */
$selection = $connect->query("SELECT * FROM utilisateur WHERE identifiant_user='".$_POST['identifiant']."'");
if (!empty($selection)) {
  while ($se = $selection->fetch(PDO::FETCH_OBJ)) {
    // if ($se->code_user == $_POST['code']) {
    if (password_verify($_POST['code'], $se->code_user)) {
      $_SESSION['connexion'] = "connecté";
      $_SESSION['statu'] = $se->status_user;
      $_SESSION['identifiant'] = $se->identifiant_user;
      header("Location: ../admin.php");
    }else {
      echo "Mot de passe incorrect";
    }
  }
}
  echo "<p>Il y eu une erreur de saisie</p><br>";
  echo "<a href='../index.php'>Accueil</a>";
  echo "<p id='formulaireIdentification'>Re saisir identifiant et mot de passe</p><br>";


 ?>


<script src="connexion.js" charset="utf-8"></script>
<script type="text/javascript">
document.querySelector('#retour').addEventListener('click',backToPrevious);
function backToPrevious(){
  history.back();
}
</script>
