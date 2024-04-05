<?php
include 'config.php';

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */

$postData = $_POST;
// Vérification du formulaire soumis
if (
    !isset($postData['id_offre_stage'])
    || !is_numeric($postData['id_offre_stage'])
    || empty($postData['nom_offre_stage'])
    || empty($postData['description_stage'])
    || empty($postData['duree_mois'])
    || empty($postData['salaire_euro'])
    || empty($postData['places_offertes'])
    || empty($postData['date_debut_prevu'])
    || empty($postData['date_fin_prevu'])
    || empty($postData['competences_requises'])
    || trim(strip_tags($postData['nom_offre_stage'])) === ''
    || trim(strip_tags($postData['description_stage'])) === ''
    || trim(strip_tags($postData['duree_mois'])) === ''
    || trim(strip_tags($postData['salaire_euro'])) === ''
    || trim(strip_tags($postData['places_offertes'])) === ''
    || trim(strip_tags($postData['date_debut_prevu'])) === ''
    || trim(strip_tags($postData['date_fin_prevu'])) === ''
    || trim(strip_tags($postData['competences_requises'])) === ''
) {
    echo 'Tous les champs ne sont pas remplis.';
    return;
}

$id_offre_stage = (int)$postData['id_offre_stage'];
$id_administrateur = $postData['id_administrateur'];
$nom_offre_stage = trim(strip_tags($postData['nom_offre_stage']));
$description_stage = trim(strip_tags($postData['description_stage']));
$duree_mois = trim(strip_tags($postData['duree_mois']));
$salaire_euro = trim(strip_tags($postData['salaire_euro']));
$places_offertes = trim(strip_tags($postData['places_offertes']));
$date_debut_prevu = trim(strip_tags($postData['date_debut_prevu']));
$date_fin_prevu = trim(strip_tags($postData['date_fin_prevu']));
$competences_requises = $postData['competences_requises'];

// Faire l'insertion en base
$requeteEntrepriseModif = $mysqlClient->prepare('
    UPDATE offre_stage
    INNER JOIN administrateur ON offre_stage.id_administrateur = administrateur.id_administrateur
    INNER JOIN exiger ON offre_stage.id_offre_stage = exiger.id_offre_stage
    INNER JOIN entreprise ON offre_stage.id_entreprise = entreprise.id_entreprise
    INNER JOIN adresse ON entreprise.id_entreprise = adresse.id_entreprise
    SET
        offre_stage.nom_offre_stage = :nomOffreStage,
        offre_stage.description_stage = :description,
        offre_stage.duree_mois = :duree,
        offre_stage.salaire_euro = :salaire,
        offre_stage.places_offertes = :places,
        offre_stage.date_debut_prevu = :date_debut_prevu,
        offre_stage.date_fin_prevu = :date_fin_prevu,
        offre_stage.id_administrateur = :id_administrateur,
        exiger.id_competence = :id_competence
    WHERE offre_stage.id_offre_stage = :id_offre_stage
');

$requeteEntrepriseModif->execute([
    'id_offre_stage' => $id_offre_stage,
    'id_administrateur' => $id_administrateur,
    'nomOffreStage' => $nom_offre_stage,
    'description' => $description_stage,
    'duree' => $duree_mois,
    'salaire' => $salaire_euro,
    'places' => $places_offertes,
    'date_debut_prevu' => $date_debut_prevu,
    'date_fin_prevu' => $date_fin_prevu,
    'id_competence' => $competences_requises
]);


header('Location: gestionStages.php');
exit();
?>