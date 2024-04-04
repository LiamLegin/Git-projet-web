<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['logged_in'])) {
    // Rediriger vers la page de connexion
    header("Location: not-logged.php");
    exit;
}
?>
