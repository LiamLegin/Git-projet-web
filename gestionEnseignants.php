<?php require_once 'config.php';
      require_once 'authAdmin.php';        
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion des enseignant•e•s</title>
        <link href="assets/css/styles.css" rel="stylesheet">
        <link href="assets/css/nav.css" rel="stylesheet">
        <link href="assets/css/gestion.css" rel="stylesheet">
    </head>

    <body>
    <?php require_once 'header.php'; ?>

    <nav class="container">
        <a href="pilotes_create.php" class="button-gestion">Ajouter un enseignant•e</a><br>
        <a href="pilotes_update.php" class="button-gestion">Mettre à jour un enseignant•e</a><br>
        <a href="pilotes_delete.php" class="button-gestion">Supprimer un enseignant•e</a>
        <a href="signup.php" class="button-gestion">Retour</a>
    </nav>

    <h1>Liste des enseignant•e•s</h1>
    

    <!-- Formulaire de recherche -->
    <form id="searchForm" method="get">
    <div class="filter-section">
        <label for="search">Recherche par nom ou prénom :</label>
        <input type="text" id="search" name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    </div>

    <div class="filter-section">
        <?php
        // Code PHP pour générer le menu déroulant des options de filtrage de la promo
        $sql_promo = "SELECT DISTINCT CONCAT(nom_promo, ' - ', YEAR(date_debut_pilotage), '/', YEAR(date_fin_pilotage)) AS promo FROM piloter JOIN promo ON piloter.id_promo = promo.id_promo ORDER BY date_debut_pilotage";
        $result_promo = $mysqlClient->query($sql_promo);

        // Vérifier si des résultats ont été retournés
        if ($result_promo) {
            $options_promo = array("Aucune promo");

            while ($row_promo = $result_promo->fetch(PDO::FETCH_ASSOC)) {
                $options_promo[] = htmlspecialchars($row_promo['promo']);
            }

            sort($options_promo);

            echo '<label for="promo">Filtrer par promo :</label>';
            echo '<select id="promo" name="promo">';
            echo '<option value="">Choisir un filtre</option>';
            foreach ($options_promo as $option_promo) {
                $selected_promo = (isset($_GET['promo']) && $option_promo == $_GET['promo']) ? 'selected' : '';
                echo "<option value='$option_promo' $selected_promo>$option_promo</option>";
            }
            echo '</select>';
        }
        ?>
    </div>

    <div class="filter-section">
        <?php
        // Code PHP pour générer le menu déroulant des options de filtrage du campus
        $sql_campus = "SELECT DISTINCT nom_campus FROM campus ORDER BY nom_campus";
        $result_campus = $mysqlClient->query($sql_campus);

        // Vérifier si des résultats ont été retournés
        if ($result_campus) {
            $options_campus = array();

            while ($row_campus = $result_campus->fetch(PDO::FETCH_ASSOC)) {
                $options_campus[] = htmlspecialchars($row_campus['nom_campus']);
            }

            sort($options_campus);

            echo '<label for="campus">Filtrer par campus :</label>';
            echo '<select id="campus" name="campus">';
            echo '<option value="">Choisir un filtre</option>';
            foreach ($options_campus as $option_campus) {
                $selected_campus = (isset($_GET['campus']) && $option_campus == $_GET['campus']) ? 'selected' : '';
                echo "<option value='$option_campus' $selected_campus>$option_campus</option>";
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
    // Construction de la requête SQL de base
    $requete_base = "SELECT enseignant.nom_enseignant, enseignant.prenom_enseignant, utilisateur.email, 
                CONCAT(nom_promo, ' - ', YEAR(piloter.date_debut_pilotage), '/', YEAR(piloter.date_fin_pilotage)) AS promo, nom_campus
                FROM utilisateur 
                JOIN enseignant ON utilisateur.id_utilisateur = enseignant.id_utilisateur
                LEFT JOIN piloter ON enseignant.id_enseignant = piloter.id_enseignant 
                LEFT JOIN promo ON piloter.id_promo = promo.id_promo
                LEFT JOIN etre_localiser ON enseignant.id_enseignant = etre_localiser.id_enseignant
                LEFT JOIN campus ON etre_localiser.id_campus = campus.id_campus";

    // Traitement du formulaire de recherche
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    $promoFilter = isset($_GET['promo']) ? $_GET['promo'] : '';
    $campusFilter = isset($_GET['campus']) ? $_GET['campus'] : '';

    // Modification de la requête SQL pour prendre en compte le filtre de la promo et du campus
    $requete = $requete_base;

    // Ajout des clauses WHERE appropriées en fonction des filtres sélectionnés
    $conditions = array();

    if (!empty($searchTerm)) {
        $conditions[] = "(enseignant.nom_enseignant LIKE :searchTerm OR enseignant.prenom_enseignant LIKE :searchTerm)";
    }

    if (!empty($promoFilter) && $promoFilter !== 'Aucune promo') {
        $conditions[] = "CONCAT(nom_promo, ' - ', YEAR(piloter.date_debut_pilotage), '/', YEAR(piloter.date_fin_pilotage)) = :promoFilter";
    } elseif ($promoFilter === 'Aucune promo') {
        $conditions[] = "promo.id_promo IS NULL";
    }

    if (!empty($campusFilter)) {
        $conditions[] = "campus.nom_campus = :campusFilter";
    }

    // Construction de la requête avec les clauses WHERE
    if (!empty($conditions)) {
        $requete .= " WHERE " . implode(" AND ", $conditions);
    }

    // Ajout de la clause GROUP BY pour regrouper par certaines colonnes
    $requete .= " GROUP BY enseignant.nom_enseignant, enseignant.prenom_enseignant, utilisateur.email, promo, nom_campus";

    // Exécution de la requête
    $etat = $mysqlClient->prepare($requete);

    if (!empty($searchTerm)) {
        $searchTerm = "%$searchTerm%";
        $etat->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    }

    if (!empty($promoFilter) && $promoFilter !== 'Aucune promo') {
        $etat->bindParam(':promoFilter', $promoFilter, PDO::PARAM_STR);
    }

    if (!empty($campusFilter)) {
        $etat->bindParam(':campusFilter', $campusFilter, PDO::PARAM_STR);
    }

    $etat->execute();
    $colonne = $etat->fetchAll();

    // Affichage des résultats ou du message approprié
    if (!empty($colonne)) {
        ?>
        <table>
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Promo</th>
                <th>Campus</th>
            </tr>
            </thead>

            <tbody>
            <?php
            // Affichage des résultats
            foreach ($colonne as $jointure) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($jointure['nom_enseignant']) . "</td>";
                echo "<td>" . htmlspecialchars($jointure['prenom_enseignant']) . "</td>";
                echo "<td>" . htmlspecialchars($jointure['email']) . "</td>";
                echo "<td>" . ($jointure['promo'] ? htmlspecialchars($jointure['promo']) : "Aucune promo") . "</td>";
                echo "<td>" . htmlspecialchars($jointure['nom_campus']) . "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <?php
    } else{
        ?>
        <table>
            <tbody>
            <tr>
                <td colspan="5" style="text-align: center;">Aucun enseignant ne correspond aux critères sélectionnés.</td>
            </tr>
            </tbody>
        </table>

        <?php
    }
    require_once 'footer.php';
    ?>
    <script src="assets/js/main.js"></script>
    </body>
</html>
