<?php require_once 'config.php';
      require_once 'authAdmin.php';        
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion des entreprises</title>
        <link href="assets/css/styles.css" rel="stylesheet">
        <link href="assets/css/nav.css" rel="stylesheet">
        <link href="assets/css/gestion.css" rel="stylesheet">
    </head>

    <body>
    <?php require_once 'header.php'; ?>

    <nav class="container">
        <a href="entreprises_create.php" class="button-gestion">Ajouter une entreprise</a><br>
        <a href="entreprises_update.php" class="button-gestion">Mettre à jour une entreprise</a><br>
        <a href="entreprises_delete.php" class="button-gestion">Supprimer une entreprise</a>
        <a href="signup.php" class="button-gestion">Retour</a>
    </nav>

    <h1>Liste des entreprises</h1>

    <!-- Formulaire de recherche -->
    <form id="searchForm" method="get">
        <div class="filter-section">
            <label for="search">Recherche par nom d'entreprise :</label>
            <input type="text" id="search" name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        </div>

        <div class="filter-section">
            <?php
            // Code PHP pour générer le menu déroulant des options de filtrage du secteur d'activité
            $sql_secteur = "SELECT DISTINCT nom_secteur_activite FROM secteur_activite ORDER BY nom_secteur_activite";
            $result_secteur = $mysqlClient->query($sql_secteur);

            // Vérifier si des résultats ont été retournés
            if ($result_secteur) {
                $options_secteur = array();

                while ($row_secteur = $result_secteur->fetch(PDO::FETCH_ASSOC)) {
                    $options_secteur[] = htmlspecialchars($row_secteur['nom_secteur_activite']);
                }

                sort($options_secteur);

                echo '<label for="secteur_activite">Filtrer par secteur d\'activité : </label>';
                echo '<select id="secteur_activite" name="secteur_activite">';
                echo '<option value="">Choisir un filtre</option>';
                foreach ($options_secteur as $option_secteur) {
                    $selected_secteur = (isset($_GET['secteur_activite']) && $option_secteur == $_GET['secteur_activite']) ? 'selected' : '';
                    echo "<option value='$option_secteur' $selected_secteur>$option_secteur</option>";
                }
                echo '</select>';
            }
            ?>
        </div>

        <div class="filter-section">
            <?php
            // Code PHP pour générer le menu déroulant des options de filtrage du ville
            $sql_ville = "SELECT DISTINCT nom_ville FROM ville ORDER BY nom_ville";
            $result_ville = $mysqlClient->query($sql_ville);

            // Vérifier si des résultats ont été retournés
            if ($result_ville) {
                $options_ville = array();

                while ($row_ville = $result_ville->fetch(PDO::FETCH_ASSOC)) {
                    $options_ville[] = htmlspecialchars($row_ville['nom_ville']);
                }

                sort($options_ville);

                echo '<label for="ville"> Filtrer par ville : </label>';
                echo '<select id="ville" name="ville">';
                echo '<option value="">Choisir un filtre</option>';
                foreach ($options_ville as $option_ville) {
                    $selected_ville = (isset($_GET['ville']) && $option_ville == $_GET['ville']) ? 'selected' : '';
                    echo "<option value='$option_ville' $selected_ville>$option_ville</option>";
                }
                echo '</select>';
            }
            ?>
        </div>

        <div class="filter-section">
            <button type="submit" class="button-gestion">Rechercher</button>
            <button type="reset" class="button-gestion">Réinitialiser</button>
        </div>
    </form>

    <?php
    // Construction de la requête SQL
    $requete = "SELECT entreprise.nom_entreprise, entreprise.logo_entreprise, adresse.nom_rue, ville.nom_ville, ville.code_postal,
                GROUP_CONCAT(secteur_activite.nom_secteur_activite SEPARATOR ', ') AS secteurs_activite
                FROM entreprise
                INNER JOIN posseder ON entreprise.id_entreprise = posseder.id_entreprise
                INNER JOIN secteur_activite ON posseder.id_secteur_activite = secteur_activite.id_secteur_activite
                INNER JOIN adresse ON entreprise.id_entreprise = adresse.id_entreprise
                INNER JOIN ville ON adresse.id_ville = ville.id_ville
                GROUP BY entreprise.id_entreprise
                HAVING COUNT(DISTINCT secteur_activite.nom_secteur_activite) > 0 AND COUNT(DISTINCT ville.nom_ville) > 0";

    // Ajout de conditions de recherche
    $conditions = array();

    if (!empty($_GET['search'])) {
        $searchTerm = "%{$_GET['search']}%";
        $conditions[] = "(entreprise.nom_entreprise LIKE :searchTerm OR entreprise.logo_entreprise LIKE :searchTerm)";
    }

    if (!empty($_GET['secteur_activite'])) {
        $conditions[] = "secteur_activite.nom_secteur_activite = :secteur_activite";
    }

    if (!empty($_GET['ville'])) {
        $conditions[] = "ville.nom_ville = :ville";
    }

    // Ajout des conditions dans la requête
    if (!empty($conditions)) {
        $requete .= " HAVING " . implode(" AND ", $conditions);
    }

    // Ajout de l'ordre
    $requete .= " ORDER BY entreprise.nom_entreprise";

    // Préparation et exécution de la requête
    $etat = $mysqlClient->prepare($requete);
    if (!empty($_GET['search'])) {
        $etat->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    }
    if (!empty($_GET['secteur_activite'])) {
        $etat->bindParam(':secteur_activite', $_GET['secteur_activite'], PDO::PARAM_STR);
    }
    if (!empty($_GET['ville'])) {
        $etat->bindParam(':ville', $_GET['ville'], PDO::PARAM_STR);
    }
    $etat->execute();
    $entreprises = $etat->fetchAll();

    // Affichage des résultats ou du message approprié
    if (!empty($entreprises)) {
        ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Logo</th>
                    <th>Secteur d'activité</th>
                    <th>Localité</th>
                </tr>
            </thead>

            <tbody>
                <?php
                // Affichage des entreprises
                foreach ($entreprises as $entreprise) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($entreprise['nom_entreprise']) . "</td>";
                    echo "<td><img src=\"" . htmlspecialchars($entreprise['logo_entreprise']) . "\" alt=\"Logo de l'entreprise\"></td>";
                    echo "<td>" . htmlspecialchars($entreprise['secteurs_activite']) . "</td>";
                    echo "<td>" . htmlspecialchars($entreprise['nom_rue']) . " - " . htmlspecialchars($entreprise['nom_ville']) . " " . htmlspecialchars($entreprise['code_postal']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
    } else {
        // Aucune entreprise ne correspond aux critères
        ?>
        <p>Aucune entreprise ne correspond aux critères sélectionnés.</p>
        <?php
    }

    require_once 'footer.php';
    ?>
    <script src="assets/js/main.js"></script>
    </body>
</html>
