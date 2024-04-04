<?php
session_start();

require_once 'functions.php';
require_once 'config.php';

// Initialiser les variables
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Connexion à la base de données
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupérer les données du formulaire
        $email = $_POST['email'];
        $motDePasse = $_POST['motDePasse'];

        // Valider l'adresse e-mail
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Valider le domaine de l'adresse e-mail
            if (validateEmailDomain($email)) {
                // Hacher le mot de passe avec SHA-256
                $hashedPassword = hash('sha256', $motDePasse);

                // Préparer et exécuter la requête SQL pour vérifier les informations de connexion
                $query = "SELECT 
                            utilisateur.id_utilisateur,
                            etudiant.nom_etudiant,
                            etudiant.prenom_etudiant,
                            administrateur.nom_administrateur,
                            administrateur.prenom_administrateur,
                            enseignant.nom_enseignant,
                            enseignant.prenom_enseignant
                          FROM utilisateur
                          LEFT JOIN etudiant ON utilisateur.id_utilisateur = etudiant.id_utilisateur
                          LEFT JOIN administrateur ON utilisateur.id_utilisateur = administrateur.id_utilisateur
                          LEFT JOIN enseignant ON utilisateur.id_utilisateur = enseignant.id_utilisateur
                          WHERE utilisateur.email = :email AND utilisateur.mdp = :motDePasse";
                $stmt = $pdo->prepare($query);
                $stmt->execute(array(':email' => $email, ':motDePasse' => $hashedPassword));

                // Vérifier si l'utilisateur existe
                if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Utilisateur authentifié avec succès
                    $_SESSION['logged_in'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['username'] = '';
                    $_SESSION['role'] = '';

                    // Déterminer le nom et le prénom en fonction du rôle de l'utilisateur
                    if (!empty($row['nom_etudiant'])) {
                        $_SESSION['username'] = $row['prenom_etudiant'] . ' ' . $row['nom_etudiant'];
                        $_SESSION['role'] = 'Etudiant';
                    } elseif (!empty($row['nom_administrateur'])) {
                        $_SESSION['username'] = $row['prenom_administrateur'] . ' ' . $row['nom_administrateur'];
                        $_SESSION['role'] = 'Administrateur';
                    } elseif (!empty($row['nom_enseignant'])) {
                        $_SESSION['username'] = $row['prenom_enseignant'] . ' ' . $row['nom_enseignant'];
                        $_SESSION['role'] = 'Enseignant';
                    }

                    // Rediriger vers la page de bienvenue ou toute autre page appropriée
                    header("Location: index.php");
                    exit;
                } else {
                    // Identifiants invalides
                    $message = "Identifiants invalides. Veuillez réessayer.";
                }
            } else {
                // Domaine non autorisé
                $message = "Adresse e-mail non autorisée. Veuillez utiliser une adresse e-mail associée à un domaine viacesi.fr ou cesi.fr";
            }
        } else {
            // Adresse e-mail invalide
            $message = "Adresse e-mail invalide. Veuillez saisir une adresse e-mail valide.";
        }
    } catch (PDOException $e) {
        // Erreur de connexion à la base de données
        $message = "Erreur de connexion : " . $e->getMessage();
    }
}
?>
