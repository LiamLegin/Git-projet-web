<?php
session_start();

// Vérifie si l'utilisateur est déjà connecté
if (isset($_SESSION['username'])) {
    header("Location: bienvenue.php");
    exit;
}

// Vérification de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $host = 'localhost';
    $dbname = 'utilisateur'; // Remplacez avec le nom de votre base de données
    $username = 'root'; // Remplacez avec votre nom d'utilisateur de base de données
    $password = ''; // Remplacez avec votre mot de passe de base de données

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Erreur de connexion : ". $e->getMessage();
        die();
    }

    // Récupération des données du formulaire
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];

    // Requête pour vérifier les informations de connexion
    $query = "SELECT email, mot_de_passe FROM utilisateurs WHERE email = :email";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(':email' => $email));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $storedPassword = $row['mot_de_passe'];
            
            if ($motDePasse === $storedPassword) {
                // Connexion réussie, démarrez une session et redirigez vers la page de bienvenue
                $login = $row['email'];
                session_start(); 
                $_SESSION['username'] = $login; 
                header("Location: index.php");
                exit;
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Email non trouvé.";
        }
    } catch(PDOException $e) {
        echo "Erreur : ". $e->getMessage();
    }
}
?>

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
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/nav.css">


    <title>Login form - Stageo</title>
</head>

<body>

    <header class="l-header" id="header">
        <nav class="nav bd-container">
            <div class="nav_logo">
                <a href="index.php"><img src="assets/img/stageo.png"></a>
            </div>


            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="index.php" class="nav__link ">Accueil</a></li>
                    <li class="nav__item"><a href="about.php" class="nav__link">A propos</a></li>
                    <li class="nav__item"><a href="stats.php" class="nav__link">Stats</a></li>
                    <li class="nav__item"><a href="offers.php" class="nav__link">Offres</a></li>
                    <li class="nav__item"><a href="contact.php" class="nav__link">Contact</a></li>
                    <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                </ul>
            </div>
            </div>
            <a href="login.php" class="nav__login active-link">Se connecter</a>
            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-menu'></i>
            </div>
        </nav>
    </header>

    <body>
        <div class="login">

            <form action="" class="login__form" method="post">
                <h1 class="login__title">Connexion</h1>

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

                        <div class="login__box-input">
                            <input type="password" required class="login__input" id="login-pass" name="motDePasse" placeholder=" ">
                            <label for="login-pass" class="login__label">Mot de passe</label>
                            <!--<i class="ri-eye-off-line login__eye" id="login-eye"></i>-->
                        </div>
                        
                    </div>
                </div>

                <div class="login__check">
                    <div class="login__check-group">
                        <input type="checkbox" class="login__check-input" id="login-check">
                        <label for="login-check" class="login__check-label">Se souvenir de moi</label>
                    </div>

                    <a href="forgot.php" class="login__forgot">Mot de passe oublié?</a>
                </div>

                <button type="submit" class="login__button">Connexion</button>

            </form>
        </div>

        <!--=============== MAIN JS ===============-->
        <script src="assets/js/main.js"></script>
    </body>

</html>
