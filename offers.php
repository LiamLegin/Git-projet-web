<?php
require_once 'auth.php'; 
require_once 'config.php';

// Nombre d'offres par page
$offres_par_page = 5;

// Page par défaut
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Récupération des valeurs des filtres de recherche
$search_offre = isset($_POST['search_offre']) ? $_POST['search_offre'] : '';
$search_ville = isset($_POST['search_ville']) ? $_POST['search_ville'] : '';
$search_entreprise = isset($_POST['search_entreprise']) ? $_POST['search_entreprise'] : '';

// Calcul de l'offset pour la requête SQL
$offset = ($page - 1) * $offres_par_page;

// Requête SQL pour récupérer les offres de la page actuelle avec les filtres
$sql = "SELECT DISTINCT 
        entreprise.nom_entreprise AS Nom_Entreprise,
        entreprise.logo_entreprise AS Logo_Entreprise,
        offre_stage.id_offre_stage,
        offre_stage.nom_offre_stage AS Nom_Offre_Stage,
        ville.nom_ville AS Ville
        FROM entreprise
        INNER JOIN adresse ON entreprise.id_entreprise = adresse.id_entreprise
        INNER JOIN offre_stage ON adresse.id_entreprise = offre_stage.id_entreprise
        INNER JOIN ville ON adresse.id_ville = ville.id_ville
        WHERE (offre_stage.nom_offre_stage LIKE :search_offre OR :search_offre = '')
        AND (ville.nom_ville LIKE :search_ville OR :search_ville = '')
        AND (entreprise.nom_entreprise LIKE :search_entreprise OR :search_entreprise ='')
        LIMIT :offset, :limit";

$stmt = $mysqlClient->prepare($sql);

// Liaison des paramètres de recherche et de pagination
$stmt->bindValue(':search_offre', "%$search_offre%", PDO::PARAM_STR);
$stmt->bindValue(':search_ville', "%$search_ville%", PDO::PARAM_STR);
$stmt->bindValue(':search_entreprise', "%$search_entreprise%", PDO::PARAM_STR);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $offres_par_page, PDO::PARAM_INT);

// Exécution de la requête
$stmt->execute();
$offres_stage = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calcul du nombre total de pages
$sql_count = "SELECT COUNT(*) AS total FROM entreprise
              INNER JOIN adresse ON entreprise.id_entreprise = adresse.id_entreprise
              INNER JOIN offre_stage ON adresse.id_entreprise = offre_stage.id_entreprise
              INNER JOIN ville ON adresse.id_ville = ville.id_ville
              WHERE (offre_stage.nom_offre_stage LIKE :search_offre OR :search_offre = '')
              AND (ville.nom_ville LIKE :search_ville OR :search_ville = '')
              AND (entreprise.nom_entreprise LIKE :search_entreprise OR :search_entreprise ='')";

$stmt_count = $mysqlClient->prepare($sql_count);
$stmt_count->bindValue(':search_offre', "%$search_offre%", PDO::PARAM_STR);
$stmt_count->bindValue(':search_ville', "%$search_ville%", PDO::PARAM_STR);
$stmt_count->bindValue(':search_entreprise', "%$search_entreprise%", PDO::PARAM_STR);
$stmt_count->execute();
$total_offres = $stmt_count->fetchColumn();
$total_pages = ceil($total_offres / $offres_par_page);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--========== BOX ICONS ==========-->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!--========== CSS ==========-->
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/offers.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <!--========== JS ==========-->
    <script src="assets/js/main.js" defer></script>

    <title>Stageo</title>

</head>
<body>

<!--========== SCROLL TOP ==========-->
<a href="#" class="scrolltop" id="scroll-top">
    <i class='bx bx-chevron-up scrolltop__icon'></i>
</a>

<!--========== HEADER ==========-->
<?php require_once(__DIR__ . '/header.php');?>
<main>
    <div class="wrapper">
<!-- Barre de recherche -->
    <div id="search-container">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h2>Recherche par nom d'offre</h2>
        <input type="search" name="search_offre" placeholder="Recherchez un titre d'offre..." value="<?php echo htmlspecialchars($search_offre); ?>">
        <h2>Recherche par nom d'entreprise</h2>
        <input type="search" name="search_entreprise" placeholder="Recherchez par entreprise..." value="<?php echo htmlspecialchars($search_entreprise); ?>">
        <h2>Recherche par nom de ville</h2>
        <input type="search" name="search_ville" placeholder="Recherchez par ville..." value="<?php echo htmlspecialchars($search_ville); ?>">
        <button type="submit">Rechercher</button>
        <button type="button" onclick="clearFilters()">Réinitialiser</button>

    </form>
</div>



        <!-- Affichage des offres de stage -->
        <div class="menu__container">
            <?php foreach ($offres_stage as $offre): ?>
                <div class="menu__content">
                    <img class="menu__img" src="<?php echo $offre['Logo_Entreprise']; ?>" alt="Logo de l'entreprise <?php echo $offre['Nom_Entreprise']; ?>">
                    <h2><?php echo $offre['Nom_Offre_Stage']; ?></h2>
                    <p>Entreprise: <?php echo $offre['Nom_Entreprise']; ?></p>
                    <p>Ville: <?php echo $offre['Ville']; ?></p>
                    <a href="detail_offre.php?id=<?php echo $offre['id_offre_stage']; ?>"><button>Voir en détail</button></a>

                </div>
            <?php endforeach; ?>
        </div>

        <!-- Affichage des boutons de pagination -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php if ($i == $page): ?>
                    <span class="button active"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?page=<?php echo $i; ?>" class="button"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
</main>



<script src="assets/js/main.js"></script>
</body>
</html>
