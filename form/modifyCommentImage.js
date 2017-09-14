
function modifyComment1(id, contenu) { // depuis admin-annonce
  var div = "#ii"+id; // un querySelector ne doit pas commencer par un chiffre
  var p = "#i"+id;

  // var formu = document.body.appendChild(document.createElement('form'));
  var pNew = document.createElement('p');
  var formu = pNew.appendChild(document.createElement('form'));
  formu.method = "post";
  formu.action = "form/modifyViaJS.php";
  var inputId = formu.appendChild(document.createElement('input'));
  inputId.type = 'hidden';
  inputId.name = 'idImage';
  inputId.value = id;
  var inputContent = formu.appendChild(document.createElement('input'));
  inputContent.type = 'text';
  inputContent.name = 'content';
  inputContent.value = contenu;
  var inputBtn = formu.appendChild(document.createElement('button'));
  inputBtn.type = 'submit';
  inputBtn.innerHTML = "<img src='img/pictogramme/check.png' class='imgCheck'>";
  inputBtn.style.verticalAlign = "bottom";
  document.querySelector(div).replaceChild(pNew, document.querySelector(p));
}
  function modifyComment2(id, contenu) { // depuis admin-image
    var div = "#ii"+id; // un querySelector ne doit pas commencer par un chiffre
    var p = "#i"+id;

    // var formu = document.body.appendChild(document.createElement('form'));
    var pNew = document.createElement('p');
    var formu = pNew.appendChild(document.createElement('form'));
    formu.method = "post";
    formu.action = "form/modifyViaJS.php";
    var inputId = formu.appendChild(document.createElement('input'));
    inputId.type = 'hidden';
    inputId.name = 'idImg';
    inputId.value = id;
    var inputContent = formu.appendChild(document.createElement('input'));
    inputContent.type = 'text';
    inputContent.name = 'content';
    inputContent.value = contenu;
    var inputBtn = formu.appendChild(document.createElement('input'));
    inputBtn.type = 'submit';
    inputBtn.innerHTML = "<img src='img/pictogramme/check.png'>";
    document.querySelector(div).replaceChild(pNew, document.querySelector(p));
  }
