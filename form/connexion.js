/* affiche le formulaire de connexion à l'admin */
document.querySelector('#formulaireIdentification').addEventListener('click', openPopUp);
function openPopUp() {
  //selon la page sur laquelle est appelé ce script, il faudra indiquer le répertoire form
  if (document.location.href == "http://localhost/MesProjets/code-resaendirect/form/connexion.php") {
     destination = "connexion.php";
  }else {
     destination = "form/connexion.php";
  }
  // construction formulaire connexion
  var formu = document.body.appendChild(document.createElement('form'));
  formu.method = "post";
  formu.action = destination;
  formu.id = "formConnexion";
  var identifiant = formu.appendChild(document.createElement('input'));
  identifiant.type = 'text';
  identifiant.placeholder = 'Identifiant';
  identifiant.name = 'identifiant';
  var code = formu.appendChild(document.createElement('input'));
  code.type = 'password';
  code.placeholder = 'Mot de passe';
  code.name = 'code';
  code.id = 'password';
  var btnMask = formu.appendChild(document.createElement('button'));
  btnMask.type = 'button';
  btnMask.className = 'unmaski';
  btnMask.title = 'démasquer votre saisie';
  btnMask.innerHTML = '<img src="img/pictogramme/show_password.png" width="20px">';
  var btnValider = formu.appendChild(document.createElement('button'));
  btnValider.type = 'submit';
  btnValider.innerText = 'Valider';
  /* modifie le champs password au clic sur le bouton démasquer */
  document.querySelector('.unmaski').addEventListener('click', function(){
    if(this.previousElementSibling.type == 'password'){
      this.previousElementSibling.type = 'text';
      this.previousElementSibling.id = 'password';
      document.querySelector('.unmaski').innerHTML = '<img src="img/pictogramme/hide_password.png" width="20px">';
    }else {
      this.previousElementSibling.type = 'password';
      document.querySelector('.unmaski').innerHTML = '<img src="img/pictogramme/show_password.png" width="20px">';
    }
  });
}
