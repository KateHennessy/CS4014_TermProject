<?php
require_once __DIR__."/../models/User.class.php";

class ModelFactory {
    public static function buildModel($modelName, $modelData) {

        $ret = null;
        switch($modelName) {
            case "User":
                $ret = self::generateUser($modelData);
                break;
			default:
                echo "Unable to build model $modelName";
		}

		return $ret;
    }

	private static function generateUser($modelData) {
		$ret = new User();

		if (isset($modelData['id'])) {
			$ret ->set_id($modelData["id"]);
		}

		if (isset($modelData['first_name'])) {
			$ret ->set_first_name($modelData["first_name"]);
		}

		if (isset($modelData['last_name'])) {
			$ret ->set_last_name($modelData["last_name"]);
		}

		if (isset($modelData['email'])) {
			$ret ->set_email($modelData["email"]);
		}

		if (isset($modelData['password'])) {
			$ret ->set_password($modelData["password"]);
		}

    if(isset($modelData['discipline'])){
      $ret ->set_discipline($modelData["discipline"]);
    }

    if(isset($modelData['tags'])){
      $ret ->set_tags($modelData["tags"]);
    }
		return $ret;
	}

}
?>
