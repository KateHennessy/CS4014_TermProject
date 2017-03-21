<?php
class Task{
  /*http://www.kjetil-hartveit.com/blog/1/setter-and-getter-generator-for-php-javascript-c%2B%2B-and-csharp*/
  private $id;
  private $creator_id;
  private $claimer_id;
  private $title;
  private $type;
  private $description;
  private $claim_deadline;
  private $completion_deadline;
  private $no_pages;
  private $no_words;
  private $format;
  private $storage_address;
  private $tags;
  private $status;
  private $score;

  function set_id($id) { $this->id = $id; }
  function get_id() { return $this->id; }
  function set_creator_id($creator_id) { $this->creator_id = $creator_id; }
  function get_creator_id() { return $this->creator_id; }
  function set_claimer_id($claimer_id) { $this->claimer_id = $claimer_id; }
  function get_claimer_id() { return $this->claimer_id; }
  function set_title($title) { $this->title = $title; }
  function get_title() { return $this->title; }
  function set_type($type) { $this->type = $type; }
  function get_type() { return $this->type; }
  function set_description($description) { $this->description = $description; }
  function get_description() { return $this->description; }
  function set_claim_deadline($claim_deadline) { $this->claim_deadline = $claim_deadline; }
  function get_claim_deadline() { return $this->claim_deadline; }
  function set_completion_deadline($completion_deadline) { $this->completion_deadline = $completion_deadline; }
  function get_completion_deadline() { return $this->completion_deadline; }
  function set_no_pages($no_pages) { $this->no_pages = $no_pages; }
  function get_no_pages() { return $this->no_pages; }
  function set_no_words($no_words) { $this->no_words = $no_words; }
  function get_no_words() { return $this->no_words; }
  function set_format($format) { $this->format = $format; }
  function get_format() { return $this->format; }
  function set_storage_address($storage_address) { $this->storage_address = $storage_address; }
  function get_storage_address() { return $this->storage_address;}
  function set_tags($tags){$this->tags = $tags;}
  function get_tags(){return $this->tags;}
  function set_status($status){$this->status = $status;}
  function get_status(){return $this->status;}
  function set_score($score){$this->score = $score;}
  function get_score(){return $this->score;}



}


 ?>
