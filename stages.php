<?php
include "config.php";
include "auth.php";



// Définition de l'ordre de tri par défaut
$triLocalite = isset($_GET['triLocalite']) ? $_GET['triLocalite'] : 'desc';

// Requête SQL pour calculer le pourcentage d'entreprises présentes dans chaque ville
$sql = "SELECT 
            ville.nom_ville AS Ville,
            COUNT(DISTINCT entreprise.id_entreprise) * 100 / total_entreprises.total AS Pourcentage_Entreprises
        FROM 
            ville
        LEFT JOIN 
            adresse ON ville.id_ville = adresse.id_ville
        LEFT JOIN 
            entreprise ON adresse.id_entreprise = entreprise.id_entreprise
        CROSS JOIN (
            SELECT 
                COUNT(DISTINCT Id_Entreprise) AS total
            FROM 
                entreprise
        ) AS total_entreprises
        GROUP BY 
            ville.nom_ville";

// Ajout de la clause ORDER BY pour le tri
$sql .= " ORDER BY Pourcentage_Entreprises $triLocalite LIMIT 8";


// Préparation de la requête
$stmt = $mysqlClient->prepare($sql);

// Exécution de la requête
$stmt->execute();
$pourcentages_entreprises = $stmt->fetchAll(PDO::FETCH_ASSOC);




// Définition de l'ordre de tri par défaut
$triCompetences = isset($_GET['triCompetences']) ? $_GET['triCompetences'] : 'desc';

// Requête SQL pour calculer le pourcentage de chaque compétence
$sql = "SELECT 
            competence.nom_competence AS Compétence,
            COUNT(*) * 100 / total_competences.total AS Pourcentage_Competence
        FROM 
            competence
        LEFT JOIN 
            exiger ON competence.id_competence = exiger.id_competence
        CROSS JOIN (
            SELECT 
                COUNT(*) AS total
            FROM 
                competence
        ) AS total_competences
        GROUP BY 
            competence.nom_competence";

// Ajout de la clause ORDER BY pour le tri
$sql .= " ORDER BY Pourcentage_Competence $triCompetences LIMIT 8";

// Préparation de la requête
$stmt = $mysqlClient->prepare($sql);

// Exécution de la requête
$stmt->execute();
$pourcentages_competences = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Définition de l'ordre de tri par défaut
$triannonce = isset($_GET['triannonce']) ? $_GET['triannonce'] : 'desc';

// Récupération des termes de recherche
$search_offre = isset($_GET['search_offre']) ? $_GET['search_offre'] : '';
$search_ville = isset($_GET['search_ville']) ? $_GET['search_ville'] : '';

// Requête SQL pour sélectionner le nom de l'offre de stage, la ville associée et la durée
$sql = "SELECT 
          offre_stage.nom_offre_stage AS Nom_Offre_Stage,
          ville.nom_ville AS Ville,
          offre_stage.duree_mois AS Durée
      FROM 
          offre_stage 
      LEFT JOIN 
          adresse ON offre_stage.id_entreprise = adresse.id_entreprise
      LEFT JOIN 
          ville ON adresse.id_ville = ville.id_ville
      WHERE 
          (offre_stage.nom_offre_stage LIKE :search_offre OR :search_offre = '')
          AND (ville.nom_ville LIKE :search_ville OR :search_ville = '')";

// Ajout de la clause ORDER BY pour le tri
$sql .= " ORDER BY Durée $triannonce";

// Préparation de la requête
$stmt = $mysqlClient->prepare($sql);

// Liaison des paramètres de recherche
$stmt->bindValue(':search_offre', "%$search_offre%", PDO::PARAM_STR);
$stmt->bindValue(':search_ville', "%$search_ville%", PDO::PARAM_STR);

// Exécution de la requête
$stmt->execute();
$offres_stage = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stageo | Login</title>

    <!--========== BOX ICONS ==========-->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!--========== CSS ==========-->
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/gestion.css">
    <link rel="stylesheet" href="assets/css/stats.css">
    
  </head>
  <body>
  <?php include 'header.php'; ?>
  <h1>Statistiques des stages</h1>
  <div class="button-container">
    <button class="button-gestion" Onclick="window.location.href='stats.php'"> Retour</button>
        </div>
    <div class="form-container">
  <form action="" method="GET" class="form-tri">
  <input type="hidden" name="triLocalite" value="true">
    <label for="triLocalite">Trier par :</label>
    <select name="triLocalite" id="triLocalite">
        <option value="asc" <?php if ($triLocalite === 'asc') echo 'selected'; ?>>Croissant</option>
        <option value="desc" <?php if ($triLocalite === 'desc') echo 'selected'; ?>>Décroissant</option>
    </select>
    <input type="submit" value="Trier">
  </form>
</div>

<div class="table-container">
  <!--========== tableau localité ==========-->
  <table class="stats-table">
  <caption>Localisation des stages</caption>
    <thead>
      <tr>
        <th>Ville</th>
        <th>Pourcentage</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($pourcentages_entreprises as $pourcentage): ?>
            <tr>
                <td><?php echo $pourcentage['Ville']; ?></td>
                <td><?php echo $pourcentage['Pourcentage_Entreprises']; ?>%</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
  </table>





  <form action="" method="GET" class="form-tri">
  <input type="hidden" name="triCompetences" value="true">
    <label for="triCompetences">Trier par :</label>
    <select name="triCompetences" id="triCompetences">
        <option value="asc" <?php if ($triCompetences === 'asc') echo 'selected'; ?>>Croissant</option>
        <option value="desc" <?php if ($triCompetences === 'desc') echo 'selected'; ?>>Décroissant</option>
    </select>
    <input type="submit" value="Trier">
  </form>
  <!--========== tableau des compétences==========-->
  <table class="stats-table">
  <caption style="font-size: 16px;">Tableau des Compétences</caption>
    <thead>
      <tr>
        <th>Secteur</th>
        <th>Pourcentage</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($pourcentages_competences as $pourcentage): ?>
            <tr>
                <td><?php echo $pourcentage['Compétence']; ?></td>
                <td><?php echo $pourcentage['Pourcentage_Competence']; ?>%</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
</div>



<div class="form-container-recherche">
  <form action="" method="GET">
    <label for="search_offre">Rechercher par nom de l'offre :</label>
    <input type="text" id="search_offre" name="search_offre" value="<?php echo $search_offre; ?>">
    <label for="search_ville">Rechercher par ville :</label>
    <input type="text" id="search_ville" name="search_ville" value="<?php echo $search_ville; ?>">
    <label for="triannonce">Trier par durée :</label>
    <select name="triannonce" id="triannonce">
        <option value="asc" <?php if ($triannonce === 'asc') echo 'selected'; ?>>Croissant</option>
        <option value="desc" <?php if ($triannonce === 'desc') echo 'selected'; ?>>Décroissant</option>
    </select>
    <input type="submit" value="Rechercher et Trier">
  </form>
</div>

  <!-- top annonces -->
<div class="center-table" style="margin-top: 100px;">
  <table class="stats-table-top" >
  <caption style="font-size: 16px;">Tableau des annonces</caption>
    <!-- Contenu du tableau -->
    <thead>
      <tr>
        <th>Nom </th>
        <th>Localité  </th>
        <th>Temps du stage  </th>

      </tr>
    </thead>
    <tbody>
        <?php foreach ($offres_stage as $offre): ?>
            <tr>
                <td><?php echo $offre['Nom_Offre_Stage']; ?></td>
                <td><?php echo $offre['Ville']; ?></td>
                <td><?php echo $offre['Durée']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include 'footer.php'; ?>
</body>
<script src="assets/js/main.js"></script>