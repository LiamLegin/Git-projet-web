<?php include 'authAdmin.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression d'entreprise</title>
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/css/nav.css" rel="stylesheet">
    <link href="assets/css/gestion.css" rel="stylesheet">
</head>
<body>
    <?php 
    require_once 'config.php';
    require_once 'header.php';
    ?>

    <h1>Supprimer une entreprise</h1>
    <div class="button-container">
        <button class="button-gestion" onclick="window.location.href='gestionEntreprises.php'">Retour</button>
    </div>

    <h2>Pensez à vérifier les informations correspondantes</h2>
    <form action="entreprises_post_delete.php" method="POST" id="deleteForm">
        <label for="id_entreprise">Numéro d'identification de l'entreprise à supprimer</label><br>
        <input type="number" id="id_entreprise" name="id_entreprise">

        <br>

        <div>
            <label for="nom_entreprise">Nom de l'entreprise à supprimer</label>
            <input type="text" id="nom_entreprise" name="nom_entreprise" readonly>
        </div>

        <br>

        <div>
            <label for="logo_entreprise">Lien du logo de l'entreprise à supprimer</label>
            <input type="text" id="logo_entreprise" name="logo_entreprise" readonly>
        </div>

        <br>

        <div>
            <label for="ville_entreprise">Ville de l'entreprise à supprimer</label>
            <input type="text" id="ville_entreprise" name="ville_entreprise" readonly>
        </div>

        
        <button type="submit" class="button-gestion">Valider la suppression</button>
    </form>

    <script>
        document.getElementById('id_entreprise').addEventListener('change', function() {
            var idEntreprise = this.value;

            // Envoyer une requête AJAX pour récupérer les informations de l'entreprise à supprimer
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fetch_entreprise_info.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var entrepriseInfo = JSON.parse(xhr.responseText);
                        // Mettre à jour les champs du formulaire avec les informations récupérées
                        document.getElementById('nom_entreprise').value = entrepriseInfo.nom_entreprise || 'Non associé';
                        document.getElementById('logo_entreprise').value = entrepriseInfo.logo_entreprise || 'Non associé';
                        document.getElementById('ville_entreprise').value = entrepriseInfo.nom_rue || 'Non associée';
                    } else {
                        console.error('Erreur lors de la récupération des informations de l\'entreprise.');
                    }
                }
            };
            xhr.send('id_entreprise=' + idEntreprise);
        });
    </script>

<script src="assets/js/main.js"></script>
    <?php require_once 'footer.php';?> 
</body>
</html>
