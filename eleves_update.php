<?php include 'authEns.php'; ?>  
   <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Édition d'étudiant•e</title>
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
                <h1>Mettre à jour un•e étudiant•e</h1>
                <div class="button-container">
                    <button class="button-gestion" onclick="window.location.href='gestionEleves.php'">Retour</button>
                </div>
                <form action="eleves_post_update.php" method="POST">
                    <div>
                        <label for="id_etudiant">Numéro d'identification de l'étudiant•e que vous voulez modifier</label>
                        <input type="number" id="id_etudiant" name="id_etudiant">
                    </div>

                    <br>

                    <div>
                        <label for="nom_etudiant">Nouveau nom de l'étudiant•e</label>
                        <input type="text" id="nom_etudiant" name="nom_etudiant">
                    </div>

                    <br>

                    <div>
                        <label for="prenom_etudiant">Nouveau prénom de l'étudiant•e</label>
                        <input type="text" id="prenom_etudiant" name="prenom_etudiant">
                    </div>

                    <br>

                    <div>
                        <label for="date_naissance">Nouvelle date de naissance de l'étudiant•e</label>
                        <input type="date" id="date_naissance" name="date_naissance">
                    </div>

                    <br>

                    <div>
                        <label for="adresse_etudiant">Nouvelle adresse à laquelle habite l'étudiant (laisser vide s'il n'a pas changé)</label>
                        <input type="text" id="adresse_etudiant" name="adresse_etudiant">
                    </div>

                    <br>

                    <div>
                        <label for="promo_etudiant">Nouvelle promo intégrée par l'étudiant•e</label>
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
                        <label for="date_debut_etudes">Date à laquelle l'étudiant•e intégrera sa nouvelle promotion</label>
                        <input type="date" id="date_debut_etudes" name="date_debut_etudes">

                        <br>

                        <label for="date_fin_etudes">Date à laquelle l'étudiant•e sera séparé de sa nouvelle promotion</label>
                        <input type="date" id="date_fin_etudes" name="date_fin_etudes">
                    </div>

                    <br>

                    <div>
                        <label for="campus_etudiant">Nouveau campus où se trouve l'étudiant•e</label>
                        <select id="campus_etudiant" name="campus_etudiant">
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

                    <div id="villeInput" style="display:none;">
                        <br>

                        <label for="ville_etudiant">Nouvelle ville de l'étudiant•e</label>
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
                        <label for="enseignant">Nouvel•le enseignant•e prenant en charge cette promotion</label>
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
                        <label for="tel_etudiant">Numéro de téléphone de l'étudiant•e</label>
                        <input type="tel" id="tel_etudiant" name="tel_etudiant">
                    </div>

                    <br>

                    <div>
                        <label for="email">Nouvel email de l'étudiant•e</label>
                        <input type="email" id="email" name="email">
                    </div>

                    <br>

                    <div>
                        <label for="password">Nouveau mot de passe de l'étudiant•e</label>
                        <input type="password" id="password" name="password">
                    </div>

                    <button type="submit" class="button-gestion">Valider la modification</button>
                </form>
                <br />
            </div>
            <script>
                document.getElementById('campus_etudiant').addEventListener('change', function() {
                    var villeInput = document.getElementById('villeInput');
                    if (this.value !== '') {
                        villeInput.style.display = 'block';
                    } else {
                        villeInput.style.display = 'none';
                    }
                });
                // Fonction pour récupérer les informations de l'étudiant via AJAX
                function fetchEtudiantInfo() {
                    // Récupérer l'ID de l'étudiant depuis le champ de saisie
                    var id_etudiant = document.getElementById('id_etudiant').value;

                    // Effectuer une requête AJAX
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'fetch_etudiant_info.php');
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            // Parsez la réponse JSON
                            var etudiantInfo = JSON.parse(xhr.responseText);
                            // Remplir les champs du formulaire avec les données de l'étudiant
                            document.getElementById('nom_etudiant').value = etudiantInfo.nom_etudiant || "Non associé";
                            document.getElementById('prenom_etudiant').value = etudiantInfo.prenom_etudiant || "Non associé";
                            document.getElementById('date_naissance').value = etudiantInfo.date_naissance_etudiant || "Non associée";
                            document.getElementById('adresse_etudiant').value = etudiantInfo.nom_rue || "Non associée";
                            document.getElementById('promo_etudiant').value = etudiantInfo.id_promo || "Non associée";
                            document.getElementById('date_debut_etudes').value = etudiantInfo.date_debut_etudes || "Non associée";
                            document.getElementById('date_fin_etudes').value = etudiantInfo.date_fin_etudes || "Non associée";
                            document.getElementById('enseignant').value = etudiantInfo.id_enseignant || "Non associé";
                            document.getElementById('tel_etudiant').value = etudiantInfo.telephone_etudiant || "Non associé";
                            document.getElementById('email').value = etudiantInfo.email || "Non associé";
                        } else {
                            // Gérer les erreurs de requête
                            console.error('Erreur lors de la récupération des informations de l\'étudiant');
                        }
                    };
                    // Envoyer l'ID de l'étudiant dans le corps de la requête
                    xhr.send('id_etudiant=' + encodeURIComponent(id_etudiant));
                }

                // Écouter les changements dans le champ ID de l'étudiant
                document.getElementById('id_etudiant').addEventListener('input', fetchEtudiantInfo);
            </script>
<script src="assets/js/main.js"></script>
        </body>
        <?php require_once 'footer.php'; ?>
    </html>
