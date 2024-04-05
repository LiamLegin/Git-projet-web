<?php

require_once 'config.php';

// Vérifiez si l'identifiant de l'offre de stage est envoyé via POST
if (isset($_POST['id_offre_stage'])) {
    // Récupérer l'identifiant de l'offre de stage
    $id_offre_stage = intval($_POST['id_offre_stage']);

    // Préparez la requête SQL pour récupérer les informations de l'offre de stage
    $fetchQuery = $mysqlClient->prepare('
        SELECT * 
        FROM offre_stage
        INNER JOIN administrateur ON offre_stage.id_administrateur = administrateur.id_administrateur
        INNER JOIN exiger ON offre_stage.id_offre_stage = exiger.id_offre_stage
        INNER JOIN entreprise ON offre_stage.id_entreprise = entreprise.id_entreprise
        WHERE offre_stage.id_offre_stage = :id_offre_stage;
    ');
    $fetchQuery->execute(['id_offre_stage' => $id_offre_stage]);

    // Vérifiez si des données ont été récupérées
    if ($stageData = $fetchQuery->fetch(PDO::FETCH_ASSOC)) {
        // Convertissez les données en JSON et renvoyez-les
        echo json_encode($stageData);
    } else {
        // Si l'offre de stage n'est pas trouvé, renvoyez une réponse vide
        echo json_encode(array('error' => 'offre de stage non trouvé'));
    }
} else {
    // Si l'identifiant de l'offre de stage n'est pas envoyé, renvoyez une réponse vide
    echo json_encode(array('error' => 'Identifiant de l\'offre de stage non fourni'));
}
?>
