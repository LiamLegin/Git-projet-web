<?php
include 'config.php';

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */

$postData = $_POST;
// Vérification du formulaire soumis
if (
    empty($postData['nom_enseignant'])
    || empty($postData['prenom_enseignant'])
    || empty($postData['dateDebut'])
    || empty($postData['tel_enseignant'])
    || empty($postData['email'])
    || empty($postData['password'])
    || trim(strip_tags($postData['nom_enseignant'])) === ''
    || trim(strip_tags($postData['prenom_enseignant'])) === ''
    || trim(strip_tags($postData['dateDebut'])) === ''
    || trim(strip_tags($postData['tel_enseignant'])) === ''
    || trim(strip_tags($postData['email'])) === ''
    || trim(strip_tags($postData['password'])) === ''
) {
    echo 'Tous les champs ne sont pas remplis.';
    return;
}

$nom_enseignant = trim(strip_tags($postData['nom_enseignant']));
$prenom_enseignant = trim(strip_tags($postData['prenom_enseignant']));
$date_debut = trim(strip_tags($postData['dateDebut']));
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

// Faire l'insertion en base
$requetePiloteCreation = $mysqlClient->prepare('
    START TRANSACTION;
    
    INSERT INTO utilisateur (email, mdp) 
    VALUES (:email, SHA2(:password, 256));
    SET @id_utilisateur = LAST_INSERT_ID();
    
    INSERT INTO enseignant (nom_enseignant, prenom_enseignant, telephone_enseignant, id_utilisateur) 
    VALUES (:nomEnseignant, :prenomEnseignant, :telEnseignant, @id_utilisateur);
    SET @id_enseignant = LAST_INSERT_ID();

    INSERT INTO piloter (id_promo, id_enseignant, date_debut_pilotage, date_fin_pilotage)
    VALUES (:id_promo, @id_enseignant, :dateDebutPilotage, :dateFinPilotage);

    INSERT INTO etre_localiser (id_campus, id_enseignant, date_debut)
    VALUES (:id_campus, @id_enseignant, :dateDebut);

    COMMIT;
');

$requetePiloteCreation->execute([
    'nomEnseignant' => $nom_enseignant,
    'prenomEnseignant' => $prenom_enseignant,
    'dateDebut' => $date_debut,
    'id_promo' => $promo_enseignant,
    'dateDebutPilotage' => $date_debut_pilotage,
    'dateFinPilotage' => $date_fin_pilotage,
    'dateDebut' => $date_debut_pilotage,
    'id_campus' => $campus_enseignant,
    'telEnseignant' => $tel_enseignant,
    'email' => $email,
    'password' => $password,
]);

header('Location: gestionEnseignants.php');
exit();
?>
