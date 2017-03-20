<?php
require_once __DIR__."/../models/Status.class.php";
require_once __DIR__."/../utils/ModelFactory.class.php";
require_once __DIR__."/../utils/PDOAccess.class.php";

class StatusDAO{
  public static function find_status_by_name($status_name){
      $status = NULL;
      if (!is_null($status_name)) {
          $query = "SELECT * FROM status WHERE status_name =" .PDOAccess::prepareString($status_name) .";";
          $result = PDOAccess::returnSQLquery($query);
          if ($result) {
            $row = $result -> fetch(PDO::FETCH_ASSOC);
            $status = ModelFactory::buildModel("Status",$row);
          }
      }
        return $status;
  }

  public static function update_task_status($status_name, $task_id){
     $status = self::find_status_by_name($status_name);
     date_default_timezone_set('Europe/Dublin');
 		$date = date('Y-m-d H:i:s', time());
    if((!is_null($status->get_id())) && (!is_null($task_id))){
      $query = "INSERT INTO `task_status` (`task_id`, `status_id`, `timestamp`)
       VALUES (".$task_id ."," .$status->get_id() ."," .PDOAccess::prepareString($date) .");";
      return PDOAccess::insertSQLquery($query);
    }else{
      return false;
    }


  }
}