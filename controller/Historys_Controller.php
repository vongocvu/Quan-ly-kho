<?php 
    class Historys_Controller extends Base_Controller 
    {
       function table () {
            $getHistorys = $this->model->get('historys');

            $data = array(
                  'Historys' => $getHistorys
            );

            
       }
    }
 
?>