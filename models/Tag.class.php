<?php
class Tag {
    /*http://www.kjetil-hartveit.com/blog/1/setter-and-getter-generator-for-php-javascript-c%2B%2B-and-csharp*/
    private $tag_id;
    private $tag_name;

    function set_id($tag_id) { $this->tag_id = $tag_id; }
    function get_id() { return $this->tag_id; }
    function set_name($tag_name) { $this->tag_name = $tag_name; }
    function get_name() {return $this->tag_name; }
}


class UserTag extends Tag {
  
  private $clicks;
  function set_clicks($clicks) { $this->clicks = $clicks; }
  function get_clicks() { return $this->clicks; }

}
?>
