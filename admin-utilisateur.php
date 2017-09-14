<?php include "frame/header-admin.php"; ?>
<?php
/* Restriction accés de cette page aux seuls administrateurs */
if ($_SESSION['statu'] == "contributeur") {
  echo "Accès refusé";
  die();
}

/* Création utilisateur */
if (!empty($_POST['identifiant']) && strlen($_POST['code']) > 7 && strlen($_POST['code']) < 9 && !empty($_POST['status'])) { // si tout est bien renseigné
  $code = htmlentities($_POST['code']);
  echo "--------------------------<br>Vous venez d'ajouter :<br>".$_POST['identifiant']."<br>".$_POST['code']."<br>".$_POST['status']."<br>------------------------<br>";
  $connect->exec("INSERT INTO utilisateur (identifiant_user, code_user, status_user) VALUES ('".htmlentities($_POST['identifiant'])."','".password_hash($code, PASSWORD_DEFAULT)."','".htmlentities($_POST['status'])."')");
}elseif (!empty($_POST['status'])) { // si le status est renseigné (pour éviter affichage message erreur au chargement de la page)
  echo "- - - Echec de l'ajout d'un utilisateur, soyer attentif à bien renseigner tous les champs, le mot de passe doit comporté 8 caractères - - -";
}

/* Modification identifiant */
if (!empty($_POST['identifiantModifie'])) {
  $connect->exec("UPDATE utilisateur SET identifiant_user='".$_POST['identifiantModifie']."' WHERE id_user='".$_POST['idUser']."'");
}
/* Modification mot de passe */
if (!empty($_POST['codeModifie'])) {
  if (strlen($_POST['codeModifie'])> 7 && strlen($_POST['codeModifie']) < 9) {
    $codeModified = htmlentities($_POST['codeModifie']);
    $connect->exec("UPDATE utilisateur SET code_user='".password_hash($codeModified, PASSWORD_DEFAULT)."' WHERE id_user='".$_POST['idUser']."'");
  }else{
    echo "<p class='messageMdp'>! - - - Echec de la modification, le mot de passe doit comporté 8 caractères - - - !</p>";
  }
}
/* Modification status */
if (!empty($_POST['statusModifie'])) {
  $connect->exec("UPDATE utilisateur SET status_user='".$_POST['statusModifie']."' WHERE id_user='".$_POST['idUser']."'");
}
/* Suppression utilisateur */
if (!empty($_GET['idUser'])) {
  $connect->exec("DELETE FROM utilisateur WHERE id_user='".$_GET['idUser']."'");
}
?>
<div id="addUser">

  <h2>Ajouter un utilisateur</h2>

  <form action="#" method="post" id="formulaire">
    <label for="identifiant">Identifiant : </label><input type="text" name="identifiant" value=""><br>
    <label for="code">Mot de passe : </label><input type="text" name="code" class="mdp" onkeyup="indication(this.value);"><br>
    <select id="selectStatu" name="status">
      <option value="administrateur">Administrateur</option>
      <option value="contributeur">Contributeur</option>
    </select>
    <input type="submit" name="" value="Valider">
  </form>
</div>

<div id="listUser">

  <h2>Liste des utilisateurs</h2>

  <table>
    <tr>
      <th>Identifiant</th><th>Mot de passe</th><th>Status</th><th></th>
    </tr>
    <?php
    $selectUser = $connect->query("SELECT * FROM utilisateur");
    while ($su = $selectUser->fetch(PDO::FETCH_OBJ)) {
      echo "<tr id='l$su->id_user'>
      <td id='i$su->id_user'>$su->identifiant_user <span class='btn' onclick='modifyIdentifiant($su->id_user, \"$su->identifiant_user\")'><img src='img/pictogramme/edit-buttons.png' title='Modifier identifiant' class='img_modify  pointer'></span></td>
      <td id='c$su->id_user' class='little'>(crypté) $su->code_user <span class='btn' onclick='modifyCode($su->id_user)'><img src='img/pictogramme/edit-buttons.png' title='Redéfinir un nouveau mot de passe' class='img_modify pointer'></span></td>";
      if ($su->id_user == 1) { // si c'est le super-admin
        echo "<td>$su->status_user </td><td></td>"; // impossible de modifier status ou supprimer le compte
      }else {
        echo "<td id='s$su->id_user'>$su->status_user <span class='btn' onclick='modifyStatus($su->id_user, \"$su->status_user\")'><img src='img/pictogramme/edit-buttons.png' title='Changer status' class='img_modify  pointer'></span></td>
        <td><a href='admin-utilisateur.php?idUser=$su->id_user'><img src='img/pictogramme/Supprimer.png' title='Supprimer' class='img_modify'></td>";
      }
      echo "</tr>";
    }
    ?>
  </table>
