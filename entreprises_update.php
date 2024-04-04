    <?php include 'authAdmin.php'; ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modification d'entreprises</title>
            <link href="assets/css/styles.css" rel="stylesheet">
            <link href="assets/css/nav.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
            <link href="assets/css/gestion.css" rel="stylesheet">
        </head>

        

        <body>
        <?php 
        require_once 'config.php';
        require_once 'header.php';
        ?>

            <div>
                <h1>Mettre à jour une entreprise</h1>
                <div class="button-container">
                    <button class="button-gestion" onclick="window.location.href='gestionEntreprises.php'">Retour</button>
                </div>
                <form action="entreprises_post_update.php" method="POST">
                    <div>
                        <label for="id_entreprise">Numéro d'identification de l'entreprise que vous voulez modifier</label>
                        <input type="number" id="id_entreprise" name="id_entreprise">
                    </div>

                    <br>

                    <div>
                        <label for="nom_entreprise">Nouveau nom de l'entreprise</label>
                        <input type="text" id="nom_entreprise" name="nom_entreprise">
                    </div>

                    <br>

                    <div>
                        <label for="logo_entreprise">Nouveau lien du logo de l'entreprise</label>
                        <input type="text" id="logo_entreprise" name="logo_entreprise">
                    </div>

                    <br>

                    <div>
                        <label for="secteur_activite">Nouveaux secteurs d'activité de l'entreprise</label>
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
                        <label for="adresse_entreprise">Nouvelle adresse de l'entreprise (si elle en a une)</label>
                        <input type="text" id="adresse_entreprise" name="adresse_entreprise">
                    </div>

                    <div>
                        <label for="ville_entreprise">Nouvelle ville de l'entreprise (si elle en a une)</label>
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

                // Fonction pour récupérer les informations de l'entreprise via AJAX
                function fetchEntrepriseInfo() {
                // Récupérer l'ID de l'entreprise depuis le champ de saisie
                var id_entreprise = document.getElementById('id_entreprise').value;

                // Effectuer une requête AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'fetch_entreprise_info.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Parsez la réponse JSON
                        var entrepriseInfo = JSON.parse(xhr.responseText);
                        // Remplir les champs du formulaire avec les données de l'entreprise
                        document.getElementById('nom_entreprise').value = entrepriseInfo.nom_entreprise || "Non associé";
                        document.getElementById('logo_entreprise').value = entrepriseInfo.logo_entreprise || "Non associé";
                        document.getElementById('adresse_entreprise').value = entrepriseInfo.nom_rue || "Non associé";
                        document.getElementById('ville_entreprise').value = entrepriseInfo.id_ville || "Non associé";
                    } else {
                        // Gérer les erreurs de requête
                        console.error('Erreur lors de la récupération des informations de l\'entreprise');
                    }
                };
                // Envoyer l'ID de l'entreprise dans le corps de la requête
                xhr.send('id_entreprise=' + encodeURIComponent(id_entreprise));
            }

            // Écouter les changements dans le champ ID de l'entreprise
            document.getElementById('id_entreprise').addEventListener('input', fetchEntrepriseInfo);
            </script>
            <script src="assets/js/main.js"></script>
        </body>
        <?php require_once 'footer.php';?> 
    </html>