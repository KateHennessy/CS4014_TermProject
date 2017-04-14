<?php
class phpvalidation {


  public static function isValidDate($dateString){
    if (DateTime::createFromFormat('Y-m-d', $dateString) !== FALSE) {
      return true;
    }else{
      return false;
    }
  }

  public static function displaySuccess($text){
    return self::displaySuccessSubText($text, "");
  }

  public static function displaySuccessSubText($text, $subText){
    return '<div class="alert alert-success alert-dismissable">
    <h3><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <i class="glyphicon glyphicon-ok"></i>' .$text .'</h3><p>' .$subText .'</p></div>';
  }
  public static function displayFailure($text){
    return self::displayFailureSubtext($text, "");
  }

  public static function displayFailureSubtext($text, $subText){
    return '<div class="alert alert-danger alert-dismissable">
    <h3><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <i class="glyphicon glyphicon-remove"></i>' .$text .'</h3><p> '.$subText .'</p></div>';
  }

  public static function displayWarning($text){
    return self::displayWarningSubText($text, "");
  }

  public static function displayWarningSubtext($text, $subText){
    return '<div class="alert alert-warning alert-dismissable">
    <h3><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <i class="glyphicon glyphicon-remove"></i>' .$text .'</h3><p> '.$subText .'</p></div>';
  }




}
?>
