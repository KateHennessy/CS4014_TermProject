<!-- Modified from UL-BuynSell example on moodle -->
<!-- This class is used to generate objects from SQL results -->
<?php
require_once __DIR__."/../models/User.class.php";
require_once __DIR__."/../models/Tag.class.php";
require_once __DIR__."/../daos/TagDAO.class.php";

class ModelFactory {
    public static function buildModel($modelName, $modelData) {

        $ret = null;
        switch($modelName) {
            case "User":
                $ret = self::generateUser($modelData);
                break;
            case "Tag":
                $ret = self::generateTag($modelData);
                break;
            case "Task":
              $ret = self::generateTask($modelData);
                break;
            case "Discipline":
                $ret = self::generateDiscipline($modelData);
                break;
            case "Status":
                $ret = self::generateStatus($modelData);
                break;

			      default:
                echo "Unable to build model $modelName";
		}

		return $ret;
    }

	private static function generateUser($modelData) {
		$ret = new User();

		if (isset($modelData['user_id'])) {
			$ret ->set_id($modelData["user_id"]);
      $tags = array();
      $tags = TagDAO::getUserTags($modelData["user_id"]); //calling TagDAO which calls Model Factory generateTag
      $ret ->set_tags($tags);
		}

		if (isset($modelData['f_name'])) {
			$ret ->set_first_name($modelData["f_name"]);
		}

		if (isset($modelData['l_name'])) {
			$ret ->set_last_name($modelData["l_name"]);
		}

		if (isset($modelData['email'])) {
			$ret ->set_email($modelData["email"]);
		}

		if (isset($modelData['pass'])) {
			$ret ->set_password($modelData["pass"]);
		}

    if(isset($modelData['discipline_id'])){
      $ret ->set_discipline($modelData["discipline_id"]);
    }

    if(isset($modelData['reputation'])){
      $ret ->set_reputation($modelData["reputation"]);
    }
		return $ret;

	}

  private static function generateTask($modelData) {
		$ret = new Task();

		if (isset($modelData['task_id'])) {
			$ret ->set_id($modelData["task_id"]);
      $tags = array();
      $tags = TagDAO::getTaskTags($modelData["task_id"]); //calling TagDAO which calls Model Factory generateTag
      $ret ->set_tags($tags);
      $status = StatusDAO::find_most_recent_status($modelData["task_id"]);
      $ret ->set_status($status);
      $claimer_id = TaskDAO::find_claimer_id_from_task_id($modelData["task_id"]);
      $ret->set_claimer_id($claimer_id);
      $score = TaskDAO::find_score_from_task_id($modelData["task_id"]);
      $ret->set_score($score);
		}

		if (isset($modelData['creator_id'])) {
			$ret ->set_creator_id($modelData["creator_id"]);
		}

		if (isset($modelData['task_title'])) {
			$ret ->set_title($modelData["task_title"]);
		}

		if (isset($modelData['task_type'])) {
			$ret ->set_type($modelData["task_type"]);
		}

		if (isset($modelData['description'])) {
			$ret ->set_description($modelData["description"]);
		}

    if(isset($modelData['claim_deadline'])){
      $ret ->set_claim_deadline($modelData["claim_deadline"]);
    }

    if(isset($modelData['completion_deadline'])){
      $ret ->set_completion_deadline($modelData["completion_deadline"]);
    }

    if(isset($modelData['no_pages'])){
      $ret ->set_no_pages($modelData["no_pages"]);
    }

    if(isset($modelData['no_words'])){
      $ret ->set_no_words($modelData["no_words"]);
    }

    if(isset($modelData['format'])){
      $ret ->set_format($modelData["format"]);
    }

    if(isset($modelData['storage_address'])){
      $ret ->set_storage_address($modelData["storage_address"]);
    }

		return $ret;

	}


  private static function generateTag($modelData) {
		$ret = new Tag();
    if (isset($modelData['tag_id'])) {
			$ret ->set_id($modelData["tag_id"]);
		}

		if (isset($modelData['tag_name'])) {
			$ret ->set_name($modelData["tag_name"]);
		}
    return $ret;
  }

  private static function generateDiscipline($modelData){
    $ret = new Discipline();
    if(isset($modelData['discipline_id'])){
      $ret->set_id($modelData['discipline_id']);
    }if(isset($modelData['discipline_name'])){
      $ret->set_name($modelData['discipline_name']);
    }
    return $ret;
  }

  private static function generateStatus($modelData){
    $ret = new Status();
    if(isset($modelData['status_id'])){
      $ret->set_id($modelData['status_id']);
    }if(isset($modelData['status_name'])){
      $ret->set_name($modelData['status_name']);
    }
    return $ret;
  }
}
?>
