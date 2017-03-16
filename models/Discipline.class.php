<?php
require_once __DIR__."/../database/DatabaseQueries.php";
class Discipline {

  private $id;
  private $name;

  function set_id($id) { $this->id = $id; }
  function get_id() { return $this->id; }
  function set_name($name) { $this->name = $name; }
  function get_name() {return $this->name; }
}
