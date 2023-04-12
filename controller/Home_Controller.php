<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Home_Controller extends Base_Controller
{
    public function index () {
        if (!isset($_SESSION['roles'])) {
            $this->view->load('login');
       } else {
        $this->view->load('index');
       }
    }
}
