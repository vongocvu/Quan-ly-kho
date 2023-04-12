<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Base_Model extends FT_Model
{
    protected $db;

    public function __construct() {
      $this->db = $this->__connect();
    }
}

?>