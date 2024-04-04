<?php require_once 'connexion.php';?>

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

    <?php require_once(__DIR__ . '/header.php'); ?>

    <body>
        <div class="login">

        <!-- Afficher le message d'erreur ou de succès -->
        <?php if (!empty($message)): ?>
            <div id="errorMessage" class="error-message"><?php echo $message; ?></div>


        <?php endif; ?>

            <form action="" class="login__form" method="post">
                <h1 class="login__title">Connexion</h1>

                <div class="login__content">
                    <div class="login__box">
                        <i class="ri-user-3-line login__icon"></i>

                        <div class="login__box-input">
                            <input type="text" required class="login__input" id="login-email" name="email" placeholder=" ">
                            <label for="login-email" class="login__label">Email</label>
                        </div>
                    </div>

                    <div class="login__box">
                        <i class="ri-lock-2-line login__icon"></i>

                        <div class="login__box-input">
                            <input type="password" required class="login__input" id="login-pass" name="motDePasse" placeholder=" ">
                            <label for="login-pass" class="login__label">Mot de passe</label>
                            <i class="ri-eye-off-line login__eye" id="login-eye"></i>
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
        <script src="assets/js/main.js" defer></script>
    </body>

</html>
