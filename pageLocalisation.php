<?php
$title = "Article";
include "frame/header.php";
include "frame/colLeft.php";
 ?>

<p>Votre position : </p><br>

<p>Coordonnées : </p>
<div id="floating-panel">
  Origin: <input type="text" readonly id="origin">
  Destination: <input type="text" readonly id="destination"><br>
  Heading: <input type="text" readonly id="heading"> degrees
</div>
<div id="map"></div>

<script>
var marker, markerParis;
var poly, geodesicPoly;

  (function () {
    navigator.geolocation.getCurrentPosition(coordonnees);
  })();
  function coordonnees(x) {
    document.querySelector('p').innerText += "Latitude : " + x.coords.latitude + " ; Longitude : " + x.coords.longitude;
     latitude = x.coords.latitude;
     longitude = x.coords.longitude;
    }

var horlogeVerif = setInterval(verif, 1000);
  function verif() {
    if (typeof latitude == "undefined") {
      document.querySelectorAll('p')[1].innerText = "Chargement de la carte";
    }else {
      document.querySelectorAll('p')[1].innerText = " ";
      clearInterval(horlogeVerif);
      initMap();
      function initMap() {
        // var uluru = {lat: -25.363, lng: 131.044};
        var uluru = {lat: latitude, lng: longitude};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 5, // de 1 à 20
          center: uluru
        });
        marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
        markerParis = new google.maps.Marker({
          map: map,
          draggable: true,
          position: {lat: 48.857, lng: 2.352}
        });

        var bounds = new google.maps.LatLngBounds(marker.getPosition(), markerParis.getPosition());
        map.fitBounds(bounds);
        google.maps.event.addListener(marker, 'position_changed', update);
        google.maps.event.addListener(markerParis, 'position_changed', update);

        poly = new google.maps.Polyline({
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 3,
          map: map,
        });
        geodesicPoly = new google.maps.Polyline({
          strokeColor: '#CC0099',
          strokeOpacity: 1.0,
          strokeWeight: 3,
          geodesic: true,
          map: map
        });

        update();
        }

        function update() {
        var path = [marker.getPosition(), markerParis.getPosition()];
        poly.setPath(path);
        geodesicPoly.setPath(path);
        var heading = google.maps.geometry.spherical.computeHeading(path[0], path[1]);
        document.getElementById('heading').value = heading;
        document.getElementById('origin').value = path[0].toString();
        document.getElementById('destination').value = path[1].toString();
        }
      }
    }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVfP-DELWhIRA2sS-KS55iaH0bTKF1-uY&libraries=geometry&callback=initMap">
</script>

 <?php
 include "frame/colRight.php";
 include "frame/footer.php";
 ?>
