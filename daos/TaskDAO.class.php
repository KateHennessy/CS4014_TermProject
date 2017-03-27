<?php
require_once __DIR__."/../utils/ModelFactory.class.php";
require_once __DIR__."/../utils/PDOAccess.class.php";
require_once __DIR__."/../models/Task.class.php";
require_once __DIR__."/StatusDAO.class.php";


class TaskDAO{
  public static function save($task){
    if(is_null($task->get_id())){
      if( is_null(self::find_task($task->get_creator_id(), $task->get_title())->get_id())){
          return self::insert($task);
      }else{

      }
    }
  }

    // }else {
    //     self::update($user);
    // } //Needed for updating statuses linked to tasks

    public static function find_score_from_task_id($task_id){
      $score = null;
      if(!is_null($task_id)){
        $query = 'SELECT `score` FROM claimed_task WHERE task_id='.$task_id .';';
        $result = PDOAccess::returnSQLquery($query);
        if ($result) {
          $row = $result -> fetch(PDO::FETCH_ASSOC);
          $score = $row['score'];
        }
      }
      return $score;
    }

    public static function find_claimer_id_from_task_id($task_id){
      $claimer_id = null;
      if(!is_null($task_id)){
        $query = 'SELECT `claimer_id` FROM claimed_task WHERE task_id='.$task_id .';';
        $result = PDOAccess::returnSQLquery($query);
        if ($result) {
          $row = $result -> fetch(PDO::FETCH_ASSOC);
          $claimer_id = $row['claimer_id'];
        }
      }
      return $claimer_id;
    }

    public static function find_task_in_flagged($task_id){ //NEED TO TEST THIS
      $task = NULL;
      if(!is_null($task_id)){
        $query = 'SELECT * FROM flagged_task WHERE task_id='.$task_id .';';
        $result = PDOAccess::returnSQLquery($query);
        $row = $result -> fetch(PDO::FETCH_ASSOC);
          $task = ModelFactory::buildModel("Task", $row);
    }
      return $task;
    }


public static function claim_task($user_id, $task_id){
  $claimed = false;
  if(!is_null($user_id)){
      $query = 'INSERT INTO `claimed_task` (`claimer_id`, `task_id`, `score`) VALUES (' .PDOAccess::prepareString($user_id) .', '
      .PDOAccess::prepareString($task_id) .', '."'0'" .');';
      $result = PDOAccess::insertSQLquery($query);
        if ($result) {
          // $task = self::find_task_by_id($task_id);
          StatusDAO::update_task_status("in progress", $task_id);
          $claimed = true;
        }
  }

  return $claimed;
}



  public static function insert($task){
    $query = "INSERT INTO `task` (`task_id`, `creator_id`, `task_title`,
      `task_type`, `description`, `claim_deadline`, `completion_deadline`,
      	`no_pages`,	`no_words`,	`format`,	`storage_address`) VALUES ( NULL,"
          .PDOAccess::prepareString($task->get_creator_id()) .","
          .PDOAccess::prepareString($task->get_title()) .","
          .PDOAccess::prepareString($task->get_type()) .","
          .PDOAccess::prepareString($task->get_description()) .","
          .PDOAccess::prepareString($task->get_claim_deadline()) .","
          .PDOAccess::prepareString($task->get_completion_deadline()) .","
          .PDOAccess::prepareString($task->get_no_pages()) .","
          .PDOAccess::prepareString($task->get_no_words()) .","
          .PDOAccess::prepareString($task->get_format()) .","
          .PDOAccess::prepareString($task->get_storage_address()) .");";

			 $result = PDOAccess::insertSQLquery($query); //result will be true if successfully added
       //Next - add task tags to the task_tag table
        if ($result) {
          $tags = array();
         $tags = $task->get_tags();
         $task = self::find_task($task->get_creator_id(), $task->get_title());

         $task_id = $task->get_id();
						for($i = 0; $i < count($tags); $i++){
							$tagdao = new TagDAO();
								$tagdao->insertTaskTag($task->get_id(), $tags[$i]->get_id());
						}

         StatusDAO::update_task_status("unclaimed", $task->get_id());
         $task = self::find_task($task->get_creator_id(), $task->get_title());

        }else {
            $task = null;
        }
        return $task;
  }

  public static function find_task_by_id($id){
    $task = null;
    if(!is_null($id)){
      $query = 'SELECT * FROM `task` WHERE task_id =' .$id .';';
      $result = PDOAccess::returnSQLquery($query);
      if ($result) {
        $row = $result -> fetch(PDO::FETCH_ASSOC);
          $task = ModelFactory::buildModel("Task", $row);
      }
    }
    return $task;
  }

