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

// Requête SQL pour calculer le pourcentage d'étudiants présents dans chaque ville
$sql = "SELECT 
            ville.nom_ville AS Ville,
            COUNT(etudiant.Id_Etudiant) * 100 / total_etudiants.total AS Pourcentage_Etudiants
        FROM 
            ville
        LEFT JOIN 
            adresse ON ville.id_ville = adresse.id_ville
        LEFT JOIN 
            etudiant ON adresse.Id_Etudiant = etudiant.Id_Etudiant
        CROSS JOIN (
            SELECT 
                COUNT(Id_Etudiant) AS total
            FROM 
                etudiant
        ) AS total_etudiants
        GROUP BY 
            ville.nom_ville";

// Ajout de la clause ORDER BY pour le tri
$sql .= " ORDER BY Pourcentage_Etudiants $tri LIMIT 5";

// Préparation de la requête
$stmt = $pdo->prepare($sql);

// Exécution de la requête
$stmt->execute();
$pourcentages_etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Définition de l'ordre de tri par défaut
$tri = isset($_GET['tri']) ? $_GET['tri'] : 'asc';

// Requête SQL pour calculer le pourcentage d'étudiants présents dans chaque ville
$sql = "SELECT 
            ville.nom_ville AS Ville,
            COUNT(DISTINCT composer.Id_Promo) * 100 / total_promos.total AS Pourcentage_Promos
        FROM 
            ville
        LEFT JOIN 
            adresse ON ville.id_ville = adresse.id_ville
        LEFT JOIN 
            etudiant ON adresse.Id_Etudiant = etudiant.Id_Etudiant
        LEFT JOIN 
            composer ON etudiant.Id_Etudiant = composer.Id_Etudiant
        CROSS JOIN (
        SELECT 
            COUNT(DISTINCT Id_Promo) AS total
        FROM 
            promo
            ) AS total_promos
        GROUP BY 
        ville.nom_ville";

// Ajout de la clause ORDER BY pour le tri
$sql .= " ORDER BY Pourcentage_Promos $tri LIMIT 5";

// Préparation de la requête
$stmt = $pdo->prepare($sql);

// Exécution de la requête
$stmt->execute();
$pourcentages_promos = $stmt->fetchAll(PDO::FETCH_ASSOC);

try {
  // Connexion à la base de données
  $pdo = new PDO('mysql:host=localhost;dbname=stageo;charset=utf8', 'root', '');
} catch (PDOException $e) {
  // En cas d'erreur de connexion, affichage d'un message d'erreur
  die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

// Récupération des termes de recherche
$search_nom = isset($_GET['search_nom']) ? $_GET['search_nom'] : '';
$search_prenom = isset($_GET['search_prenom']) ? $_GET['search_prenom'] : '';
$triDate = isset($_GET['triDate']) ? $_GET['triDate'] : 'Date_Candidature';
$triOrder = isset($_GET['triOrder']) ? $_GET['triOrder'] : 'desc';

// Requête SQL pour sélectionner les étudiants avec leurs dates de candidature et d'acceptation
$sql = "SELECT 
          etudiant.nom_etudiant AS Nom_Etudiant,
          etudiant.prenom_etudiant AS Prenom_Etudiant,
          candidater.date_candidature AS Date_Candidature,
          candidater.date_acceptation AS Date_Acceptation
      FROM 
          etudiant
      JOIN 
          candidater ON etudiant.Id_Etudiant = candidater.Id_Etudiant
      WHERE
          (etudiant.nom_etudiant LIKE :search_nom OR :search_nom ='') 
          AND (etudiant.prenom_etudiant LIKE :search_prenom OR :search_prenom = '')";

// Ajout de la clause ORDER BY pour le tri par date
$sql .= " ORDER BY $triDate $triOrder";

// Préparation de la requête
$stmt = $pdo->prepare($sql);

// Liaison des paramètres de recherche
$stmt->bindValue(':search_nom', "%$search_nom%", PDO::PARAM_STR);
$stmt->bindValue(':search_prenom', "%$search_prenom%", PDO::PARAM_STR);

// Exécution de la requête
$stmt->execute();
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="assets/css/etudiants.css">

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

<div class="form-container-tri">
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
  <!--========== tableau pourcentage d'etudiants par ville  ==========-->
  <table class="stats-table">
  <caption style="font-size: 16px;">Pourcentage d'étudiants par ville</caption>
    <thead>
      <tr>
        <th>Localité</th>
        <th>Pourcentage</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($pourcentages_etudiants as $pourcentage): ?>
            <tr>
                <td><?php echo $pourcentage['Ville']; ?></td>
                <td><?php echo $pourcentage['Pourcentage_Etudiants']; ?>%</td>
            </tr>
        <?php endforeach; ?>
    </tbody> 
  </table>

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
        <?php foreach ($pourcentages_promos as $pourcentage): ?>
            <tr>
                <td><?php echo $pourcentage['Ville']; ?></td>
                <td><?php echo $pourcentage['Pourcentage_Promos']; ?>%</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
</div>




<form action="" method="GET">
    <label for="search_nom">Rechercher par nom de l'étudiant :</label>
    <input type="text" id="search_nom" name="search_nom" value="<?php echo $search_nom; ?>">
    <label for="search_prenom">Rechercher par prénom de l'étudiant :</label>
    <input type="text" id="search_prenom" name="search_prenom" value="<?php echo $search_prenom; ?>">
    <label for="triDate">Trier par :</label>
    <select name="triDate" id="triDate">
        <option value="Date_Candidature" <?php if ($triDate === 'Date_Candidature') echo 'selected'; ?>>Date de candidature</option>
        <option value="Date_Acceptation" <?php if ($triDate === 'Date_Acceptation') echo 'selected'; ?>>Date d'acceptation</option>
    </select>
    <label for="triOrder">Ordre de tri :</label>
    <select name="triOrder" id="triOrder">
        <option value="asc" <?php if ($triOrder === 'asc') echo 'selected'; ?>>Croissant</option>
        <option value="desc" <?php if ($triOrder === 'desc') echo 'selected'; ?>>Décroissant</option>
    </select>
    <input type="submit" value="Rechercher et Trier">
</form>

              <!-- Tableau top entreprises -->
<div class="center-table" style="margin-top: 100px;">
  <table class="stats-table-top" >
  <caption style="font-size: 16px;">Tableau des étudiant pour un stage</caption>

    <thead>
      <tr>
        <th>Nom </th>
        <th>Prénom  </th>
        <th>Date candidature  </th>
        <th>Date d'acceptation </th>

      </tr>
    </thead>
    <tbody>
        <?php foreach ($etudiants as $etudiant): ?>
            <tr>
                <td><?php echo $etudiant['Nom_Etudiant']; ?></td>
                <td><?php echo $etudiant['Prenom_Etudiant']; ?></td>
                <td><?php echo $etudiant['Date_Candidature']; ?></td>
                <td><?php echo $etudiant['Date_Acceptation']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
</div>
<button class="button-gestion" Onclick="window.location.href='stats.php'">Retour</button>
</body>