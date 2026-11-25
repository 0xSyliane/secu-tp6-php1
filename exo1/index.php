<?php
	// Le code PHP commence par la balise <?php (slide 58)

	// Tableau associatif : la clé est le nom de l'étudiant, la valeur sa moyenne (slide 64)
	$etudiantsNote = array('JOHN' => 9, 'BOB' => 15.5, 'RAYANE' => 7, 'ROSIE' => 13);

	// Fonction avec un paramètre et une valeur de retour (slide 71)
	function estAdmissible($note) {
		// L'opérateur de comparaison >= renvoie true ou false (slide 66)
		return $note >= 10;
	}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Etudiants - Note</title>
	</head>
	<body>
		<!-- Le PHP est mélangé avec le HTML pour générer les lignes du tableau (slide 27) -->
		<table id="table1" border="1">
			<tr>
				<th>Etudiant</th>
				<th>Note</th>
			</tr>
			<?php
				// Boucle foreach pour parcourir le tableau associatif clé => valeur (slide 69)
				foreach ($etudiantsNote as $etudiant => $note) {
					// Condition if / else (slide 67)
					if (estAdmissible($note)) {
						$couleur = "rgb(136,248,136)";
					} else {
						$couleur = "rgb(251,173,173)";
					}

					// echo pour écrire le HTML de la ligne, avec concaténation par le point (slide 61)
					echo '<tr class="row" style="background-color: ' . $couleur . ';">';
					echo '<td class="etud">' . $etudiant . '</td>';
					echo '<td class="note">' . $note . '</td>';
					echo '</tr>';
				}
			?>
		</table>
	</body>
</html>
