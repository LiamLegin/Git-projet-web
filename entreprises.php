<?php
include "config.php";
include "auth.php";
// Définition de l'ordre de tri par défaut
$triVille = isset($_GET['triVille']) ? $_GET['triVille'] : 'desc';

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
$sql .= " ORDER BY Pourcentage_Entreprises $triVille LIMIT 5";

// Préparation de la requête
$stmt = $mysqlClient->prepare($sql);

// Exécution de la requête
$stmt->execute();
$pourcentages_entreprises = $stmt->fetchAll(PDO::FETCH_ASSOC);




try {
  // Connexion à la base de données
  $pdo = new PDO('mysql:host=localhost;dbname=stageo;charset=utf8', 'root', '');
} catch (PDOException $e) {
  // En cas d'erreur de connexion, affichage d'un message d'erreur
  die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
// Définition de l'ordre de tri par défaut
$triSecteur = isset($_GET['triSecteur']) ? $_GET['triSecteur'] : 'desc';

// Requête SQL pour calculer le pourcentage de chaque secteur d'activité
$sql = "SELECT 
          secteur_activite.nom_secteur_activite AS Secteur_Activité,
          COUNT(*) * 100 / total_secteurs.total AS Pourcentage_Secteur
      FROM 
          secteur_activite
      LEFT JOIN 
          posseder ON secteur_activite.id_secteur_activite = posseder.id_secteur_activite
      CROSS JOIN (
          SELECT 
              COUNT(*) AS total
          FROM 
              secteur_activite
      ) AS total_secteurs
      GROUP BY 
          secteur_activite.nom_secteur_activite";

// Ajout de la clause ORDER BY pour le tri
$sql .= " ORDER BY Pourcentage_Secteur $triSecteur limit 5";

// Préparation de la requête
$stmt = $pdo->prepare($sql);

// Exécution de la requête
$stmt->execute();
$pourcentages_secteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);





