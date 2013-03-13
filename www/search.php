<?php include 'header.php'; ?>
				<form method="GET" action="search.php">
					<label for="auteur">Auteur: </label><input type="text" id="auteur" name="auteur"/>
					<label for="nationalite">Nationalité: </label><input type="text" id="nationalite" name="nationalite"/>
					<label for="titre">Titre: </label><input type="text" id="titre" name="titre"/>
					<br/>
					<label for="annee">Année: </label><input type="text" id="annee" name="annee"/>
					<label for="prix">Prix: </label><input type="text" id="prix" name="prix"/>
					<label for="disponibilite">Disponibilité: </label><input type="checkbox" id="disponibilite" name="disponibilite"/>
				</form>
<?php include 'footer.php'; ?>