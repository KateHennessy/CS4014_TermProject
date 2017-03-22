<?php
require_once __DIR__."/../models/Tag.class.php";
require_once __DIR__."/../utils/ModelFactory.class.php";
require_once __DIR__."/../utils/PDOAccess.class.php";
require_once __DIR__."/../models/User.class.php";



class TagDAO {

    public static function find_tag_by_name($tag_name){
      $query = "SELECT * FROM tag WHERE tag_name =".PDOAccess::prepareString($tag_name);
      $result = PDOAccess::returnSQLquery($query);
      $tag = null;
      if ($result) {
        $row = $result -> fetch(PDO::FETCH_ASSOC);
        $tag = ModelFactory::buildModel("Tag", $row);
      }
      return $tag;
    }

    public static function getUserTags($user_id) {
        $tags = array();
        if (!is_null($user_id)) {
            $query = "SELECT tag.tag_id, tag_name FROM user_tag NATURAL JOIN tag WHERE user_tag.user_id =" .$user_id .";";
            $result = PDOAccess::returnSQLquery($query);

            if ($result) {
              foreach($result as $row){
                $tags[] = ModelFactory::buildModel("Tag",$row);
              }
            }
        }
        return $tags;
    }

    public static function getTaskTags($task_id) {
        $tags = array();
        if (!is_null($task_id)) {
            $query = "SELECT tag.tag_id, tag_name FROM task_tag NATURAL JOIN tag WHERE task_tag.task_id =" .$task_id .";";
            $result = PDOAccess::returnSQLquery($query);

            if ($result) {
              foreach($result as $row){
                $tags[] = ModelFactory::buildModel("Tag",$row);
              }
            }
        }
        return $tags;
    }

    public static function insertUserTag($user_id, $tag_id){      //UPDATED THIS  
      if(count(self::getTaskTags($task_id)) < 4){
       $query = "INSERT INTO `user_tag` (`user_id`, `tag_id`, `clicks`) VALUES ("
       .PDOAccess::prepareString($user_id) .", " .PDOAccess::prepareString($tag_id) .", '0');";
      //  echo($query);
       return PDOAccess::insertSQLquery($query);
     }else{
       return NULL;
     }

    }

    public static function insertTaskTag($task_id, $tag_id){
       $query = "INSERT INTO `task_tag` (`task_id`, `tag_id`) VALUES ("
       .PDOAccess::prepareString($task_id) .", " .PDOAccess::prepareString($tag_id) .");";
      //  echo($query);
       return PDOAccess::insertSQLquery($query);

    }

}

?>
