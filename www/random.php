<?php include 'header.php'; ?>
				<div id="location"></div>
				<button onclick="updateLocation()">Update Location</button>
				<script>
					geo.init();
					function updateLocation() {
						var innerHtml = "";
						var geoLocation = geo.get();
						if (geoLocation != null) {
							innerHtml += "Voici votre position:<br/>";
							innerHtml += " - Longitude: " + geoLocation.coords.longitude + "<br/>";
							innerHtml += " - Latitude: " + geoLocation.coords.latitude + "<br/>";
							innerHtml += " - Altitude: " + geoLocation.coords.altitude + "<br/>";
						} else {
							var geoError = library.get(geo.LS_ERROR_KEY);
							if (geoError != null) {
								innerHtml += geoError + "<br/>";
							}
						}
						document.getElementById('location').innerHTML=innerHtml;
					}
				</script>
<?php include 'footer.php'; ?>