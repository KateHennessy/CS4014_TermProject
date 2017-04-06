<?php
require_once __DIR__."/../models/Discipline.class.php";
require_once __DIR__."/../utils/ModelFactory.class.php";
require_once __DIR__."/../utils/PDOAccess.class.php";

class DisciplineDAO {

  public static function find_all_disciplines(){
    $disciplines = array();
      $query = "SELECT * FROM `discipline`;";
      echo($query);
      $result = PDOAccess::returnSQLquery($query);
      if ($result) {
        foreach($result as $row){
          $disciplines[] = ModelFactory::buildModel("Discipline",$row);
        }
      }
      print_r($disciplines);
    return $disciplines;
  }

  public static function find_discipline_by_name($discipline_name){
    $discipline = NULL;
    if (!is_null($discipline_name)) {
        $query = "SELECT * FROM discipline WHERE discipline_name =" .PDOAccess::prepareString($discipline_name) .";";
        $result = PDOAccess::returnSQLquery($query);
        if ($result) {
          $row = $result -> fetch(PDO::FETCH_ASSOC);
          $discipline = ModelFactory::buildModel("Discipline",$row);
        }
      }
      return $discipline;
    }
  }
