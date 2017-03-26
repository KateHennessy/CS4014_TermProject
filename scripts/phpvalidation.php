<?php
class phpvalidation {


  public static function isValidDate($dateString){
    if (DateTime::createFromFormat('Y-m-d', $dateString) !== FALSE) {
      return true;
    }else{
      return false;
    }
  }

  public static function validEmail($email) {
      $validDomain = 'ul.ie';
      $parts = explode('@',$email);
      $domain = $this -> get_domain(trim($email));
      if(!($domain) && !($validDomain)) return true;
      return false;
  }

}
?>
