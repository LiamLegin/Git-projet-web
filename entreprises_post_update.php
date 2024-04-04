<?php
include 'config.php';

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */

$postData = $_POST;
// Vérification du formulaire soumis
if (
    !isset($postData['id_entreprise'])
    || !is_numeric($postData['id_entreprise'])
    || empty($postData['nom_entreprise'])
    || empty($postData['logo_entreprise'])
    || empty($postData['adresse_entreprise'])
    || trim(strip_tags($postData['nom_entreprise'])) === ''
    || trim(strip_tags($postData['logo_entreprise'])) === ''
    || trim(strip_tags($postData['adresse_entreprise'])) === ''
) {
    echo 'Tous les champs ne sont pas remplis.';
    return;
}

$id_entreprise = (int)$postData['id_entreprise'];
$nom_entreprise= trim(strip_tags($postData['nom_entreprise']));
$logo_entreprise = trim(strip_tags($postData['logo_entreprise']));
$secteur_activite = $postData['secteur_activite'];
$adresse_entreprise = trim(strip_tags($postData['adresse_entreprise']));
$ville_entreprise = $postData['ville_entreprise'];

// Faire l'insertion en base
$requeteEntrepriseModif = $mysqlClient->prepare('
    UPDATE entreprise
    INNER JOIN posseder ON entreprise.id_entreprise = posseder.id_entreprise
    INNER JOIN secteur_activite ON posseder.id_secteur_activite = secteur_activite.id_secteur_activite
    INNER JOIN adresse ON entreprise.id_entreprise = adresse.id_entreprise
    SET
        entreprise.nom_entreprise = :nomEntreprise,
        entreprise.logo_entreprise = :logoEntreprise,
        posseder.id_secteur_activite = :secteurActivite,
        adresse.nom_rue = :adresseEntreprise,
        adresse.id_ville = :villeEntreprise
    WHERE entreprise.id_entreprise = :id_entreprise;
');

$requeteEntrepriseModif->execute([
    'id_entreprise' => $id_entreprise,
    'nomEntreprise' => $nom_entreprise,
    'logoEntreprise' => $logo_entreprise,
    'secteurActivite' => $secteur_activite,
    'adresseEntreprise' => $adresse_entreprise,
    'villeEntreprise' => $ville_entreprise,
]);

header('Location: gestionEntreprises.php');
exit();
?>