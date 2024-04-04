<?php

require_once 'config.php';

// Vérifiez si l'identifiant de l'enseignant est envoyé via POST
if (isset($_POST['id_enseignant'])) {
    // Récupérer l'identifiant de l'enseignant
    $id_enseignant = intval($_POST['id_enseignant']);

    // Préparez la requête SQL pour récupérer les informations de l'enseignant
    $fetchQuery = $mysqlClient->prepare('SELECT * FROM utilisateur JOIN enseignant ON utilisateur.id_utilisateur = enseignant.id_utilisateur WHERE utilisateur.id_utilisateur = :id_enseignant');
    $fetchQuery->execute(['id_enseignant' => $id_enseignant]);

    // Vérifiez si des données ont été récupérées
    if ($enseignantData = $fetchQuery->fetch(PDO::FETCH_ASSOC)) {
        // Convertissez les données en JSON et renvoyez-les
        echo json_encode($enseignantData);
    } else {
        // Si l'enseignant n'est pas trouvé, renvoyez une réponse vide
        echo json_encode(array('error' => 'Enseignant non trouvé'));
    }
} else {
    // Si l'identifiant de l'enseignant n'est pas envoyé, renvoyez une réponse vide
    echo json_encode(array('error' => 'Identifiant de l\'enseignant non fourni'));
}
?>
