<?php include 'authEns.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajout d'étudiant•e</title>
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
            <h1>Ajouter un étudiant•e</h1>
            <div class="button-container">
                <button class="button-gestion" onclick="window.location.href='gestionEleves.php'">Retour</button>
            </div>
            <form action="eleves_post_create.php" method="POST">
                <div>
                    <label for="nom_etudiant">Nom de l'étudiant•e</label>
                    <input type="text" id="nom_etudiant" name="nom_etudiant">
                </div>

                <br>

                <div>
                    <label for="prenom_etudiant">Prénom de l'étudiant•e</label>
                    <input type="text" id="prenom_etudiant" name="prenom_etudiant">
                </div>

                <br>

                <div>
                    <label for="date_naissance">Date de naissance de l'étudiant•e</label>
                    <input type="date" id="date_naissance" name="date_naissance">
                </div>

                <br>

                <div>
                    <label for="adresse_etudiant">Adresse à laquelle habite l'étudiant</label>
                    <input type="text" id="adresse_etudiant" name="adresse_etudiant">

                    <label for="ville_etudiant">Ville de l'étudiant</label>
                    <select name="ville_etudiant" id="ville_etudiant">
                        <?php
                        // Récupérer les données des villes depuis la base de données
                        $requeteVilles = $mysqlClient->query('SELECT * FROM ville JOIN region ON ville.id_region = region.id_region JOIN pays ON region.id_pays = pays.id_pays ORDER BY nom_ville');
                        while ($ville = $requeteVilles->fetch()) {
                            // Afficher chaque ville comme une option dans la liste déroulante
                            echo '<option value="' . $ville['id_ville'] . '">' . $ville['nom_ville'] . ' ' . $ville['code_postal'] . ' (' . $ville['nom_pays'] . ')</option>';
                        }
                        ?>
                    </select>
                </div>
            
                <br>
                
                <div>
                    <label for="promo_etudiant">Promo intégrée par l'étudiant•e</label>  
                    <select id="promo_etudiant" name="promo_etudiant">
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

                <br>

                <div>
                    <label for="date_debut_etudes">Date à laquelle l'étudiant•e débutera son année</label>
                    <input type="date" id="date_debut_etudes" name="date_debut_etudes">

                    <br>

                    <label for="date_fin_etudes">Date à laquelle l'étudiant•e finira son année</label>
                    <input type="date" id="date_fin_etudes" name="date_fin_etudes">
                </div>

                <br>

                <div>
                    <label for="campus_etudiant">Campus où se trouve l'étudiant•e</label>
                    <select id="campus_etudiant" name="campus_etudiant">
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
                    <label for="enseignant">Enseignant prenant en charge cette promotion</label>
                    <select id="enseignant" name="enseignant">
                        <?php
                        $requeteEnseignant = $mysqlClient->query('SELECT * FROM enseignant ORDER BY prenom_enseignant');
                        while ($enseignant = $requeteEnseignant->fetch()) {
                            echo '<option value="' . $enseignant['id_enseignant'] . '">' . $enseignant['prenom_enseignant'] . ' ' . $enseignant['nom_enseignant'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <br>

                <div>
                    <label for="tel_etudiant">Téléphone de l'étudiant•e</label>
                    <input type="tel" id="tel_etudiant" name="tel_etudiant">
                </div>

                <br>

                <div>
                    <label for="email">Email de l'étudiant•e</label>
                    <input type="email" id="email" name="email">
                </div>

                <br>

                <div>
                    <label for="password">Mot de passe de l'étudiant•e</label>
                    <input type="password" id="password" name="password">
                </div>

                <button type="submit">Valider l'ajout</button>
            </form>
        </div>
        <script src="assets/js/main.js"></script>
    </body>
    <?php require_once 'footer.php';?> 
</html>
