<?php
require_once __DIR__."/../database/DatabaseQueries.php";
class Tag {

    /*http://www.kjetil-hartveit.com/blog/1/setter-and-getter-generator-for-php-javascript-c%2B%2B-and-csharp*/

    private $tag_id;
    private $tag_name;

    function set_id($tag_id) { $this->tag_id = $tag_id; }
    function get_id() { return $this->tag_id; }
    function set_name($tag_name) { $this->tag_name = $tag_name; }
    function get_name() {return $this->tag_name; }


    // function find_id(){
    //   $dbquery = new DatabaseQueries();
    //   $db = $dbquery->connect_db();
    //   $result = $dbquery->returnSQLquery("SELECT tag_id FROM tag WHERE tag_name = '" .$this->name ."';");
    //   $row = $result -> fetch(PDO::FETCH_ASSOC);
    //   return $row['tag_id'];
    // }
    //
    // function find_name(){
    //   $db = DatabaseQueries::connect_db();
    //   $result = $db -> prepare ("SELECT tag_name FROM tag WHERE tag_id = '" .$id ."';");
    //   $result -> execute();
    //   $row = $result -> fetch(PDO::FETCH_ASSOC);
    //   return $row['tag_id'];
    // }

}
?>
