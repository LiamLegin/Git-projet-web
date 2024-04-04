<?php
include 'config.php';

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */

$postData = $_POST;
// Vérification du formulaire soumis
if (
    empty($postData['nom_offre_stage'])
    || empty($postData['description_stage'])
    || empty($postData['duree_mois'])
    || empty($postData['salaire_euro'])
    || empty($postData['places_offertes'])
    || empty($postData['date_publication'])
    || empty($postData['date_debut_prevu'])
    || empty($postData['date_fin_prevu'])
    || empty($postData['competences_requises'])
    || trim(strip_tags($postData['nom_offre_stage'])) === ''
    || trim(strip_tags($postData['description_stage'])) === ''
    || trim(strip_tags($postData['duree_mois'])) === ''
    || trim(strip_tags($postData['salaire_euro'])) === ''
    || trim(strip_tags($postData['places_offertes'])) === ''
    || trim(strip_tags($postData['date_publication'])) === ''
    || trim(strip_tags($postData['date_debut_prevu'])) === ''
    || trim(strip_tags($postData['date_fin_prevu'])) === ''
    || trim(strip_tags($postData['competences_requises'])) === ''
) {
    echo 'Tous les champs ne sont pas remplis.';
    return;
}

$id_enseignant = $postData['id_enseignant'];
$id_administrateur = $postData['id_administrateur'];
$id_entreprise = $postData['id_entreprise'];
$nom_offre_stage = trim(strip_tags($postData['nom_offre_stage']));
$description_stage = trim(strip_tags($postData['description_stage']));
$duree_mois = trim(strip_tags($postData['duree_mois']));
$salaire_euro = trim(strip_tags($postData['salaire_euro']));
$places_offertes = trim(strip_tags($postData['places_offertes']));
$date_publication = trim(strip_tags($postData['date_publication']));
$date_debut_prevu = trim(strip_tags($postData['date_debut_prevu']));
$date_fin_prevu = trim(strip_tags($postData['date_fin_prevu']));
$competences_requises = $postData['competences_requises'];

// Faire l'insertion en base
$requeteEntrepriseCreation = $mysqlClient->prepare('
    START TRANSACTION;
    
    INSERT INTO offre_stage (nom_offre_stage, description_stage, duree_mois, salaire_euro, places_offertes, date_publication, date_debut_prevu, 
    date_fin_prevu, id_administrateur, id_entreprise, id_enseignant)

    VALUES (:nomOffreStage, :description, :duree, :salaire, :places, :date_publication, :date_debut_prevu, :date_fin_prevu, :id_administrateur, 
    :id_entreprise, :id_enseignant);

    SET @id_offre_stage = LAST_INSERT_ID();

    INSERT INTO exiger (id_offre_stage, id_competence)
    VALUES (@id_offre_stage, :id_competence);

    COMMIT;
');

$requeteEntrepriseCreation->execute([
    'id_enseignant' => $id_enseignant,
    'id_administrateur' => $id_administrateur,
    'id_entreprise' => $id_entreprise,
    'nomOffreStage' => $nom_offre_stage,
    'description' => $description_stage,
    'duree' => $duree_mois,
    'salaire' => $salaire_euro,
    'places' => $places_offertes,
    'date_publication' => $date_publication,
    'date_debut_prevu' => $date_debut_prevu,
    'date_fin_prevu' => $date_fin_prevu,
    'id_competence' => $competences_requises
]);

header('Location: gestionStages.php');
exit();
?>
