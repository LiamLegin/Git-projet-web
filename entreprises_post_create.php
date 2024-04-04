<?php
include 'config.php';

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */

$postData = $_POST;
// Vérification du formulaire soumis
if (
    empty($postData['nom_entreprise'])
    || empty($postData['logo_entreprise'])
    || empty($postData['adresse_entreprise'])
    || trim(strip_tags($postData['nom_entreprise'])) === ''
    || trim(strip_tags($postData['logo_entreprise'])) === ''
    || trim(strip_tags($postData['adresse_entreprise'])) === ''
) {
    echo 'Tous les champs ne sont pas remplis.';
    return;
}

$nom_entreprise= trim(strip_tags($postData['nom_entreprise']));
$logo_entreprise = trim(strip_tags($postData['logo_entreprise']));
$secteur_activite = $postData['secteur_activite'];
$adresse_entreprise = trim(strip_tags($postData['adresse_entreprise']));
$ville_entreprise = trim(strip_tags($postData['ville_entreprise']));

// Faire l'insertion en base
$requetePiloteCreation = $mysqlClient->prepare('
    START TRANSACTION;
    
    INSERT INTO entreprise (nom_entreprise, logo_entreprise)
    VALUES (:nomEntreprise, :logoEntreprise);
    SET @id_entreprise = LAST_INSERT_ID();

    INSERT INTO posseder (id_entreprise, id_secteur_activite)
    VALUES (@id_entreprise, :secteurActivite);

    INSERT INTO adresse (nom_rue, id_entreprise, id_ville)
    VALUES (:nomRue, @id_entreprise, :id_ville);

    COMMIT;
');

$requetePiloteCreation->execute([
    'nomEntreprise' => $nom_entreprise,
    'logoEntreprise' => $logo_entreprise,
    'secteurActivite' => $secteur_activite,
    'nomRue' => $adresse_entreprise,
    'id_ville' => $ville_entreprise,
]);

header('Location: gestionEntreprises.php');
exit();
?>
