<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--========== BOX ICONS ==========-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!--========== CSS ==========-->
        <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/login.css">
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
        <header class="l-header" id="header">
            <nav class="nav bd-container">
                <div class="nav_logo">
                <a href="index.php"><img src="assets/img/stageo.png"></a>
            </div>


                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item"><a href="index.php" class="nav__link active-link">Accueil</a></li>
                        <li class="nav__item"><a href="about.php" class="nav__link">A propos</a></li>
                        <li class="nav__item"><a href="stats.php" class="nav__link">Stats</a></li>
                        <li class="nav__item"><a href="offers.php" class="nav__link">Offres</a></li>
                        <li class="nav__item"><a href="contact.php" class="nav__link">Contact</a></li>
                        <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                    </ul>
                </div>
            </div>
                    <a href="login.php" class="nav__login">Se connecter</a>
                    <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            </nav>
        </header>
  
        <main class="l-main">
            
    <body>
        <div class="login">

            <form action="" class="login__form" method="post">
                <h1 class="login__title">Mot de passe oublié</h1>

                <div class="login__content">
                    <div class="login__box">
                        <i class="ri-user-3-line login__icon"></i>

                        <div class="login__box-input">
                            <input type="email" required class="login__input" id="login-email" name="email" placeholder=" ">
                            <label for="login-email" class="login__label">Email</label>
                        </div>
                    </div>

                    <div class="login__box">
                        <i class="ri-lock-2-line login__icon"></i>

                      
                        
                    </div>
                </div>


                <button type="submit" class="login__button">Récupération du mot de passe</button>

            </form>
        </div>

        <!--=============== MAIN JS ===============-->
        <script src="assets/js/main.js"></script>
    </body>

    </html>