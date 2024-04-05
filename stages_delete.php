<?php include 'authAdmin.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Suppression d'offre de stage</title>
        <link href="assets/css/styles.css" rel="stylesheet">
        <link href="assets/css/nav.css" rel="stylesheet">
        <link href="assets/css/gestion.css" rel="stylesheet">
    </head>
    <body>
        <?php 
        require_once 'config.php';
        require_once 'header.php';
        ?>

        <h1>Supprimer une offre de stage</h1>
        <div class="button-container">
            <button class="button-gestion" onclick="window.location.href='gestionStages.php'">Retour</button>
        </div>

        <h2>Pensez à vérifier les informations correspondantes</h2>
        <form action="stages_post_delete.php" method="POST" id="deleteForm">
            <label for="id_offre_stage">Numéro d'identification de l'offre de stage à supprimer</label>
            <input type="number" id="id_offre_stage" name="id_offre_stage">

            <div>
                <label for="id_entreprise">Nom de l'entreprise liée à l'offre de stage</label>
                <input type="text" id="id_entreprise" name="id_entreprise" readonly>
            </div>

            <br>

            <div>
                <label for="nom_offre_stage">Nom de l'offre de stage à supprimer</label>
                <input type="text" id="nom_offre_stage" name="nom_offre_stage" readonly>
            </div>

            <br>

            <div>
                <label for="description_stage">Description de l'offre de stage à supprimer</label>
                <input type="text" id="description_stage" name="description_stage" readonly>
            </div>

            <br>

            <div>
                <label for="duree_mois">Durée (en mois) de l'offre de stage à supprimer</label>
                <input type="number" id="duree_mois" name="duree_mois" readonly>
            </div>

            <br>

            <div>
                <label for="salaire_euro">Salaire (en euros) de l'offre de stage à supprimer</label>
                <input type="number" id="salaire_euro" name="salaire_euro" readonly>
            </div>

            <br>

            <div>
                <label for="places_offertes">Nombre de places qui étaient offertes</label>
                <input type="number" id="places_offertes" name="places_offertes" readonly>
            </div>

            <br>

            <div>
                <label for="date_publication">Date de publication</label>
                <input type="date" id="date_publication" name="date_publication" readonly>
            </div>

            <br>

            <div>
                <label for="date_debut_prevu">Date de début qui était prévue</label>
                <input type="date" id="date_debut_prevu" name="date_debut_prevu" readonly>
            </div>

            <br>

            <div>
                <label for="date_fin_prevu">Date de fin qui était prévue</label>
                <input type="date" id="date_fin_prevu" name="date_fin_prevu" readonly>
            </div>
            
            <button type="submit">Valider la suppression</button>
        </form>

        <script>
            document.getElementById('id_offre_stage').addEventListener('change', function() {
                var idOffreStage = this.value;

                // Envoyer une requête AJAX pour récupérer les informations de l'offre de stage à supprimer
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'fetch_stage_info.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var stageInfo = JSON.parse(xhr.responseText);
                            // Mettre à jour les champs du formulaire avec les informations récupérées
                            document.getElementById('id_entreprise').value = stageInfo.nom_entreprise || "Non associé";
                            document.getElementById('nom_offre_stage').value = stageInfo.nom_offre_stage || "Non associé";
                            document.getElementById('description_stage').value = stageInfo.description_stage || "Non associé";
                            document.getElementById('duree_mois').value = stageInfo.duree_mois || "Non associé";
                            document.getElementById('salaire_euro').value = stageInfo.salaire_euro || "Non associé";
                            document.getElementById('places_offertes').value = stageInfo.places_offertes || "Non associé";
                            document.getElementById('date_debut_prevu').value = stageInfo.date_debut_prevu || "Non associé";
                            document.getElementById('date_fin_prevu').value = stageInfo.date_fin_prevu || "Non associé";
                        } else {
                            console.error('Erreur lors de la récupération des informations de l\'offre de stage.');
                        }
                    }
                };
                xhr.send('id_offre_stage=' + idOffreStage);
            });
        </script>

        <script src="assets/js/main.js"></script>
        <?php require_once 'footer.php';?> 
    </body>
</html>
