<?php include 'header.php'; ?>
    <div id="home" data-role="page">
		<div data-role="header"><h1>myBd.fr</h1></div>
		<div data-role="content">
			<ul>
				<li><a href="#searchPage">Search</a></li>
				<li><a href="#last">Last</a></li>
				<li><a href="#random">Random</a></li>
				<li><a href="#legal">Legal</a></li>
			</ul>
		</div>
		<div data-role="footer" data-position="fixed"><h6>Footer</h6></div>
    </div>
			
    <div id="searchPage" data-role="page" data-add-back-btn="true">
		<div data-role="header"><h1>Search</h1></div>
		<div data-role="content">
		    <form method="GET" action="#home" id="search" title="Search" class="panel" name="search">
	            <fieldset>
	                <div class="row">
						<input type="search" id="auteur" name="auteur" placeHolder="Nom de l'auteur" onDblClick="removeThisFieldsLocalStorage(this)"/>
					</div>
					<div class="row">
						<input type="search" id="nationalite" name="nationalite" placeHolder="Nationalité de l'auteur" onDblClick="removeThisFieldsLocalStorage(this)"/>
					</div>
					<div class="row">
						<input type="search" id="titre" name="titre" placeHolder="Titre de l'ouvrage" onDblClick="removeThisFieldsLocalStorage(this)"/>
					</div>
					<div class="row">
						<input type="number" id="prix" name="prix" min="5" max="50" placeHolder="Prix (5->50€)" onDblClick="removeThisFieldsLocalStorage(this)"/>
					</div>
					<div class="row">
						<label for="annee">Année: </label>
						<input type="range" id="annee" name="annee" min="1980" max="2013" onchange="anneeChanged(this.value);" onDblClick="removeThisFieldsLocalStorage(this)"/><br/>
					</div>
					<div class="row">
						<label for="disponibilite">Disponibilité: </label><input type="checkbox" id="disponibilite" name="disponibilite" onDblClick="removeThisFieldsLocalStorage(this)"/>
					</div>
				</fieldset>
				<div class="ui-grid-a">
					<div class="ui-block-a">
						<a href="#" data-theme="b" data-role="button" onclick="loadForm()" data-icon="edit">Load LS</a>
					</div>
					<div class="ui-block-b">
						<a href="#" data-theme="e" data-role="button" onclick="library.clear()" data-icon="delete">Clear LS</a>
					</div>
				</div>
				<script>
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
		</div>
		<div class="ui-bar" data-role="footer" data-position="fixed">
			<div data-role="navbar">
				<ul>
					<li><a href="#" data-theme="b" onclick="formSubmitted()" data-mini="true" data-inline="true" data-icon="search">Search</a></li>
					<li><a href="#" onclick="reInit()" data-mini="true" data-inline="true" data-icon="alert">Cancel</a></li>
				</ul>
			</div>
		</div>
	</div>
				
    <div id="last" data-role="page" data-add-back-btn="true">
		<div data-role="header"><h1>Last Information</h1></div>
		<div data-role="content">
			Last information:<br/>
			<video width="320" height="180" controls>
				<source src="http://clips.vorwaerts-gmbh.de/VfE_html5.mp4" type="video/mp4">
				<source src="http://clips.vorwaerts-gmbh.de/VfE.webm" type="video/webm">
				<source src="http://clips.vorwaerts-gmbh.de/VfE.ogv" type="video/ogg">
				Your browser does not support the video tag.
			</video>
		</div>
		<div data-role="footer" data-position="fixed"><h6>Footer</h6></div>
	</div>
		
    <div id="random" data-role="page" data-add-back-btn="true">
		<div data-role="header"><h1>Random Information</h1></div>
		<div data-role="content">
    		Random information<br/>
			<div id="location"></div>
			<div id="geoMap" class="map rounded mapJqm"></div>
			<button onclick="updateLocation()">Update Location</button>
			<script>
				$.ready(function() {
					geo.init();
				});

				function updateLocation() {
					geo.update(function() {
						var innerHtml = "";
						var geoLocation = geo.get();
						if (geoLocation != null) {
							innerHtml += "Voici votre position:<br/>";
							innerHtml += " - Longitude: " + geoLocation.coords.longitude + "<br/>";
							innerHtml += " - Latitude: " + geoLocation.coords.latitude + "<br/>";
							innerHtml += " - Altitude: " + geoLocation.coords.altitude + "<br/>";
							innerHtml += " - Timestamp: " + geoLocation.timestamp + "<br/>";
							var myLocation = geoLocation.coords.latitude + ',' + geoLocation.coords.longitude;
							$('#geoMap').gmap({'center': myLocation}).bind('init', function(ev, map) {
								$('#geoMap').gmap('addMarker', {'position': myLocation}).click(function() {
									$('#geoMap').gmap('openInfoWindow', {'content': 'Here you are Karol ! Approximately of course ;-)'}, this);
								});
							});
							$('#geoMap').gmap('option', 'zoom', 13);
								
						} else {
							var geoError = library.get(geo.LS_ERROR_KEY);
							if (geoError != null) {
								innerHtml += geoError + "<br/>";
							}
						}
						document.getElementById('location').innerHTML=innerHtml;
					});
				}
			</script>
		</div>
		<div data-role="footer" data-position="fixed"><h6>Footer</h6></div>
	</div>
							
    <div id="legal" data-role="page" data-add-back-btn="true">
		<div data-role="header"><h1>Legal Information</h1></div>
		<div data-role="content">
    			Legal Information
		</div>
    	<div data-role="footer" data-position="fixed"><h6>Footer</h6></div>
    </div>
		
<?php include 'footer.php'; ?>