  public static function find_task($creator_id, $title){ //imposing limit of specific title only allowed once per creator
    $task = null;
    if (!is_null($creator_id)) {
      $query = "SELECT * FROM `task` WHERE creator_id =" .PDOAccess::prepareString($creator_id)
      ."AND task_title =" .PDOAccess::prepareString($title);
        $result = PDOAccess::returnSQLquery($query);
        if ($result) {
          $row = $result -> fetch(PDO::FETCH_ASSOC);
            $task = ModelFactory::buildModel("Task", $row);
        }
    }
    return $task;
  }



  public static function find_user_uploaded_tasks($user){
    $uploadedTasks = NULL;
    if(!is_null($user)){
      $id = $user->get_id();
      $uploadedTasks = array();
      $query = "SELECT * FROM task WHERE creator_id = " .$id .";";
      $result = PDOAccess::returnSQLquery($query);
      foreach($result as $row){
        $uploadedTasks[] = ModelFactory::buildModel("Task", $row);
      }
      return $uploadedTasks;
    }
  }

  public static function find_user_claimed_tasks($user_id){
    $claimedTasks = NULL;
    if(!is_null($user_id)){

      $claimedTasks = array();
      $query = "SELECT * FROM task WHERE task_id IN
      (SELECT task_id FROM claimed_task WHERE claimer_id = " .$user_id .");";
      $result = PDOAccess::returnSQLquery($query);
      foreach($result as $row){
        $claimedTasks[] = ModelFactory::buildModel("Task", $row);
      }
    }
    return $claimedTasks;
  }



  public static function find_available_tasks($creator_id){
    $availableTasks = NULL;
    if(!is_null($creator_id)){
      $availableTasks = array();
      // $query = "SELECT * FROM task WHERE creator_id != " .$creator_id ." AND task_id IN(
      //   SELECT task_id FROM task_status JOIN status USING(status_id)WHERE status_name = 'unclaimed');";
      $query = 'SELECT * FROM task WHERE creator_id !='. $creator_id .' AND task_id IN
                (SELECT task_id FROM task_status t1 WHERE status_id =
                	(SELECT status_id FROM status WHERE status_name=' ."'unclaimed'" .') AND timestamp =
                	(SELECT MAX(timestamp) FROM task_status t2 WHERE t1.task_id = t2.task_id GROUP BY task_id
                    )
                 GROUP BY task_id
                ) ORDER BY claim_deadline ASC;'
      ;
        //  echo($query);
      $result = PDOAccess::returnSQLquery($query);
      foreach($result as $row){
        $availableTasks[] = ModelFactory::buildModel("Task", $row);
      }
    }
    return $availableTasks;
  }

  public static function find_available_tasks_offset($creator_id, $limit, $offset){
    $availableTasks = NULL;
    if(!is_null($creator_id)){
      $availableTasks = array();
      // $query = "SELECT * FROM task WHERE creator_id != " .$creator_id ." AND task_id IN(
      //   SELECT task_id FROM task_status JOIN status USING(status_id)WHERE status_name = 'unclaimed');";
      $query = 'SELECT * FROM task WHERE creator_id !='. $creator_id .' AND task_id IN
                (SELECT task_id FROM task_status t1 WHERE status_id =
                	(SELECT status_id FROM status WHERE status_name=' ."'unclaimed'" .') AND timestamp =
                	(SELECT MAX(timestamp) FROM task_status t2 WHERE t1.task_id = t2.task_id GROUP BY task_id
                    )
                 GROUP BY task_id
                ) ORDER BY claim_deadline ASC
                 LIMIT '. $offset .', ' .$limit .';';
      ;
        //  echo($query);
      $result = PDOAccess::returnSQLquery($query);
      foreach($result as $row){
        $availableTasks[] = ModelFactory::buildModel("Task", $row);
      }
    }
    return $availableTasks;
  }

  public static function find_no_available_tasks($creator_id){
    $noAvailableTasks = NULL;
    if(!is_null($creator_id)){
      $query = 'SELECT * FROM task WHERE creator_id !='. $creator_id .' AND task_id IN
                (SELECT task_id FROM task_status t1 WHERE status_id =
                  (SELECT status_id FROM status WHERE status_name=' ."'unclaimed'" .') AND timestamp =
                  (SELECT MAX(timestamp) FROM task_status t2 WHERE t1.task_id = t2.task_id GROUP BY task_id
                    )
                 GROUP BY task_id
                ) ORDER BY claim_deadline ASC;';
        //  echo($query);
      $noAvailableTasks = PDOAccess::returnNoColumns($query);
    }
    return $noAvailableTasks;
  }




}
