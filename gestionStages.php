<?php require_once 'config.php';
      require_once 'authAdmin.php';        
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion des offres de stage</title>
        <link href="assets/css/styles.css" rel="stylesheet">
        <link href="assets/css/nav.css" rel="stylesheet">
        <link href="assets/css/gestion.css" rel="stylesheet">
    </head>

    <body>
    <?php require_once 'header.php'; ?>

    <nav class="container">
        <a href="stages_create.php" class="button-gestion">Ajouter une offre de stage</a><br>
        <a href="stages_update.php" class="button-gestion">Mettre à jour une offre de stage</a><br>
        <a href="stages_delete.php" class="button-gestion">Supprimer une offre de stage</a>
        <a href="signup.php" class="button-gestion">Retour</a>
    </nav>

    <h1>Liste des offres de stage</h1>

    <form id="searchForm" method="get">
        <div class="filter-section">
            <label for="search_entreprise">Rechercher par nom d'entreprise :</label>
            <input type="text" id="search_entreprise" name="search_entreprise" value="<?= isset($_GET['search_entreprise']) ? htmlspecialchars($_GET['search_entreprise']) : '' ?>">

            <label for="search_offre">Rechercher par nom d'offre :</label>
            <input type="text" id="search_offre" name="search_offre" value="<?= isset($_GET['search_offre']) ? htmlspecialchars($_GET['search_offre']) : '' ?>">
        </div>

        <div class="filter-section">
            <button type="submit" class="button-gestion">Rechercher</button>
            <button type="reset" class="button-gestion">Réinitialiser</button>
        </div>
    </form>

    <?php
    $requete = "SELECT 
                    entreprise.nom_entreprise,
                    entreprise.logo_entreprise,
                    offre_stage.nom_offre_stage,
                    offre_stage.description_stage,
                    offre_stage.duree_mois,
                    offre_stage.salaire_euro,
                    offre_stage.places_offertes,
                    offre_stage.date_publication,
                    offre_stage.date_debut_prevu,
                    offre_stage.date_fin_prevu,
                    GROUP_CONCAT(competence.nom_competence SEPARATOR ', ') AS competences_associées
                FROM 
                    offre_stage
                JOIN 
                    entreprise ON offre_stage.id_entreprise = entreprise.id_entreprise
                LEFT JOIN 
                    exiger ON offre_stage.id_offre_stage = exiger.id_offre_stage
                LEFT JOIN 
                    competence ON exiger.id_competence = competence.id_competence";

    // Ajout des clauses WHERE pour la recherche
    $conditions = array();
    $params = array();

    if (!empty($_GET['search_entreprise'])) {
        $conditions[] = "entreprise.nom_entreprise LIKE :search_entreprise";
        $params[':search_entreprise'] = '%' . $_GET['search_entreprise'] . '%';
    }

    if (!empty($_GET['search_offre'])) {
        $conditions[] = "offre_stage.nom_offre_stage LIKE :search_offre";
        $params[':search_offre'] = '%' . $_GET['search_offre'] . '%';
    }

    // Construction de la requête avec les clauses WHERE si nécessaire
    if (!empty($conditions)) {
        $requete .= " WHERE " . implode(" AND ", $conditions);
    }

    $requete .= " GROUP BY offre_stage.id_offre_stage";

    $etat = $mysqlClient->prepare($requete);
    $etat->execute($params);
    $offres = $etat->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table>
        <thead>
        <tr>
            <th>Entreprise</th>
            <th>Logo de l'entreprise</th>
            <th>Nom de l'offre</th>
            <th>Description</th>
            <th>Durée</th>
            <th>Salaire</th>
            <th>Places offertes</th>
            <th>Date de publication</th>
            <th>Date de début prévue</th>
            <th>Date de fin prévue</th>
            <th>Compétences associées</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($offres as $offre): ?>
            <tr>
                <td><?php echo htmlspecialchars($offre['nom_entreprise']); ?></td>
                <td><img src="<?php echo htmlspecialchars($offre['logo_entreprise']); ?>" alt="Logo de l'entreprise" width="100"></td>
                <td><?php echo htmlspecialchars($offre['nom_offre_stage']); ?></td>
                <td><?php echo htmlspecialchars($offre['description_stage']); ?></td>
                <td><?php echo htmlspecialchars($offre['duree_mois']); ?> mois</td>
                <td><?php echo htmlspecialchars($offre['salaire_euro']); ?> euros</td>
                <td><?php echo htmlspecialchars($offre['places_offertes']); ?></td>
                <td><?php echo date('d/m/Y', strtotime($offre['date_publication'])); ?></td>
                <td><?php echo date('d/m/Y', strtotime($offre['date_debut_prevu'])); ?></td>
                <td><?php echo date('d/m/Y', strtotime($offre['date_fin_prevu'])); ?></td>
                <td><?php echo htmlspecialchars($offre['competences_associées']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php require_once 'footer.php'; ?>
    </body>
</html>
