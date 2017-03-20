<!-- Taken from UL-BuynSell example on moodle -->
<?php
require_once __DIR__."/Settings.class.php";

class PDOAccess {

	private $error_msg     = '';
	private $connection;
	private static $instance = null;


	private function __construct() { //Constructor - called on instance created
		$this->openConnection();
	}

	public static function getInstance() {
        if (!is_null(PDOAccess::$instance)) {
            return PDOAccess::$instance;
        } else {
            PDOAccess::$instance = new PDOAccess();
            return PDOAccess::$instance;
        }
    }

    private function openConnection() {
		$conn = false;
		$ret = false;


        $db_name = Settings::get('database.database');
        $db_host = Settings::get('database.server');
        $server_port = Settings::get('database.server_port');
        $db_username = Settings::get('database.username');
        $db_pass = Settings::get('database.password');

        try{
          $conn = new PDO ('mysql:host ='. $db_host.';dbname='.$db_name.';port='.$server_port,
           $db_username, $db_pass);
        }catch(PDOException $e){
           echo 'Connection failed: ' . $e->getMessage();
           return NULL;
        }

		if (!$conn) {
            $this->error_msg = "\r\n" . "Unable to connect to database - " . date('H:i:s');
            $ret = false;
        } else {
            $this->connection = $conn;
            $ret = true;
        }
        return $ret;
	}

  public static function insertSQLquery($query){
    $db = self::getInstance();
    $conn = $db->connection;
    $result = $conn -> prepare($query);
    if($result){
        $result-> execute();
				return true;
    }else{
      echo("issue with insert");
      return NULL;
    }

    // return $result-> execute();
    // $result -> execute();

      // return $result -> execute();

  }

  public static function returnSQLquery($query){
    $db = PDOAccess::getInstance();
    $conn = $db->connection;

      $result = $conn->query($query);
      // print_r("Result: " .$result);
      return $result;
  // if($result){
  //     foreach ($result as $row) {
  //             $data[] = $row;
  //         }
  //         print_r($data);
  //         return $data;
  //   }else{
  //     echo("noResult");
  //     return false;
  //   }
  }


	public static function prepareString($string) {
    $db = PDOAccess::getInstance();
    $conn = $db->connection;
		return $conn->quote($string);
	}
}
?>