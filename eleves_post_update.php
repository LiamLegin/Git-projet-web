<?php

require_once 'config.php';

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */
$postData = $_POST;

if (
    !isset($postData['id_etudiant'])
    || !is_numeric($postData['id_etudiant'])
    || empty($postData['nom_etudiant'])
    || empty($postData['prenom_etudiant'])
    || empty($postData['date_naissance'])
    || empty($postData['date_debut_etudes'])
    || empty($postData['date_fin_etudes'])
    || empty($postData['tel_etudiant'])
    || empty($postData['email'])
    || empty($postData['password'])
    || trim(strip_tags($postData['nom_etudiant'])) === ''
    || trim(strip_tags($postData['prenom_etudiant'])) === ''
    || trim(strip_tags($postData['date_naissance'])) === ''
    || trim(strip_tags($postData['date_debut_etudes'])) === ''
    || trim(strip_tags($postData['date_fin_etudes'])) === ''
    || trim(strip_tags($postData['tel_etudiant'])) === ''
    || trim(strip_tags($postData['email'])) === ''
    || trim(strip_tags($postData['password'])) === ''
) {
    echo 'Il manque des informations pour permettre l\'édition de l\'étudiant•e.';
    return;
}

$id_etudiant = (int)$postData['id_etudiant'];
$nom_etudiant = trim(strip_tags($postData['nom_etudiant']));
$prenom_etudiant = trim(strip_tags($postData['prenom_etudiant']));
$date_naissance = trim(strip_tags($postData['date_naissance']));
$adresse_etudiant = '';
$promo_etudiant = $postData['promo_etudiant'];
$date_debut_etudes = trim(strip_tags($postData['date_debut_etudes']));
$date_fin_etudes = trim(strip_tags($postData['date_fin_etudes']));
$campus_etudiant = $postData['campus_etudiant'];
$ville_etudiant = $postData['ville_etudiant'];
$enseignant = $postData['enseignant'];
$tel_etudiant = trim(strip_tags($postData['tel_etudiant']));
$email = trim(strip_tags($postData['email']));
$password = trim(strip_tags($postData['password']));

// Vérifier si une nouvelle adresse a été fournie dans le formulaire
if (!isset($postData['adresse_etudiant']) || empty($postData['adresse_etudiant'])) {
    // Si aucune nouvelle adresse n'a été fournie, récupérer l'adresse actuelle de l'étudiant dans la base de données
    $requeteAdresseActuelle = $mysqlClient->prepare('
        SELECT nom_rue, adresse.id_ville
        FROM etudiant
        LEFT JOIN adresse ON etudiant.id_etudiant = adresse.id_etudiant 
        WHERE etudiant.id_etudiant = :id_etudiant;
    ');
    $requeteAdresseActuelle->execute(['id_etudiant' => $id_etudiant]);
    $resultatAdresseActuelle = $requeteAdresseActuelle->fetch();

    // Vérifier si une adresse existe déjà pour cet étudiant dans la base de données
    if ($resultatAdresseActuelle) {
        // Si une adresse existe déjà, récupérer ses détails
        $adresse_etudiant = $resultatAdresseActuelle['nom_rue'];
        $ville_etudiant = $resultatAdresseActuelle['id_ville'];
    }
} else {
    // Si une nouvelle adresse a été fournie, utilisez-la
    $adresse_etudiant = trim(strip_tags($postData['adresse_etudiant']));
}

// Vérifier si une promotion est sélectionnée
if ($promo_etudiant !== "") {
    // Si une promotion est sélectionnée, vérifier que la date de début de l'année est antérieure à la date de fin de l'année
    if ($date_debut_etudes >= $date_fin_etudes) {
        echo "La date de début de l'année doit être antérieure à la date de fin de l'année.";
        return;
    }
}

// Vérifier si une nouvelle valeur de campus a été sélectionnée dans le formulaire
if ($postData['campus_etudiant'] !== "") {
    // Si une nouvelle valeur de campus a été sélectionnée, utilisez-la
    $campus_etudiant = $postData['campus_etudiant'];
} else {
    // Si l'option "Pas de changement de campus" a été sélectionnée
    // Récupérer le campus actuellement attribué à l'étudiant dans la base de données
    $requeteCampusActuel = $mysqlClient->prepare('
        SELECT campus.id_campus
        FROM campus
        INNER JOIN etre_localiser ON campus.id_campus = etre_localiser.id_campus
        INNER JOIN piloter ON etre_localiser.id_enseignant = piloter.id_enseignant
        INNER JOIN composer ON piloter.id_promo = composer.id_promo
        WHERE composer.id_etudiant = :id_etudiant
    ');
    $requeteCampusActuel->execute(['id_etudiant' => $id_etudiant]);
    $campus_actuel = $requeteCampusActuel->fetchColumn();

    // Définir le campus actuel comme campus sélectionné
    $campus_etudiant = $campus_actuel;
}

$requetePiloteInsertion = $mysqlClient->prepare('
    UPDATE utilisateur
    JOIN etudiant ON utilisateur.id_utilisateur = etudiant.id_utilisateur
    LEFT JOIN adresse ON etudiant.id_etudiant = adresse.id_etudiant
    LEFT JOIN ville ON adresse.id_ville = ville.id_ville
    LEFT JOIN region ON ville.id_region = region.id_region
    LEFT JOIN pays ON region.id_pays = pays.id_pays
    LEFT JOIN composer ON etudiant.id_etudiant = composer.id_etudiant
    LEFT JOIN promo ON composer.id_promo = promo.id_promo
    LEFT JOIN piloter ON promo.id_promo = piloter.id_promo
    RIGHT JOIN enseignant ON piloter.id_enseignant = enseignant.id_enseignant
    LEFT JOIN etre_localiser ON enseignant.id_enseignant = etre_localiser.id_enseignant
    LEFT JOIN campus ON etre_localiser.id_campus = campus.id_campus
    SET 
        utilisateur.email = :email, 
        utilisateur.mdp = SHA2(:password, 256),
        etudiant.nom_etudiant = :nomEtudiant,
        etudiant.prenom_etudiant = :prenomEtudiant, 
        etudiant.date_naissance_etudiant = :dateNaissance,
        etudiant.telephone_etudiant = :telEtudiant,
        composer.id_promo = :id_promo,
        composer.date_debut_etudes = :dateDebutEtudes,
        composer.date_fin_etudes = :dateFinEtudes,
        piloter.id_enseignant = :id_enseignant,
        etre_localiser.id_campus = :id_campus,
        adresse.nom_rue = :nom_rue,
        adresse.id_ville = :id_ville
    WHERE etudiant.id_etudiant = :id_etudiant;
');

$requetePiloteInsertion->execute([
    'id_etudiant' => $id_etudiant,
    'nomEtudiant' => $nom_etudiant,
    'prenomEtudiant' => $prenom_etudiant,
    'dateNaissance' => $date_naissance,
    'nom_rue' => $adresse_etudiant,
    'id_promo' => $promo_etudiant,
    'dateDebutEtudes' => $date_debut_etudes,
    'dateFinEtudes' => $date_fin_etudes,
    'id_campus' => $campus_etudiant,
    'id_ville' => $ville_etudiant,
    'id_enseignant' => $enseignant,
    'telEtudiant' => $tel_etudiant,
    'email' => $email,
    'password' => $password,
]);

header('Location: gestionEleves.php');
exit();
?>
