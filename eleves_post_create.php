<?php
include 'config.php';

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */

$postData = $_POST;
// Vérification du formulaire soumis
if (
    empty($postData['nom_etudiant'])
    || empty($postData['prenom_etudiant'])
    || empty($postData['date_naissance'])
    || empty($postData['adresse_etudiant'])
    || empty($postData['date_debut_etudes'])
    || empty($postData['date_fin_etudes'])
    || empty($postData['tel_etudiant'])
    || empty($postData['email'])
    || empty($postData['password'])
    || trim(strip_tags($postData['nom_etudiant'])) === ''
    || trim(strip_tags($postData['prenom_etudiant'])) === ''
    || trim(strip_tags($postData['date_naissance'])) === ''
    || trim(strip_tags($postData['adresse_etudiant'])) === ''
    || trim(strip_tags($postData['date_debut_etudes'])) === ''
    || trim(strip_tags($postData['date_fin_etudes'])) === ''
    || trim(strip_tags($postData['tel_etudiant'])) === ''
    || trim(strip_tags($postData['email'])) === ''
    || trim(strip_tags($postData['password'])) === ''
) {
    echo 'Tous les champs ne sont pas remplis.';
    return;
}

$nom_etudiant = trim(strip_tags($postData['nom_etudiant']));
$prenom_etudiant = trim(strip_tags($postData['prenom_etudiant']));
$date_naissance = trim(strip_tags($postData['date_naissance']));
$adresse_etudiant = trim(strip_tags($postData['adresse_etudiant']));
$ville_etudiant = $postData['ville_etudiant'];
$promo_etudiant = $postData['promo_etudiant'];
$date_debut_etudes = trim(strip_tags($postData['date_debut_etudes']));
$date_fin_etudes = trim(strip_tags($postData['date_fin_etudes']));
$campus_etudiant = $postData['campus_etudiant'];
$enseignant = $postData['enseignant'];
$tel_etudiant = trim(strip_tags($postData['tel_etudiant']));
$email = trim(strip_tags($postData['email']));
$password = trim(strip_tags($postData['password']));

// Vérifier que la date de début de l'année est antérieure à la date de fin de l'année
if ($date_debut_etudes >= $date_fin_etudes) {
    echo "La date de début de l'année doit être antérieure à la date de fin de l'année.";
    return;
}

// Faire l'insertion en base
$requeteEleveCreation = $mysqlClient->prepare('
    START TRANSACTION;
    
    INSERT INTO utilisateur (email, mdp) 
    VALUES (:email, SHA2(:password, 256));
    SET @id_utilisateur = LAST_INSERT_ID();
    
    INSERT INTO etudiant (nom_etudiant, prenom_etudiant, date_naissance_etudiant, telephone_etudiant, id_utilisateur)
    VALUES (:nomEtudiant, :prenomEtudiant, :dateNaissance, :telEtudiant, @id_utilisateur);
    SET @id_etudiant = LAST_INSERT_ID();

    INSERT INTO composer (id_promo, id_etudiant, date_debut_etudes, date_fin_etudes)
    VALUES (:id_promo, @id_etudiant, :dateDebutEtudes, :dateFinEtudes);

    INSERT INTO piloter(id_enseignant, id_promo, date_debut_pilotage, date_fin_pilotage)
    VALUES (:id_enseignant, :id_promo, :dateDebutEtudes, :dateFinEtudes);

    INSERT INTO etre_localiser (id_campus, id_enseignant)
    VALUES (:id_campus, :id_enseignant);

    INSERT INTO adresse(nom_rue, id_etudiant, id_ville)
    VALUES (:nomRue, @id_etudiant, :id_ville);

    COMMIT;
');

$requeteEleveCreation->execute([
    'nomEtudiant' => $nom_etudiant,
    'prenomEtudiant' => $prenom_etudiant,
    'dateNaissance' => $date_naissance,
    'nomRue' => $adresse_etudiant,
    'id_ville' => $ville_etudiant,
    'id_promo' => $promo_etudiant,
    'dateDebutEtudes' => $date_debut_etudes,
    'dateFinEtudes' => $date_fin_etudes,
    'dateDebut' => $date_debut_etudes,
    'id_campus' => $campus_etudiant,
    'id_enseignant' => $enseignant,
    'telEtudiant' => $tel_etudiant,
    'email' => $email,
    'password' => $password,
]);

header('Location: gestionEleves.php');
exit();
?>
