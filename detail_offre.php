<?php
include 'auth.php';
include 'config.php';
include 'header.php';
// Vérification de l'existence de l'ID de l'offre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_offre = $_GET['id'];

// Requête SQL pour récupérer les détails de l'offre
$sql = "SELECT 
            nom_offre_stage,
            description_stage,
            duree_mois,
            salaire_euro,
            places_offertes,
            date_publication,
            date_debut_prevu,
            date_fin_prevu
        FROM 
            offre_stage
        WHERE 
            id_offre_stage = :id";

// Préparation de la requête
$stmt = $mysqlClient->prepare($sql);

// Liaison du paramètre ID
$stmt->bindValue(':id', $id_offre, PDO::PARAM_INT);

// Exécution de la requête
$stmt->execute();

// Récupération des résultats
$offre_detail = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérification de l'existence de l'offre
if (!$offre_detail) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'offre de stage</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/offers.css">
    <link rel="stylesheet" href="assets/css/nav.css">
</head>
<body>
<div class="container">
<h1>Détails de l'offre de stage</h1>

<table border="1">
    <tbody>
        <tr>
            <th>Nom de l'offre</th>
            <td><?php echo $offre_detail['nom_offre_stage']; ?></td>
        </tr>
        <tr>
            <th>Description</th>
            <td><?php echo $offre_detail['description_stage']; ?></td>
        </tr>
        <tr>
            <th>Durée (mois)</th>
            <td><?php echo $offre_detail['duree_mois']; ?></td>
        </tr>
        <tr>
            <th>Salaire (euros)</th>
            <td><?php echo $offre_detail['salaire_euro']; ?></td>
        </tr>
        <tr>
            <th>Places offertes</th>
            <td><?php echo $offre_detail['places_offertes']; ?></td>
        </tr>
        <tr>
            <th>Date de publication</th>
            <td><?php echo $offre_detail['date_publication']; ?></td>
        </tr>
        <tr>
            <th>Date de début prévue</th>
            <td><?php echo $offre_detail['date_debut_prevu']; ?></td>
        </tr>
        <tr>
            <th>Date de fin prévue</th>
            <td><?php echo $offre_detail['date_fin_prevu']; ?></td>
        </tr>
    </tbody>
</table>

<a href="offers.php"><button>Retour à la liste des offres</a>
</div>
<?php include 'footer.php'; ?>
</body>
<script src="assets/js/main.js"></script>
</html>
