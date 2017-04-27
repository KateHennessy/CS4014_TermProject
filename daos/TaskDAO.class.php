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

  public static function update_all_task_statuses(){
    PDOAccess::call('ChangeClaimedToUnfinished','');
    PDOAccess::call('ChangeUnclaimedToExpired','');


  }



    public static function find_score_from_task_id($task_id){
      $score = 0;
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

    public static function set_score_for_task($score, $task_id){
      $changedScore = false;

      if(!is_null($task_id)){
        $query = 'UPDATE `claimed_task` SET `score` = '. PDOAccess::prepareString($score) .' WHERE `claimed_task`.`task_id` = '. $task_id .';';
        $result = PDOAccess::insertSQLquery($query);
          if ($result) {
            $changedScore = true;
          }
      }
      return $changedScore;
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




public static function claim_task($user_id, $task_id){
  $claimed = false;
  if(!is_null($user_id)){
      $query = 'INSERT INTO `claimed_task` (`claimer_id`, `task_id`, `score`) VALUES (' .PDOAccess::prepareString($user_id) .', '
      .PDOAccess::prepareString($task_id) .', '."'0'" .');';
      $result = PDOAccess::insertSQLquery($query);
        if ($result) {
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

public static function find_no_user_uploaded_tasks($user_id){
  $noUploadedTasks = 0;
  if(!is_null($user_id)){
    $uploadedTasks = array();
    $query = "SELECT * FROM task WHERE creator_id = " .$user_id .";";
    $noUploadedTasks = PDOAccess::returnNoRows($query);
  }
  return $noUploadedTasks;
}


public static function find_user_uploaded_tasks_offset($user_id, $limit, $offset){
  $uploadedTasks = NULL;
  if(!is_null($user_id)){
    $uploadedTasks = array();
    $query = "SELECT * FROM task WHERE creator_id = " .$user_id .' ORDER BY task_id DESC LIMIT '. $offset .', ' .$limit .';';
    $result = PDOAccess::returnSQLquery($query);
	if($result){
		foreach($result as $row){
			$uploadedTasks[] = ModelFactory::buildModel("Task", $row);
		}
	}

    return $uploadedTasks;
  }
}



  public static function find_no_claimed_tasks($user_id){
    $noClaimedTasks = 0;
    if(!is_null($user_id)){
      $query = "SELECT * FROM task WHERE task_id IN
      (SELECT task_id FROM claimed_task WHERE claimer_id = " .$user_id .");";
      $noClaimedTasks = PDOAccess::returnNoRows($query);
    }
    return $noClaimedTasks;
  }

  public static function find_user_claimed_tasks_offset($user_id, $limit, $offset){
    $claimedTasks = NULL;
    if(!is_null($user_id)){

      $claimedTasks = array();
      $query = 'SELECT * FROM task WHERE task_id IN
      (SELECT task_id FROM claimed_task WHERE claimer_id = ' .$user_id .') ORDER BY task_id DESC LIMIT '. $offset .', ' .$limit .';';
      $result = PDOAccess::returnSQLquery($query);
	  if($result){
		  foreach($result as $row){
			$claimedTasks[] = ModelFactory::buildModel("Task", $row);
		  }
		}
    }
    return $claimedTasks;

  }


  public static function find_available_tasks_offset($creator, $limit, $offset){
    $availableTasks = NULL;
    if(!is_null($creator->get_id())){
      $creator_id = $creator->get_id();
      $availableTasks = array();

      $query = 'SELECT * , sum(clicks) AS clicks FROM task_tag LEFT JOIN task ON task_tag.task_id = task.task_id
      LEFT JOIN (SELECT * FROM user_tag WHERE user_tag.user_id = ' .$creator_id
      .') AS user_tag ON task_tag.tag_id = user_tag.tag_id WHERE creator_id !='
      .$creator_id
      .' AND task.task_id IN (SELECT t1.task_id FROM task_status t1 WHERE status_id =
        (SELECT status_id FROM status WHERE status_name= ' ."'unclaimed'" .') AND timestamp =
        (SELECT MAX(timestamp) FROM task_status t2 WHERE t1.task_id = t2.task_id GROUP BY t1.task_id )
         GROUP BY task.task_id ) GROUP BY task.task_id ORDER BY sum(clicks) DESC LIMIT '. $offset .', ' .$limit .';';

      $result = PDOAccess::returnSQLquery($query);
  	  if($result){
        $multiarray = array();  //used to store clicks and task in seperate array - once sorted will be moved back to $availableTasks
    		foreach($result as $row){
          $sum = 0;
          $userSum = 0;
          $task = ModelFactory::buildModel("Task", $row);
          $sum = $row["clicks"];
          foreach($task->get_tags() as $taskTag){
            foreach($creator->get_tags() as $userTag){
              if($taskTag->get_name() == $userTag->get_name()){
                $userSum = $userSum + $userTag->get_clicks();
              }
            }
          }
          // CAN USER NEXT LINE TO TEST SUM OF CLICKS
          //$task->set_title($task->get_title() .'  (Sum of Clicks: ' .$sum .')');
            $availableTasks[] = $task;
  	  }

    }
  }
    return $availableTasks;
  }

  public static function find_no_available_tasks($creator_id){
    $noAvailableTasks = 0;
    if(!is_null($creator_id)){


      $query = 'SELECT * FROM task_tag LEFT JOIN task ON task_tag.task_id = task.task_id
      LEFT JOIN (SELECT * FROM user_tag WHERE user_tag.user_id = ' .$creator_id
      .') AS user_tag ON task_tag.tag_id = user_tag.tag_id WHERE creator_id !='
      .$creator_id
      .' AND task.task_id IN (SELECT t1.task_id FROM task_status t1 WHERE status_id =
        (SELECT status_id FROM status WHERE status_name= ' ."'unclaimed'" .') AND timestamp =
        (SELECT MAX(timestamp) FROM task_status t2 WHERE t1.task_id = t2.task_id GROUP BY t1.task_id )
         GROUP BY task.task_id ) GROUP BY task.task_id ORDER BY sum(clicks) DESC';

      $noAvailableTasks = PDOAccess::returnNoRows($query);
    }
    return $noAvailableTasks;
  }

  public static function flag_task($task_id, $flagger_id){
    $taskFlagged = false;
    if(!is_null($task_id)){
        $task = self::find_task_by_id($task_id);
        if(!is_null(self::find_task_in_flagged($task->get_id()))){ // check whether the task has already been flagged
          $taskFlagged = true;
        }else{
          date_default_timezone_set('Europe/Dublin');
         $date = date('Y-m-d H:i:s', time());
          $query =  'INSERT INTO `flagged_task` (`task_id`, `flagger_id`, `timestamp`) VALUES ('
          .PDOAccess::prepareString($task->get_id()) .', ' .PDOAccess::prepareString($flagger_id) .', ' .PDOAccess::prepareString($date) .');';
          $taskFlagged = PDOAccess::insertSQLquery($query);

        }
      }
    return $taskFlagged;
  }


  public static function find_no_flagged_tasks(){
    $flaggedTasks = 0;
      $query = 'SELECT * FROM task WHERE task_id IN
      (SELECT task_id FROM flagged_task);';

      $flaggedTasks = PDOAccess::returnNoRows($query);
      return $flaggedTasks;
  }

  public static function find_flagged_tasks_offset($limit, $offset){
    $flaggedTasks = array();
    $query = 'SELECT * FROM task WHERE task_id IN
    (SELECT task_id FROM flagged_task) LIMIT ' .$offset .',' .$limit .';';

    $result = PDOAccess::returnSQLquery($query);
    if($result){
  	  foreach($result as $row){
  		$flaggedTasks[] = ModelFactory::buildModel("Task", $row);
  	  }
  	}
    return $flaggedTasks;
  }

  public static function find_task_in_flagged($task_id){
    $task = NULL;
    if(!is_null($task_id)){
      $query = 'SELECT * FROM flagged_task WHERE task_id='.$task_id .';';
      $result = PDOAccess::returnSQLquery($query);
      if($result->rowCount() > 0){
          $row = $result -> fetch(PDO::FETCH_ASSOC);
          $task = ModelFactory::buildModel("Task", $row);
      }else{
      }
    }
    return $task;
  }

  public static function deflag_task($task_id){
    $deflagged = false;
    if(!is_null($task_id)){
        if(!is_null(self::find_task_in_flagged($task_id))){
          $query = 'DELETE FROM `flagged_task` WHERE `task_id` = ' .$task_id .';';
          $result = PDOAccess::deleteSQLquery($query);
          $deflagged = $result;
        }
    }
    return $deflagged;
  }

  public static function remove_all_user_tasks($creator_id){
    if(!is_null($creator_id)){
      $query = 'DELETE FROM `task` WHERE `task`.`creator_id` = ' .$creator_id .' AND `task_id` NOT IN (SELECT `task_id` FROM claimed_task);';
      return PDOAccess::deleteSQLquery($query);
    }else{
      return false;
    }
  }

  public static function delete_task($task_id){
    if(!is_null($task_id)){
      $query = 'DELETE FROM `task` WHERE `task`.`task_id` = ' .$task_id .';';
      return PDOAccess::deleteSQLquery($query);
    }else{
      return false;
    }
  }

  public static function count_tasks($creator_id){
    $count_tasks = NULL;
    if(!is_null($creator_id)){
          $query = 'SELECT * FROM  task  WHERE creator_id = ' .PDOAccess::prepareString($creator_id) .';';
          $result = PDOAccess::returnNoRows($query);

          $count_tasks = $result;
        }

    return $count_tasks;
  }


}
