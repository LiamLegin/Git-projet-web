<?php

require_once 'config.php';

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */
$postData = $_POST;

if (
    !isset($postData['id_enseignant'])
    || !is_numeric($postData['id_enseignant'])
    || empty($postData['nom_enseignant'])
    || empty($postData['prenom_enseignant'])
    || empty($postData['tel_enseignant'])
    || empty($postData['email'])
    || empty($postData['password'])
    || trim(strip_tags($postData['nom_enseignant'])) === ''
    || trim(strip_tags($postData['prenom_enseignant'])) === ''
    || trim(strip_tags($postData['tel_enseignant'])) === ''
    || trim(strip_tags($postData['email'])) === ''
    || trim(strip_tags($postData['password'])) === ''
) {
    echo 'Il manque des informations pour permettre l\'édition de l\'enseignant•e.';
    return;
}

$id_enseignant = (int)$postData['id_enseignant'];
$nom_enseignant = trim(strip_tags($postData['nom_enseignant']));
$prenom_enseignant = trim(strip_tags($postData['prenom_enseignant']));
$promo_enseignant = $postData['promo_enseignant'];
$date_debut_pilotage = trim(strip_tags($postData['date_debut_pilotage']));
$date_fin_pilotage = trim(strip_tags($postData['date_fin_pilotage']));
$campus_enseignant = $postData['campus_enseignant'];
$tel_enseignant = trim(strip_tags($postData['tel_enseignant']));
$email = trim(strip_tags($postData['email']));
$password = trim(strip_tags($postData['password']));

// Vérifier si une promotion est sélectionnée
if ($promo_enseignant !== "") {
    // Si une promotion est sélectionnée, vérifier que la date de début de pilotage est antérieure à la date de fin de pilotage
    if ($date_debut_pilotage >= $date_fin_pilotage) {
        echo "La date de début de pilotage doit être antérieure à la date de fin de pilotage.";
        return;
    }
}

// Si l'option "Pas de changement de campus" a été sélectionnée
if ($campus_enseignant === "") {
    // Récupérer le campus actuellement attribué à l'enseignant dans la base de données
    $requeteCampusActuel = $mysqlClient->prepare('
        SELECT campus.id_campus
        FROM etre_localiser
        INNER JOIN campus ON etre_localiser.id_campus = campus.id_campus
        WHERE etre_localiser.id_enseignant = :id_enseignant
    ');
    $requeteCampusActuel->execute(['id_enseignant' => $id_enseignant]);
    $campus_actuel = $requeteCampusActuel->fetchColumn();

    // Définir le campus actuel comme campus sélectionné
    $campus_enseignant = $campus_actuel;
}

$requetePiloteInsertion = $mysqlClient->prepare('
    UPDATE utilisateur
    JOIN enseignant ON utilisateur.id_utilisateur = enseignant.id_utilisateur
    LEFT JOIN piloter ON enseignant.id_enseignant = piloter.id_enseignant 
    LEFT JOIN promo ON piloter.id_promo = promo.id_promo
    LEFT JOIN etre_localiser ON enseignant.id_enseignant = etre_localiser.id_enseignant
    LEFT JOIN campus ON etre_localiser.id_campus = campus.id_campus
    SET 
        utilisateur.email = :email, 
        utilisateur.mdp = SHA2(:password, 256),
        enseignant.nom_enseignant = :nomEnseignant,
        enseignant.prenom_enseignant = :prenomEnseignant, 
        enseignant.telephone_enseignant = :telEnseignant,
        etre_localiser.id_campus = :id_campus,
        piloter.id_promo = :id_promo,
        piloter.date_debut_pilotage = :dateDebutPilotage,
        piloter.date_fin_pilotage = :dateFinPilotage
    WHERE enseignant.id_enseignant = :id_enseignant
');

$requetePiloteInsertion->execute([
    'id_enseignant' => $id_enseignant,
    'nomEnseignant' => $nom_enseignant,
    'prenomEnseignant' => $prenom_enseignant,
    'id_promo' => $promo_enseignant,
    'dateDebutPilotage' => $date_debut_pilotage,
    'dateFinPilotage' => $date_fin_pilotage,
    'id_campus' => $campus_enseignant,
    'telEnseignant' => $tel_enseignant,
    'email' => $email,
    'password' => $password,
]);

header('Location: gestionEnseignants.php');
exit();
?>
