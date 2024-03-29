<?php
require_once __DIR__."/../utils/ModelFactory.class.php";
require_once __DIR__."/../utils/PDOAccess.class.php";
require_once __DIR__."/../daos/TagDAO.class.php";
class UserDAO{
    public static function getUserByEmail($email) {
        $user = null;
        if (!is_null($email)) {
					$query = "SELECT * FROM user WHERE email =" .PDOAccess::prepareString($email) .";";
            $result = PDOAccess::returnSQLquery($query);
            if ($result) {
							$row = $result -> fetch(PDO::FETCH_ASSOC);
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
              $user = ModelFactory::buildModel("User", $row);
          }
      }
      return $user;
		}
    public static function find_all_banned_users(){
      $bannedUsers = array();
      $query = "SELECT * FROM user WHERE user_id  IN
      (SELECT user_id FROM banned_users);";
      $result = PDOAccess::returnSQLquery($query);
        if ($result) {
        foreach($result as $row){
          $user = ModelFactory::buildModel("User", $row);
        }
      }
      return $bannedUsers;

    }


    public static function find_user_in_banned($user_id){
      $bannedUser = NULL;
      $query = "(SELECT * FROM user WHERE user_id  IN
      (SELECT user_id FROM banned_user WHERE user_id = ".$user_id .'));';
      $result = PDOAccess::returnNoRows($query);



      // if($result){
    //     echo($result->rowCount());
    if($result > 0){

        return true;
      }else{

        return false;
      }
    }


		public static function save($user) {
      if (is_null($user->get_id())) {
          self::insert($user);
      }else {
          self::update($user);
      }
      return $user;
    }

	  private static function insert(&$user) {
  		// First - insert user into Database
  		date_default_timezone_set('Europe/Dublin');
  		$date = date('Y-m-d H:i:s', time());
  		$query = "INSERT INTO `user` (`user_id`, `f_name`,
  			`l_name`, `email`, `pass`, `discipline_id`, `reputation`,
  			 `signup_date`) VALUES ( NULL," .PDOAccess::prepareString($user->get_first_name()) .","
  			 .PDOAccess::prepareString($user->get_last_name()) ."," .PDOAccess::prepareString($user->get_email()) .","
  			 .PDOAccess::prepareString($user->get_password()) ."," .PDOAccess::prepareString($user->get_discipline()->get_id())
  			 .",'0','" .$date ."');";

  			 $result = PDOAccess::insertSQLquery($query);
         //Next - add users tags to the user_tag table
          if ($result) {
  					  $tags = array();
  						$tags = $user->get_tags();
  						$user = self::getUserByEmail($user->get_email());
  						$user_id = $user->get_id();
  						for($i = 0; $i < count($tags); $i++){
  							$tagdao = new TagDAO();
  								$tagdao->insertUserTag($user_id, $tags[$i]->get_id());
  						}
          } else {
              $user = null;
          }
    }

    private static function update(&$user){
      $query = 'UPDATE `user` SET `f_name` = '.PDOAccess::prepareString($user->get_first_name())
      .', `l_name` = ' .PDOAccess::prepareString($user->get_last_name())
      .', `pass` = ' .PDOAccess::prepareString($user->get_password())
      .', `discipline_id` = ' .PDOAccess::prepareString($user->get_discipline()->get_id())
      .' WHERE `user`.`user_id` = ' .$user->get_id() .';';

       $result = PDOAccess::insertSQLquery($query);
       if ($result) {
         $user = UserDAO::getUserByID($user->get_id());
       }
    }

		public static function login($email, $password) {
		 		$user = self::getUserByEmail($email);
		 		if (!is_null($user)) {
		 			$id = $user->get_id();
		 			$passwordHash = $user->get_password();
		 			$siteSalt  = "hPxmjz6hJc";
		 			$saltedHash = hash('sha256', $password.$siteSalt);
		 			if ($passwordHash == $saltedHash) {

		 				return $user;
		 			}
          //echo("not the same");
		         return null;
		 		}
		 	}


      public static function ban_user($user_id){
          $banned = false; // boolean to be used if exists in banned users
        if(!is_null($user_id)){

          $bannedUsers = self::find_all_banned_users();
          foreach($bannedUsers as $bannedUser){
            if($bannedUser->get_id() == $user_id){
              $banned = true;
            }
          }
          if(!$banned){
            date_default_timezone_set('Europe/Dublin');
           $date = date('Y-m-d H:i:s', time());
            $query = 'INSERT INTO `banned_user` (`user_id`, `timestamp`) VALUES ('
            .PDOAccess::prepareString($user_id) .', ' .PDOAccess::prepareString($date) .' );';
            // echo($query);

             $result = PDOAccess::insertSQLquery($query);
             if($result){
               $banned = true;

             }
          }
        }
        return $banned;
      }

      public static function change_password($user, $new_password){
        if(!is_null($user)){
          return PDOAccess::insertSQLquery("UPDATE user SET pass = " .PDOAccess::prepareString($new_password)  ."WHERE email = ".PDOAccess::prepareString($user->get_email()) .";");

        }else{
          return false;
        }
      }

      public static function change_user_reputation(&$user, $points){
        if(!is_null($user)){
          // $currentPoints = $user->get_reputation();
          // $newPoints = $currentPoints + $points;
          // $query = 'UPDATE user SET reputation = ' .$newPoints .' WHERE email = ' .PDOAccess::prepareString($user->get_email()) .';';
          // $result = PDOAccess::insertSQLquery($query);
          $args = array();
          $args[] = $user->get_id();
          $args[] = $points;
          $result = PDOAccess::call('UpdateUserReputation',$args);
          $user = self::getUserById($user->get_id());
          return $result > 0;
        }else{
          return false;
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
