function validEmail($email) {
    $validDomain = 'ul.ie';
    $parts = explode('@',$email);
    $domain = $parts[1];
    if(!($domain,$invalidDomains)) return true;
    return false;
}
