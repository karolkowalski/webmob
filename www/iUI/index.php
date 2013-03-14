<?php include 'header.php'; ?>
		<ul id="home" title="myBd.fr" selected="true">
			<li><a href="#search">Search</a></li>
			<li><a href="#last">Last</a></li>
			<li><a href="#random">Random</a></li>
			<li><a href="#legal">Legal</a></li>
		</ul>
		
		<div id="search" title="Search" class="panel">
			Search your BD
		</div>
		
		<div id="last" title="Last" class="panel">
			Last information
		</div>
				
		<div id="random" title="Random" class="panel">
			Random information<br/>
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
		</div>
				
		<div id="legal" title="Legal" class="panel">
			Legal Information
		</div>
<?php include 'footer.php'; ?>