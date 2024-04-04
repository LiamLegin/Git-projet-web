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
        <link rel="stylesheet" href="assets/css/main.css">
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
  
        <main class="l-main">
            <!--========== HOME ==========-->
            <section class="home" id="home">
                <div class="home__container bd-container bd-grid">
                    <div class="home__data">
                        <h1 class="home__title">A propos de nous</h1>
                        <h2 class="home__subtitle">Pourquoi ce site web?</h2>
                        <p>CESI Nancy nous a demandé de produire un site web permettant à leurs étudiants d'entrer en contact facilement avec
                            des entreprises, tout en facilitant le suivi par les tuteurs.
                        </p>
                    </div>
    
                    <img src="assets/img/stages.png" alt="" class="home__img">
                </div>
            </section>
            
            <!--========== ABOUT ==========-->
            <section class="about section bd-container" id="about">
                <div class="about__container  bd-grid">
                    <div class="about__data">
                        <span class="section-subtitle about__initial">Notre équipe</span>
                        <h2 class="section-title about__initial">Qui sommes nous?</h2>
                        <p class="about__description">4 élèves de la promotion CPIA2 INFO 2023/2024 du CESI Nancy</p>
                    </div>

                    <img src="assets/img/cesi.png" alt="" class="about__img">
                </div>
            </section>

            <!--========== CONTACT US ==========-->
            <section class="contact section bd-container" id="contact">
                <div class="contact__container bd-grid">
                    <div class="contact__data">
                        <span class="section-subtitle contact__initial">Besoin de renseignements</span>
                        <h2 class="section-title contact__initial">Nous pouvons vous aider</h2>
                        <p class="contact__description">Si vous avez besoin d'informations supplémentaires, contactez nous !</p>
                    </div>
                    
                    <div class="contact__button">
                        <a href="contact.php" class="button">Contactez nous</a>
                    </div>
                </div>
            </section>
        </main>

        <!--========== FOOTER ==========-->
        <?php require_once(__DIR__ . '/footer.php'); ?>

        <!--========== SCROLL REVEAL ==========-->
        <script src="https://unpkg.com/scrollreveal"></script>

        <!--========== MAIN JS ==========-->
        <script src="assets/js/main.js"></script>


        
    </body>
</html>
