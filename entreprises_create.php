<?php include 'authAdmin.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajout d'entreprises</title>
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
            <h1>Ajouter une entreprise</h1>
            <div class="button-container">
                <button class="button-gestion" onclick="window.location.href='gestionEntreprises.php'">Retour</button>
            </div>
            <form action="entreprises_post_create.php" method="POST">
                <div>
                    <label for="nom_entreprise">Nom de l'entreprise</label>
                    <input type="text" id="nom_entreprise" name="nom_entreprise">
                </div>

                <br>

                <div>
                    <label for="logo_entreprise">Lien du logo de l'entreprise</label>
                    <input type="text" id="logo_entreprise" name="logo_entreprise">
                </div>

                <br>

                <div>
                    <label for="secteur_activite">Secteurs d'activité de l'entreprise</label>
                    <select id="secteur_activite" name="secteur_activite" multiple>
                        <?php
                        // Récupérer les données des secteurs depuis la base de données
                        $requeteSecteurs = $mysqlClient->query('SELECT * FROM secteur_activite ORDER BY nom_secteur_activite');
                        while ($secteur = $requeteSecteurs->fetch()) {
                            // Afficher chaque secteur comme une option dans la liste déroulante
                            echo '<option value="' . $secteur['id_secteur_activite'] . '">' . $secteur['nom_secteur_activite'] . '</option>';
                        }
                    ?>
                    </select>
                </div>

                <br>

                <div>
                    <label for="adresse_entreprise">Adresse de l'entreprise</label>
                    <input type="text" id="adresse_entreprise" name="adresse_entreprise">
                </div>

                <div>
                    <label for="ville_entreprise">Ville de l'entreprise</label>
                    <select id="ville_entreprise" name="ville_entreprise">
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

                <button type="submit" class="button-gestion">Valider l'ajout</button>
            </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#secteur_activite').select2();
            });
        </script>
        <script src="assets/js/main.js"></script>
    </body>
    <?php require_once 'footer.php';?> 
</html>
