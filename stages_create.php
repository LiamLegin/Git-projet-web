<?php include 'authAdmin.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajouter une offre de stage</title>
        <link href="assets/css/styles.css" rel="stylesheet">
        <link href="assets/css/nav.css" rel="stylesheet">
        <link href="assets/css/gestion.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    </head>

    <body>
    <?php 
    require_once 'config.php';
    require_once 'header.php'; ?>

    <div>
        <h1>Ajouter une offre de stage</h1>
        <div class="button-container">
            <button class="button-gestion" onclick="window.location.href='gestionStages.php'">Retour</button>
        </div>
        <form action="stages_post_create.php" method="POST">
            <div>
                <label for="id_enseignant">Nom de l'enseignant qui a publié l'offre</label>
                <select id="id_enseignant" name="id_enseignant">
                    <?php
                    // Récupérer les enseignants depuis la base de données
                    $requeteEnseignants = $mysqlClient->query('SELECT * FROM enseignant ORDER BY nom_enseignant');
                    while ($enseignant = $requeteEnseignants->fetch()) {
                        echo '<option value="' . $enseignant['id_enseignant'] . '">' . $enseignant['prenom_enseignant'] . " " . $enseignant['nom_enseignant'] . '</option>';
                    }
                    ?>
                </select>

                <br>

                <label for="id_administrateur">Nom de l'administrateur</label>
                <select id="id_administrateur" name="id_administrateur">
                    <?php
                    // Récupérer les administrateurs depuis la base de données
                    $requeteAdministrateurs = $mysqlClient->query('SELECT * FROM administrateur ORDER BY nom_administrateur');
                    while ($administrateur = $requeteAdministrateurs->fetch()) {
                        echo '<option value="' . $administrateur['id_administrateur'] . '">' . $administrateur['prenom_administrateur'] . " " . $administrateur['nom_administrateur'] . '</option>';
                    }
                    ?>
                </select>

                <br>

                <label for="id_entreprise">Nom de l'entreprise</label>
                <select id="id_entreprise" name="id_entreprise">
                    <?php
                    // Récupérer les entreprises depuis la base de données
                    $requeteEntreprises = $mysqlClient->query('SELECT * FROM entreprise ORDER BY nom_entreprise');
                    while ($entreprise = $requeteEntreprises->fetch()) {
                        echo '<option value="' . $entreprise['id_entreprise'] . '">' . $entreprise['nom_entreprise'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <br>

            <div>
                <label for="nom_offre_stage">Nom de l'offre</label>
                <input type="text" id="nom_offre_stage" name="nom_offre_stage">
            </div>

            <br>

            <div>
                <label for="description_stage">Description de l'offre</label>
                <textarea id="description_stage" name="description_stage"></textarea>
            </div>

            <br>

            <div>
                <label for="duree_mois">Durée (en mois)</label>
                <input type="number" id="duree_mois" name="duree_mois">
            </div>

            <br>

            <div>
                <label for="salaire_euro">Salaire (en euros)</label>
                <input type="number" id="salaire_euro" name="salaire_euro">
            </div>

            <br>

            <div>
                <label for="places_offertes">Nombre de places offertes</label>
                <input type="number" id="places_offertes" name="places_offertes">
            </div>

            <br>

            <div>
                <label for="date_publication">Date de publication</label>
                <input type="date" id="date_publication" name="date_publication">
            </div>

            <br>

            <div>
                <label for="date_debut_prevu">Date de début prévue</label>
                <input type="date" id="date_debut_prevu" name="date_debut_prevu">
            </div>

            <br>

            <div>
                <label for="date_fin_prevu">Date de fin prévue</label>
                <input type="date" id="date_fin_prevu" name="date_fin_prevu">
            </div>

            <br>

            <div>
                <label for="competences_requises">Compétences requises</label>
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

            <button type="submit">Valider l'ajout</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#competences_requises').select2();
        });
    </script>
    <script src="assets/js/main.js"></script>
    </body>
    <?php require_once 'footer.php'; ?>
</html>
