<?php
	// Début du script PHP (slide 58)

	// Tableau associatif dont chaque valeur est elle-même un tableau associatif (slide 64)
	$serveurs = array(
		'api-01'   => array('cpu' => 45, 'ram' => 60, 'status' => "1"),
		'api-02'   => array('cpu' => 92, 'ram' => 78, 'status' => "1"),
		'db-prod'  => array('cpu' => 70, 'ram' => 95, 'status' => "1"),
		'web-01'   => array('cpu' => 30, 'ram' => 40, 'status' => "1"),
		'web-02'   => array('cpu' => 55, 'ram' => 65, 'status' => "0"),
		'cache-01' => array('cpu' => 88, 'ram' => 92, 'status' => "1")
	);

	// Fonction qui calcule le score d'un serveur (slide 71)
	function calculScore($cpu, $ram) {
		// Opérateurs arithmétiques (slide 66)
		return 100 - ($cpu + $ram) / 2;
	}

	// Un serveur est critique si cpu > 85 ou ram > 90 (opérateur logique ||, slide 66)
	function estCritique($cpu, $ram) {
		return $cpu > 85 || $ram > 90;
	}

	// Variables pour le résumé (slide 60)
	$total_online = 0;
	$somme_scores = 0;
	$best_nom = "";
	$best_score = -1;
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Monitoring de serveurs</title>
	</head>
	<body>
		<!-- PHP mélangé avec le HTML (slide 27) -->
		<table id="table1" border="1">
			<tr>
				<th>Serveur</th>
				<th>CPU%</th>
				<th>RAM%</th>
				<th>Status</th>
				<th>Score</th>
				<th>État</th>
			</tr>
			<?php
				// Boucle foreach avec clé => valeur (slide 69)
				foreach ($serveurs as $nom => $infos) {
					$cpu = $infos['cpu'];
					$ram = $infos['ram'];
					$score = calculScore($cpu, $ram);
					$critique = estCritique($cpu, $ram);

					// Etat du serveur avec if / elseif / else (slide 67)
					if ($critique) {
						$etat = "CRITIQUE";
					} elseif ($score >= 50) {
						$etat = "OK";
					} else {
						$etat = "ATTENTION";
					}

					// Couleur de la ligne : offline en priorité, puis critique, puis selon le score
					if ($infos['status'] == "0") {
						$status = "offline";
						$couleur = "rgb(200,200,200)";
					} else {
						$status = "online";
						$total_online++;

						if ($critique) {
							$couleur = "rgb(255,180,180)";
						} elseif ($score >= 50) {
							$couleur = "rgb(180,255,180)";
						} else {
							$couleur = "rgb(255,220,150)";
						}
					}

					// Pour le résumé
					$somme_scores += $score;
					if ($score > $best_score) {
						$best_score = $score;
						$best_nom = $nom;
					}

					// Affichage de la ligne avec echo (slide 61)
					echo '<tr class="row" style="background-color: ' . $couleur . ';">';
					echo '<td class="serveur">' . $nom . '</td>';
					echo '<td class="cpu">' . $cpu . '</td>';
					echo '<td class="ram">' . $ram . '</td>';
					echo '<td class="status">' . $status . '</td>';
					echo '<td class="score">' . $score . '</td>';
					echo '<td class="etat">' . $etat . '</td>';
					echo '</tr>';
				}

				// count() donne le nombre d'éléments du tableau (slide 65)
				$moy_scores = $somme_scores / count($serveurs);
			?>
		</table>

		<h3>Résumé</h3>
		<p>Serveurs online: <span id="total_online_servers"><?php echo $total_online; ?></span></p>
		<p>Score moyen: <span id="moy_scores"><?php echo $moy_scores; ?></span></p>
		<p>Meilleur serveur: <span id="best_serv"><?php echo $best_nom . " (" . $best_score . ")"; ?></span></p>
	</body>
</html>
