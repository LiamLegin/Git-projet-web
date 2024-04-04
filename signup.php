<?php require_once 'authEns.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--========== BOX ICONS ==========-->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/signup.css">


    <title>Création de compte - Stageo</title>
</head>

<body>

    <?php require_once(__DIR__ . '/header.php'); ?>

    <div class="cat__container bd-grid">
        <?php if ($_SESSION['role'] === 'Administrateur' || $_SESSION['role'] === 'Enseignant'): ?>
            <div class="signup">
                <div class="signup__content">
                    <img src="assets/img/students.png" alt="" class="signup_img">
                    <h3 class="signup__cat">Etudiants</h3>
                    <a href="gestionEleves.php"><button class="button"> Créer ou modifier un étudiant</button></a>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($_SESSION['role'] === 'Administrateur'): ?>
            <div class="signup">
                <div class="signup__content">
                    <img src="assets/img/stages.png" alt="" class="signup_img">
                    <h3 class="signup__cat">Enseignants</h3>
                    <a href="gestionEnseignants.php"><button class="button"> Créer ou modifier un tuteur</button></a>
                </div>
            </div>
            <div class="signup">
                <div class="signup__content">
                    <img src="assets/img/logos.png" alt="" class="signup_img">
                    <h3 class="signup__cat">Stages</h3>
                    <a href="gestionStages.php"><button class="button"> Créer ou modifier un stage</button></a>
                </div>
            </div>
            <div class="signup">
                <div class="signup__content">
                    <img src="assets/img/logos.png" alt="" class="signup_img">
                    <h3 class="signup__cat">Entreprises</h3>
                    <a href="gestionEntreprises.php"><button class="button"> Créer ou modifier une entreprise</button></a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
</body>

</html>
