<?php include 'authAdmin.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Édition d'enseignant•e</title>
        <link href="assets/css/styles.css" rel="stylesheet">
        <link href="assets/css/nav.css" rel="stylesheet">
        <link href="assets/css/gestion.css" rel="stylesheet">
    </head>

    <body>
        <?php 
        require_once 'config.php';
        require_once 'header.php';
        ?>

        <div>
            <h1>Mettre à jour un•e enseignant•e</h1>
            <div class="button-container">
                <button class="button-gestion" onclick="window.location.href='gestionEnseignants.php'">Retour</button>
            </div>
            <form action="pilotes_post_update.php" method="POST">
                <div>
                    <label for="id_enseignant">Numéro d'identification de l'enseignant•e que vous voulez modifier</label><br>
                    <input type="number" id="id_enseignant" name="id_enseignant">
                </div>

                <br>

                <div>
                    <label for="nom_enseignant">Nouveau nom de l'enseignant•e</label>
                    <input type="text" id="nom_enseignant" name="nom_enseignant">
                </div>

                <br>

                <div>
                    <label for="prenom_enseignant">Nouveau prénom de l'enseignant•e</label>
                    <input type="text" id="prenom_enseignant" name="prenom_enseignant">
                </div>

                <br>

                <div>
                    <label for="promo_enseignant">Nouvelle promo gérée par l'enseignant•e (s'il en a une)</label><br>    
                    <select id="promo_enseignant" name="promo_enseignant">
                        <option value="">Aucune promotion</option>
                        <?php
                        // Récupérer les données des promotions depuis la base de données
                        $requetePromotions = $mysqlClient->query('SELECT * FROM promo ORDER BY nom_promo');
                        while ($promotion = $requetePromotions->fetch()) {
                            // Afficher chaque promotion comme une option dans la liste déroulante
                            echo '<option value="' . $promotion['id_promo'] . '">' . $promotion['nom_promo'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div id="dates_pilotage" style="display: none;">
                    <br>

                    <label for="date_debut_pilotage">Date à laquelle l'enseignant commencera à gérer sa nouvelle promotion</label>
                    <input type="date" id="date_debut_pilotage" name="date_debut_pilotage">

                    <br>

                    <label for="date_fin_pilotage">Date à laquelle l'enseignant sera séparé de sa nouvelle promotion</label>
                    <input type="date" id="date_fin_pilotage" name="date_fin_pilotage">
                </div>

                <br>

                <div>
                    <label for="campus_enseignant">Nouveau campus où se trouve l'enseignant•e</label><br>
                    <select id="campus_enseignant" name="campus_enseignant">
                        <option value="" selected>Pas de changement de campus</option>
                        <?php
                        // On refait la même démarche que pour les promotions
                        $requeteCampus = $mysqlClient->query('SELECT * FROM campus ORDER BY nom_campus');
                        while ($campus = $requeteCampus->fetch()) {
                            echo '<option value="' . $campus['id_campus'] . '">' . $campus['nom_campus'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <br>

                <div>
                    <label for="tel_enseignant">Numéro de téléphone de l'enseignant•e</label><br>
                    <input type="tel" id="tel_enseignant" name="tel_enseignant">
                </div>

                <br>

                <div>
                    <label for="email">Nouvel email de l'enseignant•e</label>
                    <input type="email" id="email" name="email">
                </div>

                <br>

                <div>
                    <label for="password">Nouveau mot de passe de l'enseignant•e</label>
                    <input type="password" id="password" name="password">
                </div>

                <button type="submit">Valider la modification</button>
            </form>
            <br />
        </div>
        <script>
            document.getElementById('promo_enseignant').addEventListener('change', function() {
                var selectedPromo = this.value;
                var datesPilotage = document.getElementById('dates_pilotage');

                if (selectedPromo) {
                    datesPilotage.style.display = 'block';
                } else {
                    datesPilotage.style.display = 'none';
                }
            });
        </script>
        <script src="assets/js/main.js"></script>
    </body>
    <?php require_once 'footer.php'; ?>
</html>
