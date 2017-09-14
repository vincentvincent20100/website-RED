<?php include "frame/header-admin.php"; ?>

<!-- formulaire pour coller le texte -->
<form class="" action="#" method="post">
  <label for="saisieTexte">Coller le texte complet : </label><textarea name="saisieTexte" rows="8" cols="80"></textarea>
  <input type="submit" name="" value="Valider">
</form>
<p id="zonesaisie"></p>
<?php
if (!empty($_POST['saisieTexte'])) {
  $_SESSION['texteComplet'] = $_POST['saisieTexte'];
  // echo '<p>Texte initial : '.$_SESSION['texteComplet'].'</p>';
}
 ?>

<!-- Bloc de suggestions -->
 <div class="petitBloc">
   <h3>Suggestions :</h3>
   <p>gros gris</p>
   <button name="button" onclick="showDico()">Dictionnaire des synonymes</button>
 </div>


<!-- formulaire de modification -->
<form name="B" action="#" method="post">
  <input type="hidden" name="texteComplet" value="<?php echo $_SESSION['texteComplet']; ?>"></p>
  <label for="avant">Modifier : </label><input id="remplace" type="text" name="avant">
  <label for="apres">par : </label><input id="remplacant" type="text" name="apres" value="">
  <input type="submit" name="" value="Remplacer">
</form>


<?php
// $_SESSION['texteComplet'] = $_POST['texteComplet'];
echo '<p>Texte initial : <br>'.$_SESSION['texteComplet'].'</p><br>';
if (!empty($_POST['avant']) && !empty($_POST['apres'])) {
  $out = array($_POST['avant']);
  $in   = array($_POST['apres']);
  $_SESSION['texteComplet'] = str_replace($out, $in, $_SESSION['texteComplet']);
  echo '<p>Texte modifié : <br>'.$_SESSION['texteComplet'].'</p>';
}

?>




<script type="text/javascript">

// insert la sélection dans le champs remplacé
document.querySelector('#remplace').addEventListener('mousedown', action2);
function action2(){
      document.querySelector('#remplace').value = window.getSelection();
    }

// insert la sélection dans le champs remplaçant
document.querySelector('#remplacant').addEventListener('mousedown', action1);
function action1(){
      // document.querySelector('#remplacant').value = sel1;
      document.forms["B"].apres.value = window.getSelection(); // alternative au querySelector
    }
// affiche iframe du dictionnaire des synonymes
function showDico(){
  iframe1 = document.body.appendChild(document.createElement('iframe'));
  iframe1.src = "http://www.crisco.unicaen.fr/des/";
  iframe1.width="1000";
  iframe1.height="900";
}
</script>






<?php include "frame/footer-admin.php"; ?>
