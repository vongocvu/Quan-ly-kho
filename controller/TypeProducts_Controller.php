<?php 
  class TypeProducts_Controller extends Base_Controller {


      function add ($id) {

            $step1 = true;
            if (empty($_SESSION['add_typeProducts'])) {
                  $_SESSION['add_typeProducts'] = array();
            }
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['truycap'] == 1) {
                        if ($key == 2 && $value['them'] == 1) {

        

                              if (isset($_POST['id_store'])) {


                                    require_once PATH_APPLICATION . '/core/Base_Model.php';
                                    $db = new Base_Model();

                                    
                                    $getStore = $this->model->getOne('store', $id);
                                    $row = $getStore->fetch_assoc();

                                    $id_store = $row['id_kho']; 

                                    $_SESSION['add_typeProducts']['store']['id'] = $id_store;
                                    $_SESSION['add_typeProducts']['store']['name'] = $row['tenkho'];

                                    $CateProducts = $db->conn->query("SELECT * FROM nhomhang WHERE kho = '$id_store'");

                                    $data = array (
                                        'cateProducts' => $CateProducts,
                                        'step1' => $step1,
                                    );
                                    
                                    $this->view->load('index', $data);
                                        die();
 
                              }

                              if (isset($_POST['id_cate'])) {
                                    require_once PATH_APPLICATION . '/core/Base_Model.php';
                                    $db = new Base_Model();
                                    $step1 = false;
                                    
                                    $getCate = $this->model->getOne('cateProducts', $id);
                                    $row = $getCate->fetch_assoc();

                                    $id_cate = $row['id_nhomhang'];
                                    
                                    $_SESSION['add_typeProducts']['cate']['id'] = $id_cate;
                                    $_SESSION['add_typeProducts']['cate']['name'] = $row['tennhomhang'];

                                    $getProducts = $db->conn->query("SELECT * FROM loaihanghoa WHERE nhomhang = '$id_cate'");

                                    $data = array (
                                          'products' => $getProducts,
                                          'step1' => $step1,
                                      );
                                      
                                      $this->view->load('index', $data);
                                          die();
                              }

                              if (isset($_POST['submit_add_type'])) {

                                    $id_cate = $_SESSION['add_typeProducts']['cate']['id'];
                                    $this->model->post('typeProducts', 
                                     array (
                                          'name' => $_POST['name'],
                                          'type_product' => $id_cate,
                                          'note' => $_POST['note'],
                                     )

                                    );

                                    require_once PATH_APPLICATION . '/core/Base_Model.php';
                                    $db = new Base_Model();
                                    
                                    $getProducts = $db->conn->query("SELECT * FROM loaihanghoa WHERE nhomhang = '$id_cate'");

                                    $data = array (
                                          'products' => $getProducts,
                                      );
                                      
                                      $this->view->load('index', $data);
                                          die();
                              }

                              if (isset($_GET['cancel_step2'])) {
                                    $step1 = true;
                                    unset($_SESSION['add_typeProducts']['cate']);
                                    require_once PATH_APPLICATION . '/core/Base_Model.php';
                                    $db = new Base_Model();

                                    $CateProducts = $db->conn->query("SELECT * FROM nhomhang WHERE kho = '$id'");

                                    $data = array (
                                        'cateProducts' => $CateProducts,
                                        'step1' => $step1
                                    );
                                    
                                    $this->view->load('index', $data);
                                        die();
                              }

                              if (isset($_GET['cancel_step1'])) {
                                    unset($_SESSION['add_typeProducts']['store']);
                              }
                              
                              
                        $getStores = $this->model->get('store');

                        $data = array (
                              'stores' => $getStores
                        );
            
                        $this->view->load('index', $data);
                              die();
                        }

                  if ($key == 2 && $value['them'] !== 1) {
                        $error = array (
                              'name' => "Thất bại!",
                              'content' => "Bạn không có quyền thêm nội dung này !",
                          );

                          $data = array (
                              'error' => $error,
                              'fail' => true
                          );

                          $this->view->load('index', $data);
                          die();
                  }
            }

            if ($key == 2) {
                  if ($value['truycap'] !== 1 ) {

                  $error = array (
                        'name' => "Thất bại!",
                        'content' => "Bạn không có quyền truy cập chức năng này !",
                  );
      
                  $data = array (
                        'error' => $error,
                        'fail' => true
                  );
      
                  $this->view->load('index', $data);
                  die();
            }
            }

      }     

}


      function table () {

            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['truycap'] == 1) {

                        $getTypeProducts = $this->model->get_join('typeProducts');
                       
            
                        $data = array (
                              'TypeProducts' => $getTypeProducts,
                        );
            
            
                        $this->view->load('index', $data);
                  }

                  if ($key == 2 && $value['truycap'] !== 1) {
                        $error = array (
                              'name' => "Thất bại!",
                              'content' => "Bạn không có quyền truy cập chức năng này !",
                        );
            
                        $data = array (
                              'error' => $error,
                              'fail' => true
                        );
            
                        $this->view->load('index', $data);
                        die();
                  }
            }

      }

      function edit ($id) {
            
            $getCates = $this->model->get('cateProducts');
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['sua'] == 1) {

                        $getTypeProduct = $this->model->getOne('typeProducts', $id);
                        
                        if (isset($_POST['submit_update'])) {
                              $this->model->update('typeProducts', $id, 
                              array (
                                       'name' => $_POST['name'],
                                       'store' => $_POST['store'],
                                       'note' => $_POST['note'],
                                    ));
                
                              $date = $this->date->getDateTime();
                              $this->model->post('historys',
                              array (
                                    'id_page' => '2',
                                    'date' => $date,
                                    'id_nhanvien' => '1',
                                    'noidung' => 'Võ Ngọc Vũ đã chỉnh sửa thông tin của bộ phận ' . $_POST['name'],
                                    )
                              );

                              $error = array (
                                    'name' => "Thành công !",
                                    'content' => "Cập nhật thành công !",
                              );
                              
                              $getTypeProducts = $this->model->get_join('typeProducts');

                              $data = array (
                                    'TypeProducts' => $getTypeProducts,
                                    'cates' => $getCates,
                                    'error' => $error,
                                    'success' => true
                              );
                  
                              $this->view->load('index', $data);
                              die();
                        }
                
                        $data = array (
                              'TypeProduct_edit' => $getTypeProduct,
                              'cates' => $getCates,
                        );
                
                        $this->view->load('index', $data);
                        die();
                  }

                  if ($key == 2 && $value['sua'] !== 1) {
                        $error = array (
                              'name' => "Thất bại!",
                              'content' => "Bạn không có quyền thực hiện chức năng này !",
                        );
            
                        $getTypeProducts = $this->model->get_join('typeProducts');
                        $data = array (
                              'TypeProducts' => $getTypeProducts,
                              'cates' => $getCates,
                              'error' => $error,
                              'fail' => true
                        );
            
                        $this->view->load('index', $data);
                        die();
                  }
            }

  }

     function delete ($id) {
      $getStores = $this->model->get('store');
      foreach ($_SESSION['function'] as $key => $value) {
            if ($key == 2 && $value['xoa'] == 1) {
                  $this->model->delete('typeProducts', $id);
                  $error = array (
                        'name' => "Thành công !",
                        'content' => "Xóa thành công !",
                  );
                    
                  $getTypeProducts = $this->model->get_join('typeProducts');
                  $data = array (
                        'TypeProducts' => $getTypeProducts,
                        'stores' => $getStores,
                        'error' => $error,
                        'success' => true
                  );
      
                  $this->view->load('index', $data);
                  die();

            }

            if ($key == 2 && $value['xoa'] != 1) {
                  $error = array (
                        'name' => "Thất bại !",
                        'content' => "Bạn không có quyền thực hiện chức năng này !",
                  );
                    
                  $getTypeProducts = $this->model->get_join('typeProducts');
                       
                  $data = array (
                        'TypeProducts' => $getTypeProducts,
                        'stores' => $getStores,
                        'error' => $error,
                        'fail' => true
                  );
      
                  $this->view->load('index', $data);
                  die();
            }
      }
     }
  }

?>