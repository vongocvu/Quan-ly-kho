<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');
require_once PATH_APPLICATION . '/core/Base_Model.php';
class Base_Controller extends FT_Controller
{

    protected $db;
    public function __construct() 
    {
        parent::__construct();
        $database = new Base_Model();
        $this->db = $database->conn;
    }
    
    // Hàm hủy này có nhiệm vụ show nội dung của view, lúc này các controller
    // không cần gọi đến $this->view->show nữa
    public function __destruct() 
    {
        $this->view->show();
    }
}

?>