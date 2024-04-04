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

    <section class="home " id="home">
                <div class="home__container bd-container bd-grid">
                    <div class="home__data">
                        <h1 class="home__title">Statistiques</h1>
                        
                        <a href="entreprises.php" class="button">Entreprises</a>
                        <a href="stages.php" class="button">Stages</a>
                        <a href="etudiants.php" class="button">Etudiants</a>
                    </div>
    
                    <img src="assets/img/stat.png" alt="" class="home__img">
                </div>
                
            </section>
  </body>
</html>
