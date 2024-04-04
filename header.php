<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--========== BOX ICONS ==========-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'> 
        
        <!--========== CSS ==========-->
        <link rel="stylesheet" href="assets/css/nav.css">
        

<header class="l-header" id="header">
    <nav class="nav bd-container">
        <div class="nav_logo">
            <a href="index.php"><img src="assets/img/stageo.png" alt="Logo Stageo"></a>
        </div>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item"><a href="index.php" class="nav__link <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active-link'; ?>">Accueil</a></li>
                <li class="nav__item"><a href="about.php" class="nav__link <?php if(basename($_SERVER['PHP_SELF']) == 'about.php') echo 'active-link'; ?>">A propos</a></li>
                <li class="nav__item"><a href="stats.php" class="nav__link <?php if(basename($_SERVER['PHP_SELF']) == 'stats.php') echo 'active-link'; ?>">Stats</a></li>
                <li class="nav__item"><a href="offers.php" class="nav__link <?php if(basename($_SERVER['PHP_SELF']) == 'offers.php') echo 'active-link'; ?>">Offres</a></li>
                <li class="nav__item"><a href="contact.php" class="nav__link <?php if(basename($_SERVER['PHP_SELF']) == 'contact.php') echo 'active-link'; ?>">Contact</a></li>
                <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
            </ul>
        </div>
        
        <?php if(isset($_SESSION['username'])): ?>
    <div class="nav__login" onclick="toggleDropdown()">
    <?php echo $_SESSION['username'] . " | " . $_SESSION['role']; ?>

        <div id="dropdownMenu" class="dropdown-content">
            <a href="logout.php">Déconnexion</a>
            <?php if($_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Enseignant'):?>
                <a href="signup.php">Gestion utilisateurs</a>
            <?php endif;?>
        </div>
    </div>
<?php else: ?>
    <a href="login.php" class="nav__login <?php if(basename($_SERVER['PHP_SELF']) == 'login.php' || basename($_SERVER['PHP_SELF']) == 'forgot.php') echo 'active-link'; ?>">Se connecter</a>
<?php endif; ?>

        
        <div class="nav__toggle" id="nav-toggle">
            <i class='bx bx-menu'></i>
        </div>
    </nav>
</header>
</html>