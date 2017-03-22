<?php
class validate_email {


public static function validEmail($email) {
    $validDomain = 'ul.ie';
    $parts = explode('@',$email);
    $domain = $this -> get_domain(trim($email));
    if(!($domain) && !($validDomain)) return true;
    return false;
}

}
?>
