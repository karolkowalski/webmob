<?php include 'header.php'; ?>
				<form method="GET" action="search.php">
					<input type="text" id="auteur" name="auteur" placeHolder="Nom de l'auteur" onDblClick="removeThisFieldsLocalStorage(this)"/>
					<input type="text" id="nationalite" name="nationalite" placeHolder="Nationalité de l'auteur" onDblClick="removeThisFieldsLocalStorage(this)"/>
					<input type="text" id="titre" name="titre" placeHolder="Titre de l'ouvrage" onDblClick="removeThisFieldsLocalStorage(this)"/>
					<input type="number" id="prix" name="prix" min="5" max="50" placeHolder="Prix (5->50€)" onDblClick="removeThisFieldsLocalStorage(this)"/>
					<br/>
					<label for="annee">Année: </label><input type="range" id="annee" name="annee" min="1980" max="2013" onchange="anneeChanged(this.value);" onDblClick="removeThisFieldsLocalStorage(this)"/><label id="valeurAnnee"></label>
					<br/>
					<label for="disponibilite">Disponibilité: </label><input type="checkbox" id="disponibilite" name="disponibilite" onDblClick="removeThisFieldsLocalStorage(this)"/>
					<input type="submit" value="Search" onclick="formSubmitted()"/>
				</form>
				
				<button onclick="loadForm()">Load from Local Storage</button>
				<br/>
				<button onclick="library.clear()">Fully clear Local Storage</button>
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
						return true;
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
<?php include 'footer.php'; ?>