<?php

class FT_Model_Loader
{
    
    public function get($model)
    {

         // Chuyển đổi tên model vì nó có định dạng là {Name}_Model
        $model = ucfirst(strtolower($model)) . '_Model';
        require_once PATH_APPLICATION . '/model/' . $model . '.php';
        
        $MODEL = new $model();

         $result = $MODEL->get();

         return $result;
    }

    public function get_join($model)
    {

         // Chuyển đổi tên model vì nó có định dạng là {Name}_Model
        $model = ucfirst(strtolower($model)) . '_Model';
        require_once PATH_APPLICATION . '/model/' . $model . '.php';
        
        $MODEL = new $model();

         $result = $MODEL->get_join();

         return $result;
    }

    public function getOne($model, $id)
    {

         // Chuyển đổi tên model vì nó có định dạng là {Name}_Model
        $model = ucfirst(strtolower($model)) . '_Model';
        require_once PATH_APPLICATION . '/model/' . $model . '.php';
        
        $MODEL = new $model();

         $result = $MODEL->getOne($id);

         return $result;
    }


    public function post($model, $data)
    {
         // Chuyển đổi tên model vì nó có định dạng là {Name}_Model
           $model = ucfirst(strtolower($model)) . '_Model';

           require_once PATH_APPLICATION . '/model/' . $model . '.php';

           //Khởi tạo Model
           $MODEL = new $model();
           
           //Chạy function post trong Model
           $result = $MODEL->post($data);

           return $result;

    }

    public function delete($model, $id)
    {
         // Chuyển đổi tên model vì nó có định dạng là {Name}_Model
        $model = ucfirst(strtolower($model)) . '_Model';
        require_once PATH_APPLICATION . '/model/' . $model . '.php';
        
         $MODEL = new $model();

         $MODEL->delete($id);
         
    }

    public function update($model, $id, $data) {
          $model = ucfirst(strtolower($model)) . '_Model';
          require_once PATH_APPLICATION . '/model/' . $model . '.php';
          
          $MODEL = new $model();

          $MODEL->update($id, $data);
    }

}

?>