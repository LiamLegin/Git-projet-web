<?php require_once 'auth.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--========== BOX ICONS ==========-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!--========== CSS ==========-->
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/legals.css">
        <link rel="stylesheet" href="assets/css/nav.css">

        <title>Stageo</title>
    </head>
    <body>

        <!--========== SCROLL TOP ==========-->
        <a href="#" class="scrolltop" id="scroll-top">
            <i class='bx bx-chevron-up scrolltop__icon'></i>
        </a>

        <!--========== HEADER ==========-->
        <?php require_once(__DIR__ . '/header.php'); ?>
    <div class="container">
        <h1>Mentions Légales</h1>
    <p><strong>Responsable du site : Groupe D</strong></p>
    <p>Nom de l'entreprise : Stageo</p>
    <p>Adresse : 6 rue de la forêt de la Reine, Vandoeuvre-lès-Nancy, France, 54600</p>
    <p>Téléphone : +33 1 23 45 67 89</p>
    <p>E-mail : <a href="mailto:stageo.contact@gmail.com">stageo.contact@gmail.com</a></p>
    <p>Directeur de la publication : Corentin ROMANO</p>
    <p><strong>Hébergeur du site : Localhost</strong></p>
    <p>Nom de l'entreprise : Xampp</p>
    <p>Adresse : 456 Avenue de l'Hébergement, 75002 Paris, France</p>
    <p>Téléphone : +33 1 98 76 54 32</p>
</div>

        <!--========== FOOTER ==========-->
        <?php require_once(__DIR__ . '/footer.php'); ?>


        <!--========== MAIN JS ==========-->
        <script src="assets/js/main.js"></script>


        
    </body>
</html>
