<?php include 'header.php'; ?>
		<ul id="home" title="myBd.fr" selected="true">
			<li><a href="#search">Search</a></li>
			<li><a href="#last">Last</a></li>
			<li><a href="#random">Random</a></li>
			<li><a href="#legal">Legal</a></li>
		</ul>
		
		<form method="GET" action="/search.php" id="search" title="Search" class="panel" name="search">
            <fieldset>
                <div class="row">
					<input type="text" id="auteur" name="auteur" placeHolder="Nom de l'auteur" onDblClick="removeThisFieldsLocalStorage(this)"/>
				</div>
				<div class="row">
					<input type="text" id="nationalite" name="nationalite" placeHolder="Nationalité de l'auteur" onDblClick="removeThisFieldsLocalStorage(this)"/>
				</div>
				<div class="row">
					<input type="text" id="titre" name="titre" placeHolder="Titre de l'ouvrage" onDblClick="removeThisFieldsLocalStorage(this)"/>
				</div>
				<div class="row">
					<input type="number" id="prix" name="prix" min="5" max="50" placeHolder="Prix (5->50€)" onDblClick="removeThisFieldsLocalStorage(this)"/>
				</div>
				<div class="row">
					<label for="annee">Année: </label><br/>
					<input type="range" id="annee" name="annee" min="1980" max="2013" onchange="anneeChanged(this.value);" onDblClick="removeThisFieldsLocalStorage(this)"/><br/>
					<div id="valeurAnnee"></div>
				</div>
				<div class="row">
					<label for="disponibilite">Disponibilité: </label><input type="checkbox" id="disponibilite" name="disponibilite" onDblClick="removeThisFieldsLocalStorage(this)"/>
				</div>
			</fieldset>
			<a class="whiteButton" onclick="formSubmitted()">Search</a>
			<a class="whiteButton" onclick="loadForm()">Load from Local Storage</a>
			<a class="whiteButton" onclick="library.clear()">Fully clear Local Storage</a>
			<a class="redButton" onclick="reInit()">Cancel</a>
			<script>
				function anneeChanged(newValue) {
					document.getElementById('valeurAnnee').innerHTML = newValue;
				}
				anneeChanged(document.getElementById('annee').value);

				function formSubmitted() {
					if (library.isStorageSupported()) {
						library.set(document.getElementById('auteur').id, document.getElementById('auteur').value); 
						library.set(document.getElementById('nationalite').id, document.getElementById('nationalite').value); 
						library.set(document.getElementById('titre').id, document.getElementById('titre').value); 
						library.set(document.getElementById('prix').id, document.getElementById('prix').value); 
						library.set(document.getElementById('annee').id, document.getElementById('annee').value); 
						library.set(document.getElementById('disponibilite').id, document.getElementById('disponibilite').checked); 
					}
					search.submit();
				}

				function reInit() {
					search.reset();
				}

				function loadForm() {
					// CML: Retrieves local storage data to form
					if (library.isStorageSupported()) {
						document.getElementById('auteur').value = library.getClean(document.getElementById('auteur').id);
						document.getElementById('nationalite').value = library.getClean(document.getElementById('nationalite').id);
						document.getElementById('titre').value = library.getClean(document.getElementById('titre').id);
						document.getElementById('prix').value = library.getClean(document.getElementById('prix').id);
						document.getElementById('annee').value = library.getClean(document.getElementById('annee').id);
						library.fireEvent(document.getElementById('annee'), 'change');
						if (library.getClean(document.getElementById('disponibilite').id) == "true") {
							document.getElementById('disponibilite').checked = true;
						} else {
							document.getElementById('disponibilite').checked = false;
						}
					}
				}

				function removeThisFieldsLocalStorage(element) {
					library.reset(element.id);
				}
			</script>
		</form>
		
		<div id="last" title="Last" class="panel">
			Last information:<br/>
			<video width="320" height="180" controls>
				<source src="http://clips.vorwaerts-gmbh.de/VfE_html5.mp4" type="video/mp4">
				<source src="http://clips.vorwaerts-gmbh.de/VfE.webm" type="video/webm">
				<source src="http://clips.vorwaerts-gmbh.de/VfE.ogv" type="video/ogg">
				Your browser does not support the video tag.
			</video>
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