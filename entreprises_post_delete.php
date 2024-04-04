<?php
require_once 'config.php';
/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */
$postData = $_POST;

if (!isset($postData['id_entreprise']) || !is_numeric($postData['id_entreprise'])) {
    echo 'Il faut un identifiant valide pour supprimer une entreprise.';
    return;
}

$id_entreprise = (int)$postData['id_entreprise'];

$requetePiloteSuppresion = $mysqlClient->prepare('
    START TRANSACTION;

    SET @id_entreprise = :id_entreprise;

    DELETE FROM candidater WHERE id_offre_stage IN  (SELECT id_offre_stage FROM offre_stage WHERE id_entreprise = @id_entreprise);
    DELETE FROM exiger WHERE id_offre_stage IN  (SELECT id_offre_stage FROM offre_stage WHERE id_entreprise = @id_entreprise);
    DELETE FROM gerer WHERE id_offre_stage IN  (SELECT id_offre_stage FROM offre_stage WHERE id_entreprise = @id_entreprise);
    DELETE FROM offre_stage WHERE id_entreprise = @id_entreprise;
    DELETE FROM evaluation_etudiant WHERE id_entreprise = @id_entreprise;
    DELETE FROM evaluation_enseignant WHERE id_entreprise = @id_entreprise;
    DELETE FROM posseder WHERE id_entreprise = @id_entreprise;
    DELETE FROM adresse WHERE id_entreprise = @id_entreprise;
    DELETE FROM entreprise WHERE id_entreprise = @id_entreprise;

    COMMIT;
');

$requetePiloteSuppresion->execute(['id_entreprise' => $id_entreprise]);

header('Location: gestionEntreprises.php');
exit();
?>
