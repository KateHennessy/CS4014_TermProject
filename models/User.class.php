<!--Based on UL-BuynSell example -->
<?php
require_once __DIR__."/../database/DatabaseQueries.php";
class User {
    /*http://www.kjetil-hartveit.com/blog/1/setter-and-getter-generator-for-php-javascript-c%2B%2B-and-csharp*/

    private $id;
    private $email;
    private $first_name;
    private $last_name;
    private $password;
    private $discipline;
    private $tags;

    function set_id($id) { $this->id = $id; }
    function get_id() { return $this->id; }
    function set_email($email) { $this->email = $email; }
    function get_email() { return $this->email; }
    function set_first_name($first_name) { $this->first_name = $first_name; }
    function get_first_name() { return $this->first_name; }
    function set_last_name($last_name) { $this->last_name = $last_name; }
    function get_last_name() { return $this->last_name; }
    function set_password($password) { $this->password = $password; }
    function get_password() { return $this->password; }
    function set_discipline($discipline) { $this->discipline = $discipline; }
    function get_discipline(){return $this->discipline;}
    function set_tags($tags) { $this->tags = $tags; }
    function get_tags(){return $this->tags;}

    function find_id(){     //finds id of user in database from their email - used after user just inserted
      $dbquery = new DatabaseQueries();
      $db = $dbquery->connect_db();
      $result = $db -> prepare ("SELECT user_id FROM user WHERE email = '" .$this->email ."';");
      $result -> execute();
      $row = $result -> fetch(PDO::FETCH_ASSOC);
      return $row['user_id'];
    }


}
?>
