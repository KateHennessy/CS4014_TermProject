<?php
require_once __DIR__."/../utils/ModelFactory.class.php";
require_once __DIR__."/../utils/PDOAccess.class.php";
require_once __DIR__."/../daos/TagDAO.class.php";
class UserDAO{
    public static function getUserByEmail($email) {
        $user = null;
        if (!is_null($email)) {
					echo(PDOAccess::prepareString($email) .'<br />');
					$query = "SELECT * FROM user WHERE email =" .PDOAccess::prepareString($email) .";";
            $result = PDOAccess::returnSQLquery($query);
            if ($result) {
							$row = $result -> fetch(PDO::FETCH_ASSOC);
							print_r("<br />id: " .$row['user_id'] ."<br />");
                $user = ModelFactory::buildModel("User", $row);
            }
        }
        return $user;
    }
		public static function getUserByID($user_id) {
      $user = null;
      if (!is_null($user_id)) {
				$query = "SELECT * FROM user WHERE user_id =" .PDOAccess::prepareString($user_id) .";";
          $result = PDOAccess::returnSQLquery($query);
          if ($result) {
						$row = $result -> fetch(PDO::FETCH_ASSOC);
						// print_r("<br />id: " .$row['user_id'] ."<br />");
              $user = ModelFactory::buildModel("User", $row);
          }
      }
      return $user;
		}
				public static function save($user) {
        if (is_null($user->get_id())) {
            self::insert($user);
        }/*else {
            self::update($user);
        }*/
        return $user;
    }
	private static function insert(&$user) {
		// First insert user into Database
		date_default_timezone_set('Europe/Dublin');
		$date = date('Y-m-d H:i:s', time());
		$query = "INSERT INTO `user` (`user_id`, `f_name`,
			`l_name`, `email`, `pass`, `discipline_id`, `reputation`,
			 `signup_date`) VALUES ( NULL," .PDOAccess::prepareString($user->get_first_name()) .","
			 .PDOAccess::prepareString($user->get_last_name()) ."," .PDOAccess::prepareString($user->get_email()) .","
			 .PDOAccess::prepareString($user->get_password()) ."," .PDOAccess::prepareString($user->get_discipline()->get_id())
			 .",'0','" .$date ."');";
			 $result = PDOAccess::insertSQLquery($query);
        if ($result) {
					  $tags = array();
						$tags = $user->get_tags();
						$user = self::getUserByEmail($user->get_email());
						$user_id = $user->get_id();
						echo(count($tags) ." tags <br />");
						for($i = 0; $i < count($tags); $i++){
							$tagdao = new TagDAO();
								$tagdao->insertUserTag($user_id, $tags[$i]->get_id());
						}
						echo("user: " .$user->get_id());
        } else {
					echo("Null");
            $user = null;
        }

    }
public static function logout() {
		/*http://php.net/manual/en/function.session-unset.php*/
		if (!isset ($_SESSION)) {
			session_start();
		}
		session_unset();
		session_destroy();
		session_write_close();
		session_regenerate_id(true);
	}
}
?>
