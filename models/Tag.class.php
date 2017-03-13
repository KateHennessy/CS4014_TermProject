<?php
require_once __DIR__."/../database/DatabaseQueries.php";
class Tag {

    /*http://www.kjetil-hartveit.com/blog/1/setter-and-getter-generator-for-php-javascript-c%2B%2B-and-csharp*/

    private $id;
    private $name;

    function set_id($id) { $this->id = $id; }
    function get_id() { return $this->id; }
    function set_name($name) { $this->name = $name; }
    function get_name() {return $this->name; }


    function find_id(){
      $dbquery = new DatabaseQueries();
      $db = $dbquery->connect_db();
      $result = $db -> query ("SELECT tag_id FROM tag WHERE tag_name = '" .$this->name ."';");
      $result -> execute();
      $row = $result -> fetch(PDO::FETCH_ASSOC);
      return $row['tag_id'];
    }

    function find_name(){
      $db = DatabaseQueries::connect_db();
      $result = $db -> query ("SELECT tag_name FROM tag WHERE tag_id = '" .$id ."';");
      $result -> execute();
      $row = $result -> fetch(PDO::FETCH_ASSOC);
      return $row['tag_id'];
    }

}
?>
