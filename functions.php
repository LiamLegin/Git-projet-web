<?php function validateEmailDomain($email) {
    $allowedDomains = array('viacesi.fr', 'cesi.fr');
    $emailParts = explode('@', $email);
    if (count($emailParts) == 2 && in_array($emailParts[1], $allowedDomains)) {
        return true;
    }
    return false;
}
?>
