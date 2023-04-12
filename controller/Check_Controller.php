<?php 
   class Check_Controller extends Base_Controller {
       function check_expiry () {
          $this->view->load('index');
       }

       function check_quantity () {
         $this->view->load('index');
      }
   }
?>