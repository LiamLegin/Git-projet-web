<?php
require_once 'config.php';
/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */
$postData = $_POST;

if (!isset($postData['id_offre_stage']) || !is_numeric($postData['id_offre_stage'])) {
    echo 'Il faut un identifiant valide pour supprimer une offre de stage.';
    return;
}

$id_offre_stage = (int)$postData['id_offre_stage'];

$requetePiloteSuppresion = $mysqlClient->prepare('
    START TRANSACTION;

    SET @id_offre_stage = :id_offre_stage;
    
    DELETE FROM candidater WHERE id_offre_stage = @id_offre_stage;
    DELETE FROM gerer WHERE id_offre_stage = @id_offre_stage;
    DELETE FROM exiger WHERE id_offre_stage = @id_offre_stage;
    DELETE FROM offre_stage WHERE id_offre_stage = @id_offre_stage;
    
    COMMIT;
');

$requetePiloteSuppresion->execute(['id_offre_stage' => $id_offre_stage]);

header('Location: gestionStages.php');
exit();
?>
