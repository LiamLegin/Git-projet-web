<?php include "auth.php";
      include "config.php";
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
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    </style>
  </head>
  <body>
     <!--========== HEADER ==========-->
    <?php include 'header.php'; ?>

    <section class="home " id="home">
                <div class="home__container bd-container bd-grid">
                    <div class="home__data">
                        <h1 class="home__title">Statistiques</h1>
                        
                        <a href="entreprises.php" class="button">Entreprises</a>
                        <a href="stages.php" class="button">Stages</a>
                        <a href="etudiants.php" class="button">Etudiants</a>
                    </div>
    
                    <img src="assets/img/stats.jpg" alt="Représentation graphique de statistiques" class="home__img">
                </div>
                
            </section>
            <?php include "footer.php";?>
  </body>
  <script src="assets/js/main.js"></script>
</html>
