<?php
require_once __DIR__."/../utils/Settings.class.php";
class DatabaseQueries{

  function connect_db(){
    $db_name = Settings::get('database.database');
    $db_host = Settings::get('database.server');
    $server_port = Settings::get('database.server_port');
    $db_username = Settings::get('database.username');
    $db_pass = Settings::get('database.password');
    try{
      $db = new PDO ('mysql:host ='. $db_host.';dbname='.$db_name.';port='.$server_port, $db_username, $db_pass);
      return $db;
    }catch(PDOException $e){
       echo 'Connection failed: ' . $e->getMessage();
       return NULL;
    }
  }

    function insertSQLquery($query){
      $db = $this -> connect_db();
      $result = $db -> query ($query);
      // echo("result: " .$result);
      if($result){
        $result -> execute();
      }else{
        echo("ERROR WITH INSERTING TO DB");
      }

    }
    function returnSQLquery($query){
      $db = $this -> connect_db();
      $result = $db -> query ($query);
      $result -> execute();
      return $result;
    }

     function addUser($user){
      date_default_timezone_set('Europe/Dublin');
      $date = date('Y-m-d H:i:s', time());

      $query = "INSERT INTO `user` (`user_id`, `f_name`,
        `l_name`, `email`, `pass`, `discipline`, `reputation`,
         `signup_date`) VALUES ( NULL,'" .$user->get_first_name() ."','"
         .$user->get_last_name() ."','" .$user->get_email() ."','"
         .$user->get_password() ."','" .$user->get_discipline() ."','0','" .$date ."');";
         $this->insertSQLquery($query);
         $this->addUserTags($user);
    }


    function addUserTags($user){
     $tags = $user->get_tags();
     for($i = 0; $i < count($tags); $i++){
       $query = "INSERT INTO `user_tag` (`user_id`, `tag_id`, `clicks`) VALUES ('"
       .$user->find_id() ."', '" .$tags[$i]->find_id() ."', '0');";
       $this->insertSQLquery($query);
     }
    }

    function checkUserExists($user){
       $query = "SELECT user_id FROM user WHERE email = '" .$user.get_email() ."';";
       $result = returnSQLquery($query);

    }


  }

?>
