<?php
require_once __DIR__."/../database/DatabaseQueries.php";
class Discipline {

  private $id;
  private $name;

  function set_id($id) { $this->id = $id; }
  function get_id() { return $this->id; }
  function set_name($name) { $this->name = $name; }
  function get_name() {return $this->name; }

  function find_disciplineid(){
    $dbquery = new DatabaseQueries();
    $db = $dbquery->connect_db();
    $result = $db -> prepare ("SELECT discipline_id FROM discipline WHERE discipline_name = '" .$this->name ."';");
    $result -> execute();
    $row = $result -> fetch(PDO::FETCH_ASSOC);

    return $row['discipline_id'];

  }

}