</div>








<script type="text/javascript">
// message pour bien renseigner mot de passe
document.querySelector('.mdp').addEventListener('focus', infoMdp);
var compteur = true;
function infoMdp(){
  if (compteur) {
  var p =document.querySelector('#formulaire').appendChild(document.createElement('p'));
  p.innerText = "Le mot de passe devra comporté exactement 8 caractères";
  p.className = "messageMdp";
  compteur = false; // la fonction ne sera executée que le 1ère fois
  }
}
// indication quand le mot de passe atteind 8 caractères------------------------------------------------------------------------------------------------------------------------------------------
function indication(nbCaracteres){
  if (nbCaracteres.length == 8) {
    document.querySelector('#messageMdp').style.color = "green";
    document.getElementsByName('code')[0].style.border = "2px solid green";
  }else {
    document.querySelector('#messageMdp').style.color = "red";
    document.getElementsByName('code')[0].style.border = "2px solid red";
  }
};


// formulaire modifier identifiant
function modifyIdentifiant(id,identifiant){
  var tr = "#l"+id;
  var td = "#i"+id;
  var tdNew = document.createElement('td');
  var formu = tdNew.appendChild(document.createElement('form'));
  formu.method = "post";
  formu.action = "#";
  var inputId = formu.appendChild(document.createElement('input'));
  inputId.type = 'hidden';
  inputId.name = 'idUser';
  inputId.value = id;
  var inputContent = formu.appendChild(document.createElement('input'));
  inputContent.type = 'text';
  inputContent.name = 'identifiantModifie';
  inputContent.value = identifiant;
  var inputBtn = formu.appendChild(document.createElement('button'));
  inputBtn.type = 'submit';
  inputBtn.innerHTML = "<img src='img/pictogramme/check.png' width='18px'>";
  document.querySelector(tr).replaceChild(tdNew, document.querySelector(td));
}
// formulaire modifier code
function modifyCode(id){
  var tr = "#l"+id;
  var td = "#c"+id;
  var tdNew = document.createElement('td');
  var formu = tdNew.appendChild(document.createElement('form'));
  formu.method = "post";
  formu.action = "#";
  var inputId = formu.appendChild(document.createElement('input'));
  inputId.type = 'hidden';
  inputId.name = 'idUser';
  inputId.value = id;
  var inputContent = formu.appendChild(document.createElement('input'));
  inputContent.type = 'text';
  inputContent.name = 'codeModifie';
  var inputBtn = formu.appendChild(document.createElement('button'));
  inputBtn.type = 'submit';
  inputBtn.innerHTML = "<img src='img/pictogramme/check.png' width='18px'>";
  document.querySelector(tr).replaceChild(tdNew, document.querySelector(td));
}
// formulaire modifier status
function modifyStatus(id, status){
  var tr = "#l"+id;
  var td = "#s"+id;
  var tdNew = document.createElement('td');
  var formu = tdNew.appendChild(document.createElement('form'));
  formu.method = "post";
  formu.action = "#";
  var inputId = formu.appendChild(document.createElement('input'));
  inputId.type = 'hidden';
  inputId.name = 'idUser';
  inputId.value = id;
  var select = formu.appendChild(document.createElement('select'));
  select.name = 'statusModifie';
    var option1 = select.appendChild(document.createElement('option'))
    option1.value = 'administrateur';
    option1.innerText = 'administrateur';
    var option2 = select.appendChild(document.createElement('option'))
    option2.value = 'contributeur';
    option2.innerText = 'contributeur';
  var inputBtn = formu.appendChild(document.createElement('button'));
  inputBtn.type = 'submit';
  inputBtn.innerHTML = "<img src='img/pictogramme/check.png' width='18px'>";
  document.querySelector(tr).replaceChild(tdNew, document.querySelector(td));
}
</script>






<?php include "frame/footer-admin.php"; ?>
