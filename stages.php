<?php

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=stageo;charset=utf8', 'root', '');
} catch (PDOException $e) {
    // En cas d'erreur de connexion, affichage d'un message d'erreur
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

// Définition de l'ordre de tri par défaut
$tri = isset($_GET['tri']) ? $_GET['tri'] : 'asc';

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
$sql .= " ORDER BY Pourcentage_Entreprises $tri LIMIT 8";

// Préparation de la requête
$stmt = $pdo->prepare($sql);

// Exécution de la requête
$stmt->execute();
$pourcentages_entreprises = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
$sql .= " ORDER BY Pourcentage_Competence $tri LIMIT 8";

// Préparation de la requête
$stmt = $pdo->prepare($sql);

// Exécution de la requête
$stmt->execute();
$pourcentages_competences = $stmt->fetchAll(PDO::FETCH_ASSOC);




try {
  // Connexion à la base de données
  $pdo = new PDO('mysql:host=localhost;dbname=stageo;charset=utf8', 'root', '');
} catch (PDOException $e) {
  // En cas d'erreur de connexion, affichage d'un message d'erreur
  die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

// Définition de l'ordre de tri par défaut
$tri = isset($_GET['tri']) ? $_GET['tri'] : 'asc';

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
$sql .= " ORDER BY Durée $tri";

// Préparation de la requête
$stmt = $pdo->prepare($sql);

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
    <link rel="stylesheet" href="assets/css/stats.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/stages.css">
    <style>
      .button-container {
        display: flex;
        justify-content: center;
        margin-top: 50px; /* Adjust this value as needed */
      }

      .button {
        padding: 10px 20px;
        border-radius: 20px;
        background-color: #3498db; /* Change the color as needed */
        color: white;
        font-size: 16px;
        margin: 0 10px;
        cursor: pointer;
        border: none;
        outline: none;
        transition: background-color 0.3s;
      }

      .button:hover {
        background-color: #2980b9; /* Change the hover color as needed */
      }
    </style>
  </head>
  <body>
     <!--========== HEADER ==========-->
     <header class="l-header" id="header">
        <nav class="nav bd-container">
            <div class="nav_logo">
              <a href="index.php"><img src="assets/img/stageo.png"></a>
            </div>
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="index.php" class="nav__link ">Accueil</a></li>
                    <li class="nav__item"><a href="about.php" class="nav__link">A propos</a></li>
                    <li class="nav__item"><a href="stats.php" class="nav__link active-link">Stats</a></li>
                    <li class="nav__item"><a href="offers.php" class="nav__link">Offres</a></li>
                    <li class="nav__item"><a href="contact.php" class="nav__link">Contact</a></li>
                    <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                </ul>
            </div>
            <a href="login.php" class="nav__login">Se connecter</a>
            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-menu'></i>
            </div>
        </nav>
    </header>

    <div class="form-container">
  <form action="" method="GET" class="form-tri">
  <input type="hidden" name="triLocalite" value="true">
    <label for="tri">Trier par :</label>
    <select name="tri" id="tri">
        <option value="asc" <?php if ($tri === 'asc') echo 'selected'; ?>>Croissant</option>
        <option value="desc" <?php if ($tri === 'desc') echo 'selected'; ?>>Décroissant</option>
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
    <label for="tri">Trier par durée :</label>
    <select name="tri" id="tri">
        <option value="asc" <?php if ($tri === 'asc') echo 'selected'; ?>>Croissant</option>
        <option value="desc" <?php if ($tri === 'desc') echo 'selected'; ?>>Décroissant</option>
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
        <th>Lien du stage </th>

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
<button class="button-gestion" Onclick="window.location.href='stats.php'"> Retour</button>
</body>
