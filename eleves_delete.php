<?php include 'authEns.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression d'étudiant•e</title>
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/css/nav.css" rel="stylesheet">
    <link href="assets/css/gestion.css" rel="stylesheet">
</head>
<body>
    <?php 
    require_once 'config.php';
    require_once 'header.php';
    ?>

    <h1>Supprimer un étudiant•e</h1>
    <div class="button-container">
        <button class="button-gestion" onclick="window.location.href='gestionEleves.php'">Retour</button>
    </div>

    <h2>Pensez à vérifier les informations correspondantes</h2>
    <form action="eleves_post_delete.php" method="POST" id="deleteForm">
        <label for="id_etudiant">Numéro d'identification de l'étudiant•e à supprimer</label>
        <input type="number" id="id_etudiant" name="id_etudiant">

        <br>

        <div>
            <label for="nom_etudiant">Nom de l'étudiant•e à supprimer</label>
            <input type="text" id="nom_etudiant" name="nom_etudiant" readonly>
        </div>

        <br>

        <div>
            <label for="prenom_etudiant">Prénom de l'étudiant•e à supprimer</label>
            <input type="text" id="prenom_etudiant" name="prenom_etudiant" readonly>
        </div>

        <br>

        <div>
            <label for="date_naissance">Date de naissance de l'étudiant•e à supprimer</label>
            <input type="date" id="date_naissance" name="date_naissance" readonly>
        </div>

        <br>

        <div>
            <label for="adresse_etudiant">Adresse de l'étudiant•e à supprimer</label>
            <input type="text" id="adresse_etudiant" name="adresse_etudiant" readonly>
        </div>

        <div>
            <label for="promo_etudiant">Promo de l'étudiant•e à supprimer</label>
            <input type="text" id="promo_etudiant" name="promo_etudiant" readonly>
        </div>

        <br>

        <div>
            <label for="campus_etudiant">Campus où se trouve l'étudiant•e à supprimer</label>
            <input type="text" id="campus_etudiant" name="campus_etudiant" readonly>
        </div>

        <br>

        <div>
            <label for="tel">Numéro de téléphone de l'étudiant•e à supprimer</label>
            <input type="tel" id="tel" name="tel" readonly>
        </div>

        <br>

        <div>
            <label for="email">Email de l'étudiant•e à supprimer</label>
            <input type="email" id="email" name="email" readonly>
        </div>

        <br>

        <button type="submit">Valider la suppression</button>
    </form>

    <script>
        document.getElementById('id_etudiant').addEventListener('change', function() {
            var idEtudiant = this.value;

            // Envoyer une requête AJAX pour récupérer les informations de l'étudiant à supprimer
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fetch_etudiant_info.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var etudiantInfo = JSON.parse(xhr.responseText);
                        // Mettre à jour les champs du formulaire avec les informations récupérées
                        document.getElementById('nom_etudiant').value = etudiantInfo.nom_etudiant || 'Non associé';
                        document.getElementById('prenom_etudiant').value = etudiantInfo.prenom_etudiant || 'Non associé';
                        document.getElementById('date_naissance').value = etudiantInfo.date_naissance_etudiant || "Non associée";
                        document.getElementById('adresse_etudiant').value = etudiantInfo.nom_rue || "Non associée";
                        document.getElementById('promo_etudiant').value = etudiantInfo.nom_promo || 'Non associée';
                        document.getElementById('campus_etudiant').value = etudiantInfo.nom_campus || 'Non associé';
                        document.getElementById('tel').value = etudiantInfo.telephone_etudiant || 'Non associé';
                        document.getElementById('email').value = etudiantInfo.email || 'Non associé';
                    } else {
                        console.error('Erreur lors de la récupération des informations de l\'étudiant.');
                    }
                }
            };
            xhr.send('id_etudiant=' + idEtudiant);
        });
    </script>


    <?php require_once 'footer.php';?> 
    <script src="assets/js/main.js"></script>
</body>
</html>
