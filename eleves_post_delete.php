<?php
require_once 'config.php';
/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */
$postData = $_POST;

if (!isset($postData['id_etudiant']) || !is_numeric($postData['id_etudiant'])) {
    echo 'Il faut un identifiant valide pour supprimer un pilote.';
    return;
}

$id_etudiant = (int)$postData['id_etudiant'];

$requetePiloteSuppresion = $mysqlClient->prepare('
    START TRANSACTION;

    SET @id_etudiant = :id_etudiant;

    DELETE FROM evaluation_etudiant WHERE id_etudiant = @id_etudiant;
    DELETE FROM candidater WHERE id_etudiant = @id_etudiant;
    DELETE FROM composer WHERE id_etudiant = @id_etudiant;
    DELETE FROM adresse WHERE id_etudiant = @id_etudiant;
    DELETE FROM etudiant WHERE id_etudiant = @id_etudiant;
    DELETE FROM utilisateur WHERE id_utilisateur IN (SELECT id_etudiant FROM etudiant WHERE id_etudiant = @id_etudiant);

    COMMIT;
');

$requetePiloteSuppresion->execute(['id_etudiant' => $id_etudiant]);

header('Location: gestionEleves.php');
exit();
?>