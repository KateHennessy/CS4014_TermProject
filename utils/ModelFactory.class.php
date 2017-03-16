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
                break;
            case "Discipline":
                $ret = self::generateDiscipline($modelData);
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
}
?>
