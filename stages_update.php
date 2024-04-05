    <?php include 'authAdmin.php'; ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modification d'offre de stages</title>
            <link href="assets/css/styles.css" rel="stylesheet">
            <link href="assets/css/nav.css" rel="stylesheet">
            <link href="assets/css/gestion.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
        </head>

        

        <body>
        <?php 
        require_once 'config.php';
        require_once 'header.php';
        ?>

            <div>
                <h1>Mettre à jour une offre de stage</h1>
                <div class="button-container">
                    <button class="button-gestion" onclick="window.location.href='gestionStages.php'">Retour</button>
                </div>

                <form action="stages_post_update.php" method="POST">
                    <div>
                        <label for="id_offre_stage">Numéro d'identification de l'offre de stage que vous voulez modifier</label>
                        <input type="number" id="id_offre_stage" name="id_offre_stage">
                    </div>    

                    <br>

                    <div>
                        <label for="id_administrateur">Nouveau nom de l'administrateur</label>
                        <select id="id_administrateur" name="id_administrateur">
                            <?php
                            // Récupérer les administrateurs depuis la base de données
                            $requeteAdministrateurs = $mysqlClient->query('SELECT * FROM administrateur ORDER BY nom_administrateur');
                            while ($administrateur = $requeteAdministrateurs->fetch()) {
                                echo '<option value="' . $administrateur['id_administrateur'] . '">' . $administrateur['prenom_administrateur'] . " " . $administrateur['nom_administrateur'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <br>

                    <div>
                        <label for="nom_offre_stage">Nouveau nom de l'offre</label>
                        <input type="text" id="nom_offre_stage" name="nom_offre_stage">
                    </div>

                    <br>

                    <div>
                        <label for="description_stage">Nouvelle description de l'offre</label>
                        <textarea id="description_stage" name="description_stage"></textarea>
                    </div>

                    <br>

                    <div>
                        <label for="duree_mois">Nouvelle durée (en mois)</label>
                        <input type="number" id="duree_mois" name="duree_mois">
                    </div>

                    <br>

                    <div>
                        <label for="salaire_euro">Nouveau salaire (en euros)</label>
                        <input type="number" id="salaire_euro" name="salaire_euro">
                    </div>

                    <br>

                    <div>
                        <label for="places_offertes">Nouveau nombre de places offertes</label>
                        <input type="number" id="places_offertes" name="places_offertes">
                    </div>

                    <br>

                    <div>
                        <label for="date_debut_prevu">Nouvelle date de début prévue (si elle a changé)</label>
                        <input type="date" id="date_debut_prevu" name="date_debut_prevu">
                    </div>

                    <br>

                    <div>
                        <label for="date_fin_prevu">Nouvelle date de fin prévue (si elle a changé)</label>
                        <input type="date" id="date_fin_prevu" name="date_fin_prevu">
                    </div>

                    <br>

                    <div>
                        <label for="competences_requises">Nouvelles compétences requises</label>
                        <select name="competences_requises" id="competences_requises" multiple>
                            <?php
                            // Récupérer les données des compétences depuis la base de données
                            $requeteCompetences = $mysqlClient->query('SELECT * FROM competence ORDER BY nom_competence');
                            while ($competence = $requeteCompetences->fetch()) {
                                // Afficher chaque compétence comme une option dans la liste déroulante
                                echo '<option value="' . $competence['id_competence'] . '">' . $competence['nom_competence'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="button">Valider la modification</button>
                </form>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#competences_requises').select2();
                });

                // Fonction pour récupérer les informations de l'offre de stage via AJAX
                function fetchStageInfo() {
                // Récupérer l'ID de l'offre de stage depuis le champ de saisie
                var id_offre_stage = document.getElementById('id_offre_stage').value;

                // Effectuer une requête AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'fetch_stage_info.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Parsez la réponse JSON
                        var stageInfo = JSON.parse(xhr.responseText);
                        // Remplir les champs du formulaire avec les données de l'offre de stage
                        document.getElementById('nom_offre_stage').value = stageInfo.nom_offre_stage || "Non associé";
                        document.getElementById('description_stage').value = stageInfo.description_stage || "Non associé";
                        document.getElementById('duree_mois').value = stageInfo.duree_mois || "Non associé";
                        document.getElementById('salaire_euro').value = stageInfo.salaire_euro || "Non associé";
                        document.getElementById('places_offertes').value = stageInfo.places_offertes || "Non associé";
                        document.getElementById('date_debut_prevu').value = stageInfo.date_debut_prevu || "Non associé";
                        document.getElementById('date_fin_prevu').value = stageInfo.date_fin_prevu || "Non associé";
                    } else {
                        // Gérer les erreurs de requête
                        console.error('Erreur lors de la récupération des informations de l\'offre de stage');
                    }
                };
                // Envoyer l'ID de l'offre de stage dans le corps de la requête
                xhr.send('id_offre_stage=' + encodeURIComponent(id_offre_stage));
            }

            // Écouter les changements dans le champ ID de l'offre de stage
            document.getElementById('id_offre_stage').addEventListener('input', fetchStageInfo);
            </script>
            <script src="assets/js/main.js"></script>
        </body>
        <?php require_once 'footer.php';?> 
    </html>