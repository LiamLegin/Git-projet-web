<?php

require_once 'config.php';

// Vérifiez si l'identifiant de l'entreprise est envoyé via POST
if (isset($_POST['id_entreprise'])) {
    // Récupérer l'identifiant de l'entreprise
    $id_entreprise = intval($_POST['id_entreprise']);

    // Préparez la requête SQL pour récupérer les informations de l'entreprise
    $fetchQuery = $mysqlClient->prepare('
        SELECT * 
        FROM entreprise 
        INNER JOIN posseder ON entreprise.id_entreprise = posseder.id_entreprise
        INNER JOIN adresse ON entreprise.id_entreprise = adresse.id_entreprise
        WHERE entreprise.id_entreprise = :id_entreprise;
    ');
    $fetchQuery->execute(['id_entreprise' => $id_entreprise]);

    // Vérifiez si des données ont été récupérées
    if ($entrepriseData = $fetchQuery->fetch(PDO::FETCH_ASSOC)) {
        // Convertissez les données en JSON et renvoyez-les
        echo json_encode($entrepriseData);
    } else {
        // Si l'entreprise n'est pas trouvé, renvoyez une réponse vide
        echo json_encode(array('error' => 'entreprise non trouvé'));
    }
} else {
    // Si l'identifiant de l'entreprise n'est pas envoyé, renvoyez une réponse vide
    echo json_encode(array('error' => 'Identifiant de l\'entreprise non fourni'));
}
?>