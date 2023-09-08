
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Modal Header</h4>
</div>
<div class="modal-body">    
  <p>
  	<div id="map" style="width: 100%; height: 400px;"></div>
  </p>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>

<script>
      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsRenderer = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: {lat: 41.85, lng: -87.65}
        });
        directionsRenderer.setMap(map);
        calculateAndDisplayRoute(directionsService, directionsRenderer);
        /*document.getElementById('submit').addEventListener('click', function() {
        });*/
      }
      var res = JSON.parse("<?=$feed_row['waypoints']?>");

      this.origin = {
      	lat: Number(res[0][0]),
      	lng: Number(res[0][1])
      };     

	  this.destination = {
	  	lat: Number(res[res.length-1][0]),
		lng: Number(res[res.length-1][1])
	  };
      function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        var waypts = [];        
        var checkboxArray = JSON.parse("<?=$feed_row['waypoints']?>");
        for (var i = 0; i < checkboxArray.length; i++) {        	        	
        	const waypointObject = new google.maps.LatLng(checkboxArray[i][0],checkboxArray[i][1]);
        	
        	/*console.log(checkboxArray[i][0]);
        	console.log(checkboxArray[i][1]);*/

            waypts.push({
              location: waypointObject,
              stopover: true
            });
        }

        //console.log(waypts);

        directionsService.route({
          origin: this.origin,
          destination: this.destination,
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsRenderer.setDirections(response);
            var route = response.routes[0];
            /*var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';*/
            // For each route, display summary information.
            /*for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
                  '</b><br>';
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
            }*/
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDErpGSCUmRXuGkha8aTesCGpWhhQu_xYM&callback=initMap"
  type="text/javascript"></script>