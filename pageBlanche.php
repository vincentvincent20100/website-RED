<?php
$title = "Article";
include "frame/header.php";
include "frame/colLeft.php";
?>
<p>FairBooking here</p>

 https://www.fairbooking.com/fr/search/country/FR.html?q=France&from=&from_submit=&to=&to_submit=
 <iframe id="FB-76a53511-55b8-478a-b9b0-8a066d225141" scrolling="no" src="https://www.fairbooking.com/whitelabel/76a53511-55b8-478a-b9b0-8a066d225141" style="border:0;" frameborder="0" width="100%"></iframe>

<script>
  FBWLRszMessageResponseHandler = function(e) {
  var action = e.data.split(':')[0]
  if(action == 'height') {
    var size = e.data.split(':')[1];
    var iframe = document.getElementById('FB-76a53511-55b8-478a-b9b0-8a066d225141');
    iframe.height = size;
    iframe.frameBorder = "0";
    iframe.scrolling = "no";
  } else {
    console.log("Unknown message: "+e.data);
  }
  }

  window.addEventListener('message', FBWLRszMessageResponseHandler, false);

  setInterval(function(){
    var iframe = document.getElementById('FB-76a53511-55b8-478a-b9b0-8a066d225141');
    iframe.contentWindow.postMessage('getHeight?', '*');
  },2000)
</script>

 <?php
 include "frame/colRight.php";
 include "frame/footer.php";
 ?>
