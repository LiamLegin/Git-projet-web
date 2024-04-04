    <?php
     require_once 'auth.php'; 
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Inclure les classes PHPMailer
    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    // Initialisez les variables pour éviter les erreurs d'undefined variable
    $errName = $errEmail = $errMessage = $errHuman = $result = '';
    $name = $email = $message = '';

    function validateEmailDomain($email) {
        $allowedDomains = array('viacesi.fr', 'cesi.fr');
        $emailParts = explode('@', $email);
        if (count($emailParts) == 2 && in_array($emailParts[1], $allowedDomains)) {
            return true;
        }
        return false;
    }

    // Traiter le formulaire lorsqu'il est soumis
    if (isset($_POST["submit"])) {
        // Récupérer les valeurs du formulaire
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $message = isset($_POST['message']) ? $_POST['message'] : '';
        $human = isset($_POST['human']) ? intval($_POST['human']) : 0;
        $from = 'stageo.contact@gmail.com'; // Adresse expéditeur
        $to = 'stageo.contact@gmail.com'; // Adresse destinataire
        $subject = 'Message de Stageo'; // Sujet du message

        if (!validateEmailDomain($email)) {
            $errEmail = "Veuillez entrer une adresse email valide avec un domaine @viacesi.fr ou @cesi.fr";
        } else {

        // Créer une nouvelle instance de PHPMailer
        $mail = new PHPMailer(true); // Passer `true` active les exceptions

        try {
            // Paramètres du serveur SMTP
            $mail->isSMTP(); // Utiliser SMTP
            $mail->Host = 'smtp.gmail.com'; // Serveur SMTP
            $mail->SMTPAuth = true; // Activer l'authentification SMTP
            $mail->Username = 'stageo.contact@gmail.com'; // Nom d'utilisateur SMTP
            $mail->Password = 'ytfd kzha kzik ygqj'; // Mot de passe SMTP
            $mail->SMTPSecure = 'tls'; // Activer le chiffrement TLS
            $mail->Port = 587; // Port SMTP

            // Destinataires
            $mail->setFrom($from);
            $mail->addAddress($to);

            // Contenu du message
            $mail->isHTML(true); // Format HTML
            $mail->Subject = $subject;
            $mail->Body = "De: $name<br>E-Mail: $email<br>Message:<br>$message";

            // Envoyer le message
            $mail->send();
            $result = 'success'; // Succès
        } catch (Exception $e) {
            $result = 'error: ' . $mail->ErrorInfo; // Erreur
        }
    }
}
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stageo | Contact</title>

    <!--========== BOX ICONS ==========-->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!--========== CSS ==========-->
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    
    <!--========== JS ==========-->
    <script src="assets/js/main.js" defer></script>
    <script src="assets/js/contact.js" defer></script>
</head>
<body>
    <!--========== HEADER ==========-->
    <?php require_once(__DIR__ . '/header.php'); ?>

    <main class="l-main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1 class="page-header">Formulaire de contact</h1>
                    
                    <form class="form-horizontal" role="form" method="post" action="contact.php">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">NOM et Prénom</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="NOM et Prénom" value="<?php echo htmlspecialchars($name); ?>">
                                <?php echo "<p class='text-danger'>$errName</p>";?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="prénom.nom@viacesi.fr" value="<?php echo htmlspecialchars($email); ?>">
                                <?php echo "<p class='text-danger'>$errEmail</p>";?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="col-sm-2 control-label">Message</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($message);?></textarea>
                                <?php echo "<p class='text-danger'>$errMessage</p>";?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="human" class="col-sm-2 control-label">Anti Spam : <br>   En quelle position est la page contact dans la barre de navigation? </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="human" name="human" placeholder="Votre réponse">
                                <?php echo "<p class='text-danger'>$errHuman</p>";?>
                            </div>
                        </div>
                        <div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
        <input id="submit" name="submit" type="submit" value="Envoyer" class="btn btn-primary btn-block">
    </div>
</div>

                        <div class="form-group">
    <div class="col-sm-10 col-sm-offset-2" id="notification">
        <?php
        if ($result === 'success') {
            echo '<div class="alert alert-success" role="alert">Votre message a été envoyé avec succès.</div>';
        } elseif (strpos($result, 'error') !== false) {
            echo '<div class="alert alert-danger" role="alert">Une erreur s\'est produite lors de l\'envoi du message.</div>';
        }
        ?>
    </div>
</div>

                    </form>
                </div>
            </div>
        </div>
    </main>
    
    <!--========== SCRIPTS ==========-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>



</script>

    
</body>
</html>

