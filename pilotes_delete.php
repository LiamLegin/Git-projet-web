<?php include 'authAdmin.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression d'enseignant•e</title>
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/css/nav.css" rel="stylesheet">
    <link href="assets/css/gestion.css" rel="stylesheet">
</head>
<body>
    <?php 
    require_once 'config.php';
    require_once 'header.php';
    ?>

    <h1>Supprimer un enseignant•e</h1>
    <div class="button-container">
        <button class="button-gestion" onclick="window.location.href='gestionEnseignants.php'">Retour</button>
    </div>

    <h2>Pensez à vérifier les informations correspondantes</h2>
    <form action="pilotes_post_delete.php" method="POST" id="deleteForm">
        <label for="id_enseignant">Numéro d'identification de l'enseignant•e à supprimer</label><br>
        <input type="number" id="id_enseignant" name="id_enseignant">

        <br>

        <div>
            <label for="nom_enseignant">Nom de l'enseignant•e à supprimer</label>
            <input type="text" id="nom_enseignant" name="nom_enseignant" readonly>
        </div>

        <br>

        <div>
            <label for="prenom_enseignant">Prénom de l'enseignant•e à supprimer</label>
            <input type="text" id="prenom_enseignant" name="prenom_enseignant" readonly>
        </div>

        <br>

        <div>
            <label for="promo_enseignant">Promo de l'enseignant•e à supprimer</label>
            <input type="text" id="promo_enseignant" name="promo_enseignant" readonly>
        </div>

        <br>

        <div>
            <label for="campus_enseignant">Campus où se trouve l'enseignant•e à supprimer</label>
            <input type="text" id="campus_enseignant" name="campus_enseignant" readonly>
        </div>

        <br>

        <div>
            <label for="tel">Numéro de téléphone de l'enseignant•e à supprimer</label><br>
            <input type="tel" id="tel" name="tel" readonly>
        </div>

        <br>

        <div>
            <label for="email">Email de l'enseignant•e à supprimer</label>
            <input type="email" id="email" name="email" readonly>
        </div>

        <br>

        <button type="submit">Valider la suppression</button>
    </form>

    <script>
        document.getElementById('id_enseignant').addEventListener('change', function() {
            var idEnseignant = this.value;

            // Envoyer une requête AJAX pour récupérer les informations de l'enseignant à supprimer
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fetch_enseignant_info.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var enseignantInfo = JSON.parse(xhr.responseText);
                        // Mettre à jour les champs du formulaire avec les informations récupérées
                        document.getElementById('nom_enseignant').value = enseignantInfo.nom_enseignant || 'Non associé';
                        document.getElementById('prenom_enseignant').value = enseignantInfo.prenom_enseignant || 'Non associé';
                        document.getElementById('promo_enseignant').value = enseignantInfo.nom_promo || 'Non associée';
                        document.getElementById('campus_enseignant').value = enseignantInfo.nom_campus || 'Non associé';
                        document.getElementById('tel').value = enseignantInfo.telephone_enseignant || 'Non associé';
                        document.getElementById('email').value = enseignantInfo.email || 'Non associé';
                    } else {
                        console.error('Erreur lors de la récupération des informations de l\'enseignant.');
                    }
                }
            };
            xhr.send('id_enseignant=' + idEnseignant);
        });
    </script>

<script src="assets/js/main.js"></script>
    <?php require_once 'footer.php';?> 
</body>
</html>
