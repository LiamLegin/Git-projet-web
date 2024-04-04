<?php
require_once 'config.php';

$requete = "SELECT * FROM utilisateur JOIN enseignant ON utilisateur.id_utilisateur = enseignant.id_utilisateur";


$etat = $mysqlClient->prepare($requete);
$etat->execute();

$colonne = $etat->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page pour la BDD</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <nav>
            <a href="pilotes_create.html">Ajouter un pilote</a><br>
            <a href="pilotes_update.html">Mettre à jour un pilote</a><br>
            <a href="pilotes_delete.html">Supprimer un pilote</a>
        </nav>

        <h1>Les pilotes et leurs nationalités</h1>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($colonne as $jointure) {
                    echo "<tr>";
                    echo "<td>". $jointure['nom_enseignant']. "</td>";
                    echo "<td>". $jointure['prenom_enseignant']. "</td>";
                    echo "<td>" . $jointure['email']. "</td>";

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </body>
</html>