<?php include 'authAdmin.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajout d'enseignant•e</title>
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
            <h1>Ajouter un enseignant•e</h1>
            <div class="button-container">
                <button class="button-gestion" onclick="window.location.href='gestionEnseignants.php'">Retour</button>
            </div>
            <form action="pilotes_post_create.php" method="POST">
                <div>
                    <label for="nom_enseignant">Nom de l'enseignant•e</label>
                    <input type="text" id="nom_enseignant" name="nom_enseignant">
                </div>

                <br>

                <div>
                    <label for="prenom_enseignant">Prénom de l'enseignant•e</label>
                    <input type="text" id="prenom_enseignant" name="prenom_enseignant">
                </div>

                <br>

                <div>
                    <label for="dateDebut">Date à laquelle l'enseignant•e s'est engagé•e</label>
                    <input type="date" id="dateDebut" name="dateDebut">
                </div>

                <br>
                
                <div>
                    <label for="promo_enseignant">Promo gérée par l'enseignant•e (s'il en a une)</label><br>    
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

                    <label for="date_debut_pilotage">Date à laquelle l'enseignant•e commencera à gérer sa promotion</label>
                    <input type="date" id="date_debut_pilotage" name="date_debut_pilotage">

                    <br>

                    <label for="date_fin_pilotage">Date à laquelle l'enseignant•e sera séparé•e de sa promotion</label>
                    <input type="date" id="date_fin_pilotage" name="date_fin_pilotage">
                </div>

                <br>

                <div>
                    <label for="campus_enseignant">Campus où se trouve l'enseignant•e</label>
                    <select id="campus_enseignant" name="campus_enseignant">
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
                    <label for="tel_enseignant">Téléphone de l'enseignant•e</label>
                    <input type="tel" id="tel_enseignant" name="tel_enseignant">
                </div>

                <br>

                <div>
                    <label for="email">Email de l'enseignant•e</label>
                    <input type="email" id="email" name="email">
                </div>

                <br>

                <div>
                    <label for="password">Mot de passe de l'enseignant•e</label>
                    <input type="password" id="password" name="password">
                </div>

                <button type="submit">Valider l'ajout</button>
            </form>
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
    <?php require_once 'footer.php';?> 
</html>
