<?php

require_once 'config.php';

// Vérifiez si l'identifiant de l'étudiant est envoyé via POST
if (isset($_POST['id_etudiant'])) {
    // Récupérer l'identifiant de l'étudiant
    $id_etudiant = intval($_POST['id_etudiant']);

    // Préparez la requête SQL pour récupérer les informations de l'étudiant
    $fetchQuery = $mysqlClient->prepare('
        SELECT *
        FROM utilisateur 
        JOIN etudiant ON utilisateur.id_utilisateur = etudiant.id_utilisateur
        LEFT JOIN adresse ON etudiant.id_etudiant = adresse.id_etudiant
        LEFT JOIN composer ON etudiant.id_etudiant = composer.id_etudiant
        LEFT JOIN promo ON composer.id_promo = promo.id_promo
        LEFT JOIN piloter ON promo.id_promo = piloter.id_promo
        RIGHT JOIN enseignant ON piloter.id_enseignant = enseignant.id_enseignant
        LEFT JOIN etre_localiser ON enseignant.id_enseignant = etre_localiser.id_enseignant
        LEFT JOIN campus ON etre_localiser.id_campus = campus.id_campus
        WHERE utilisateur.id_utilisateur IN (SELECT id_etudiant FROM etudiant WHERE id_etudiant = :id_etudiant);
    ');
    $fetchQuery->execute(['id_etudiant' => $id_etudiant]);

    // Vérifiez si des données ont été récupérées
    if ($etudiantData = $fetchQuery->fetch(PDO::FETCH_ASSOC)) {
        // Convertissez les données en JSON et renvoyez-les
        echo json_encode($etudiantData);
    } else {
        // Si l'étudiant n'est pas trouvé, renvoyez une réponse vide
        echo json_encode(array('error' => 'Étudiant non trouvé'));
    }
} else {
    // Si l'identifiant de l'étudiant n'est pas envoyé, renvoyez une réponse vide
    echo json_encode(array('error' => 'Identifiant de l\'étudiant non fourni'));
}
?>
