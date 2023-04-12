<?php 
  class CateProducts_Controller extends Base_Controller {


      function add () {
            $getStores = $this->model->get('store');

            
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['them'] == 1) {
                              if (isset($_POST['submit_add'])) {


                             if ($_POST['name'] == "" || $_POST['expiry'] == "") {
                                    $getCateProducts = $this->model->get('cateProducts');
                  
                                    $error = array (
                                          'name' => 'Warning ! !',
                                          'content' => 'Bạn chưa nhập đủ các trường !',
                                    );
                                    
                                    
                                    $data = array(
                                          'CateProducts' => $getCateProducts,
                                          'stores' => $getStores,
                                          'error' => $error,
                                          'fail' => true
                                    );
                                    
                                    $this->view->load('index', $data);
                                    die();
                             }
 

                              $this->model->post('cateProducts',
                                    array (
                                       'name' => $_POST['name'],
                                       'expiry' => $_POST['expiry'],
                                       'note' => $_POST['note'],
                                    )
                              );
                               
                              $error = array (
                                    'name' => 'Thành công !',
                                    'content' => 'Thêm loại sản phẩm thành công !',
                              );

                              $date = $this->date->getDateTime();
                              $this->model->post('historys',
                                 array (
                                     'id_page' => '2',
                                     'date' => $date,
                                     'id_nhanvien' => $_SESSION['id'],
                                     'noidung' => $_SESSION['username'] .' đã thêm nhóm hàng mới với tên là ' . $_POST['name'],
                                 )
                              );
                                 

                                $data = array(
                                      'stores' => $getStores,
                                      'error' => $error,
                                      'success' => true
                                );
                    
                                $this->view->load('index', $data);
                                die();
                        }

                         $data = array(
                                      'stores' => $getStores,
                                );
                    
                                $this->view->load('index', $data);
                                die();

                  }

                        if ($key == 2) {
                              if ($value['them'] !== 1) {
                                    $error = array (
                                          'name' => 'Thất bại !',
                                          'content' => 'Bạn không có quyển thêm nội dung này !',
                                    );
                                    
                                    
                                    $data = array(
                                          'stores' => $getStores,
                                          'error' => $error,
                                          'fail' => true
                                    );
                                    
                                    $this->view->load('index', $data);
                                    die();
                              }
                        }
            }

            $data = array(
                  'stores' => $getStores,
            );

            $this->view->load('index', $data);
            die();

      }


      function table () {

            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['truycap'] == 1) {

                        $getCateProducts = $this->model->get('cateProducts');
            
                        $data = array (
                              'CateProducts' => $getCateProducts,
                        );
            
                        $this->view->load('index', $data);
                        die();
                  }

                  if ($key == 2 && $value['truycap'] !== 1) {
                        $error = array (
                              'name' => 'Thất bại !',
                              'content' => 'Bạn không có quyển truy cập nội dung này !',
                        );

                        $data = array (
                              'error' => $error,
                              'fail' => true
                        );
            
                        $this->view->load('index', $data);
                  }

            }
      }

      function edit ($id) {
            $check = 0;

            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2  && $value['sua'] == 1) {
                        $check++;
                        $getCateProduct = $this->model->getOne('cateProducts', $id);
                        $getStores = $this->model->get('store');
                        
                        if (isset($_POST['submit_update'])) {
                              $this->model->update('cateProducts', $id, 
                              array (
                                       'name' => $_POST['name'],
                                       'expiry' => $_POST['expiry'],
                                       'note' => $_POST['note'],
                                    ));
                
                              $date = $this->date->getDateTime();
                              $this->model->post('historys',
                                 array (
                                     'id_page' => '2',
                                     'date' => $date,
                                     'id_nhanvien' => $_SESSION['id'],
                                     'noidung' => $_SESSION['username'] .' đã chỉnh sửa nhóm hàng ' . $_POST['name'],
                                 )
                              );
                                 

                              $error = array (
                                    'name' => 'Thành công !',
                                    'content' => 'Chỉnh sủa thành công !',
                              );
                                
                              $getCateProducts = $this->model->get('cateProducts');

                              $data = array (
                                    'CateProducts' => $getCateProducts,
                                    'error' => $error,
                                    'success' => true
                              );
                  
                              $this->view->load('index', $data);
                              die();
                        }
                
                        $data = array (
                              'CateProduct_edit' => $getCateProduct,
                              'stores' => $getStores
                        );
                
                        $this->view->load('index', $data);
                        die();
                  } 

                  if ($key == 2  && $value['sua'] !== 1) {
                        $error = array (
                              'name' => 'Thất bại!',
                              'content' => 'Bạn không có quyền chỉnh sửa nội dung này !',
                        );
                          
                        $getCateProducts = $this->model->get('cateProducts');

                        $data = array (
                              'CateProducts' => $getCateProducts,
                              'error' => $error,
                              'fail' => true
                        );    
                        $this->view->load('index', $data);
                  }
            }
  }

     function delete ($id) {
           $cate = $this->db->query("SELECT * FROM nhomhang WHERE id_nhomhang = '$id'");
           $row = $cate->fetch_assoc();
      foreach ($_SESSION['function'] as $key => $value) {
            if ($key == 2 && $value['xoa'] == 1) {

                  $this->model->delete('cateProducts', $id);
                  $error = array (
                        'name' => 'Thành công !',
                        'content' => 'Xóa thành công !',
                  );

                  $getCateProducts = $this->model->get('cateProducts');
                  
            
                  $data = array (
                        'CateProducts' => $getCateProducts,
                        'error' => $error,
                        'success' => true
                  );


                  $date = $this->date->getDateTime();
                  $this->model->post('historys',
                        array (
                              'id_page' => '2',
                              'date' => $date,
                              'id_nhanvien' => $_SESSION['id'],
                              'noidung' => $_SESSION['username'] .' đã xóa nhóm hàng ' . $row['tennhomhang'],
                        )
                  );
      
                  $this->view->load('index', $data);
            }

            if ($key == 2 && $value['xoa'] !== 1) {
                  $error = array (
                        'name' => 'Thất bại !',
                        'content' => 'Bạn không có quyển xóa nội dung này !',
                  );

                  $getCateProducts = $this->model->get('cateProducts');
            
                        $data = array (
                              'CateProducts' => $getCateProducts,
                              'error' => $error,
                              'fail' => true
                        );
      
                  $this->view->load('index', $data);
             }
      }
     }
  }

?>