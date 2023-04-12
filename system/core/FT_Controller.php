<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');




class FT_Controller
{
    // Đối tượng view
    protected $view     = NULL;
    
    // Đối tượng model
    protected $model    = NULL;
    

    // Đối tượng model
    protected $date    = NULL;

    // Đối tượng accents

    protected $accents = NULL;
     
      public function __construct() 
      {
      
      // Load View
      require_once PATH_SYSTEM . '/core/loader/FT_View_Loader.php';

      $this->view = new FT_View_Loader();

      //Load model
      require_once PATH_SYSTEM . '/core/loader/FT_Model_Loader.php';

      $this->model = new FT_Model_Loader();

      //Load date
      require_once PATH_SYSTEM . '/core/loader/FT_Date_Loader.php';

      $this->date = new FT_Date_Loader();


      require_once PATH_SYSTEM . '/core/loader/FT_Accents_Loader.php';

      $this->accents = new FT_Accents_Loader();



         
      }
}

?>