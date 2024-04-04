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
            <section class="home " id="home">
                <div class="home__container bd-container bd-grid">
                    <div class="home__data">
                        <h1 class="home__title">Stages</h1>
                        <h2 class="home__subtitle">Trouvez votre stage</h2>
                        <a href="offers.php" class="button">Voir les stages</a>
                    </div>
    
                    <img src="assets/img/stages.png" alt="" class="home__img">
                </div>
            </section>
            
            <!--========== ABOUT ==========-->
            <section class="about section bd-container " id="about">
                <div class="about__container  bd-grid">
                    <div class="about__data">
                        <span class="section-subtitle about__initial">A propos de nous</span>
                        <h2 class="section-title about__initial">Nous gérons des stages pour vous</h2>
                        <p class="about__description">Vos recherches de stages sont simplifiées, et la communication des informations est assurée</p>
                        <a href="about.php" class="button">A propos de nous</a>
                    </div>

                    <img src="assets/img/logos.png" alt="" class="about__img">
                </div>
            </section>
            <!--========== MENU ==========-->
            <section class="menu section bd-container " id="menu">
                <span class="section-subtitle">Offres</span>
                <h2 class="section-title">Recommandations</h2>

                <div class="menu__container bd-grid">
                    <div class="menu__content">
                        <img src="assets/img/infolor.png" alt="" class="menu__img">
                        <h3 class="menu__name">Infolor</h3>
                        <span class="menu__detail">Développeur web</span>
                        <span class="menu__preci">Metz</span>
                        <button class="button"> En savoir plus</button>
                    </div>

                    <div class="menu__content">
                        <img src="assets/img/arcelor.svg" alt="" class="menu__img">
                        <h3 class="menu__name">Arcelor Mittal</h3>
                        <span class="menu__detail">Ingénieur matériaux</span>
                        <span class="menu__preci">Nancy</span>
                        <button class="button"> En savoir plus</button>
                    </div>
                    
                    <div class="menu__content">
                        <img src="assets/img/corsaires.png" alt="" class="menu__img">
                        <h3 class="menu__name">Les corsaires du BTP</h3>
                        <span class="menu__detail">Ingénieur BTP</span>
                        <span class="menu__preci">Strasbourg</span>
                        <button class="button"> En savoir plus</button>
                    </div>
                </div>
            </section>


            <!--========== CONTACT US ==========-->
            <section class="contact section bd-container " id="contact">
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
