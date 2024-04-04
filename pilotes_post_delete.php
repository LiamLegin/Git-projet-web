<?php
require_once 'config.php';
/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */
$postData = $_POST;

if (!isset($postData['id_enseignant']) || !is_numeric($postData['id_enseignant'])) {
    echo 'Il faut un identifiant valide pour supprimer un pilote.';
    return;
}

$id_enseignant = (int)$postData['id_enseignant'];

$requetePiloteSuppresion = $mysqlClient->prepare('
    START TRANSACTION;

    SET @id_enseignant = :id_enseignant;

    DELETE FROM evaluation_enseignant WHERE id_enseignant = @id_enseignant;
    DELETE FROM etre_localiser WHERE id_enseignant = @id_enseignant;
    DELETE FROM piloter WHERE id_enseignant = @id_enseignant;
    DELETE FROM candidater WHERE id_offre_stage IN (SELECT id_offre_stage FROM offre_stage WHERE id_enseignant = @id_enseignant);
    DELETE FROM exiger WHERE id_offre_stage IN (SELECT id_offre_stage FROM offre_stage WHERE id_enseignant = @id_enseignant);
    DELETE FROM gerer WHERE id_offre_stage IN (SELECT id_offre_stage FROM offre_stage WHERE id_enseignant = @id_enseignant);
    DELETE FROM offre_stage WHERE id_enseignant = @id_enseignant;
    DELETE FROM enseignant WHERE id_enseignant = @id_enseignant;
    DELETE FROM utilisateur WHERE id_utilisateur IN (SELECT id_enseignant FROM enseignant WHERE id_enseignant = @id_enseignant);

    COMMIT;
');

$requetePiloteSuppresion->execute(['id_enseignant' => $id_enseignant]);

header('Location: gestionEnseignants.php');
exit();
?>