try {
  // Connexion à la base de données
  $pdo = new PDO('mysql:host=localhost;dbname=stageo;charset=utf8', 'root', '');
} catch (PDOException $e) {
  // En cas d'erreur de connexion, affichage d'un message d'erreur
  die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

// Définition de l'ordre de tri par défaut
$triEntreprise = isset($_GET['triEntreprise']) ? $_GET['triEntreprise'] : 'desc';

// Récupération des termes de recherche
$search_entreprise = isset($_GET['search_entreprise']) ? $_GET['search_entreprise'] : '';
$search_ville = isset($_GET['search_ville']) ? $_GET['search_ville'] : '';

// Requête SQL pour sélectionner les entreprises avec leurs notes et logos
$sql = "SELECT 
          entreprise.nom_entreprise,
          ville.nom_ville AS ville,
          (SUM(evaluation_etudiant.note_etudiant) + SUM(evaluation_enseignant.note_enseignant)) / (COUNT(evaluation_enseignant.note_enseignant) + COUNT(evaluation_etudiant.note_etudiant)) AS note_totale,
          entreprise.logo_entreprise AS logo
      FROM 
          entreprise
      LEFT JOIN 
          adresse ON entreprise.id_entreprise = adresse.id_entreprise
      LEFT JOIN 
          ville ON adresse.id_ville = ville.id_ville
      LEFT JOIN 
          evaluation_etudiant ON entreprise.id_entreprise = evaluation_etudiant.id_entreprise
      LEFT JOIN 
          evaluation_enseignant ON entreprise.id_entreprise = evaluation_enseignant.id_entreprise
      WHERE 
          (entreprise.nom_entreprise LIKE :search_entreprise OR :search_entreprise = '')
          AND (ville.nom_ville LIKE :search_ville OR :search_ville = '')
      GROUP BY 
          entreprise.nom_entreprise
      ORDER BY 
          note_totale $triEntreprise";

// Préparation de la requête
$stmt = $pdo->prepare($sql);

// Liaison des paramètres de recherche
$stmt->bindValue(':search_entreprise', "%$search_entreprise%", PDO::PARAM_STR);
$stmt->bindValue(':search_ville', "%$search_ville%", PDO::PARAM_STR);

// Exécution de la requête
$stmt->execute();
$entreprises = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
  <div class="button-container">
    <button class="button-gestion" Onclick="window.location.href='stats.php'"> Retour</button>
        </div>>

<div class="form-container">
  <form action="" method="GET" class="form-tri">
  <input type="hidden" name="triLocalite" value="true">
    <label for="triVille">Trier par :</label>
    <select name="triVille" id="triVille">
        <option value="asc" <?php if ($triVille === 'asc') echo 'selected'; ?>>Croissant</option>
        <option value="desc" <?php if ($triVille === 'desc') echo 'selected'; ?>>Décroissant</option>
    </select>
    <input type="submit" value="Trier">
  </form>
</div>


<div class="table-container" style="margin-top: 100px;">
  <!--========== tableau localité ==========-->
  <table class="stats-table">
  <caption style="font-size: 16px;">Tableau des Localité</caption>
    <thead>
      <tr>
        <th>Localité</th>
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


  <div class="form-container">
    <form action="" method="GET">
      <label for="triSecteur">Trier par :</label>
      <select name="triSecteur" id="triSecteur">
          <option value="asc" <?php if ($triSecteur === 'asc') echo 'selected'; ?>>Croissant</option>
          <option value="desc" <?php if ($triSecteur === 'desc') echo 'selected'; ?>>Décroissant</option>
      </select>
      <input type="submit" value="Trier">
    </form>
  </div>
  <!--========== tableau secteur d'activité ==========-->
  <table class="stats-table">
  <caption style="font-size: 16px;">Tableau des Secteur d'Activité</caption>
    <thead>
      <tr>
        <th>Secteur d'activité</th>
        <th>Pourcentage</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($pourcentages_secteurs as $pourcentage): ?>
            <tr>
                <td><?php echo $pourcentage['Secteur_Activité']; ?></td>
                <td><?php echo $pourcentage['Pourcentage_Secteur']; ?>%</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
</div>


<form action="" method="GET">
    <label for="search_entreprise">Rechercher par nom de l'entreprise :</label>
    <input type="text" id="search_entreprise" name="search_entreprise" value="<?php echo $search_entreprise; ?>">
    <label for="search_ville">Rechercher par ville :</label>
    <input type="text" id="search_ville" name="search_ville" value="<?php echo $search_ville; ?>">
    <label for="triEntreprise">Trier par note totale :</label>
    <select name="triEntreprise" id="triEntreprise">
        <option value="asc" <?php if ($triEntreprise === 'asc') echo 'selected'; ?>>Croissant</option>
        <option value="desc" <?php if ($triEntreprise === 'desc') echo 'selected'; ?>>Décroissant</option>
    </select>
    <input type="submit" value="Rechercher et Trier">
</form>

              <!-- Tableau top entreprises -->
<div class="center-table" style="margin-top: 100px;">
  <table class="stats-table-top" >
  <caption style="font-size: 16px;">Tableau des meilleurs entreprises</caption>

    <thead>
      <tr>
        <th>Nom </th>
        <th>Localité  </th>
        <th>Note de l'entreprise  </th>
        <th>Logo de l'entreprises </th>

      </tr>
    </thead>
    <tbody>
        <?php foreach ($entreprises as $entreprise): ?>
            <tr>
                <td><?php echo $entreprise['nom_entreprise']; ?></td>
                <td><?php echo $entreprise['ville']; ?></td>
                <td><?php echo $entreprise['note_totale']; ?></td>
                <td><img src="<?php echo $entreprise['logo']; ?>" alt="Logo de l'entreprise" width="100"></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include 'footer.php'; ?>
</body>
<script src="assets/js/main.js"></script>