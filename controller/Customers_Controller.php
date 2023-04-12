<?php 
  class Customers_Controller extends Base_Controller {


        function table () {

            
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['truycap'] == 1) {
                        $getCustomers = $this->model->get('customers');
            
                        $data = array (
                              'customers' => $getCustomers,
                        );
            
                        $this->view->load('index', $data);
                        die();
                  }

                  if ($key == 2 && $value['truycap'] !== 1) {
                        $error = array (
                              'name' => "Thất bại",
                              'content' => "Bạn không có quyền truy cập nội dung này !",
                        );

                        $data = array (
                             'error' => $error,
                             'fail' => true
                        );

                        $this->view->load('index', $data);
                  }
            }
      }

      function add () {
            
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['them'] == 1) { 
                        if (isset($_POST['submit_add'])) {

                        
                              if ($_POST['last_name'] == "" || $_POST['first_name'] == "" || $_POST['sex'] == "" || $_POST['birthday'] == "" 
                                   || $_POST['phone'] == "" || $_POST['email'] == "" || $_POST['address'] == ""
                              ) {
                                    $error = array(
                                          'name' => "Warning !",
                                          'content' => "Vui lòng nhập dầy đủ các trường !"
                                    );
 
                                    $data = array (
                                          'error' => $error,
                                          'fail' => true
                                    );
                        
                                    $this->view->load('index', $data);
                                    die();
                              } 
                        
                        $date = $this->date->getCurentDate();
                                    
                        $this->model->post('customers', 
                              array (
                                          'last_name' => $_POST['last_name'],
                                          'first_name' => $_POST['first_name'],
                                          'sex' => $_POST['sex'],
                                          'birthday' => $_POST['birthday'],
                                          'phone' => $_POST['phone'],
                                          'email' => $_POST['email'],
                                          'address' => $_POST['address'],
                                          'note' => $_POST['note'],
                                          'date' => $date,
                                          )
                                    );

                              $date = $this->date->getDateTime();
                              $this->model->post('historys',
                                    array (
                                          'id_page' => '2',
                                          'date' => $date,
                                          'id_nhanvien' => $_SESSION['id'],
                                          'noidung' => $_SESSION['username'] .' đã thêm mới khách hàng với tên ' . $_POST['last_name']. "" . $_POST['first_name'],
                                    )
                              );

                              $error = array (
                                    'name' => "Thành công !",
                                    'content' => "Thêm mới thành công !",
                              );
      
                                    $getCustomers = $this->model->get('customers');
                                    
                              $data = array (
                                    'customers' => $getCustomers,
                                    'error' => $error,
                                    'success' => true
                              );
                  
                              
                              $this->view->load('index', $data);
                              die();
                  }
                  $this->view->load('index');
                  die();
                              
            }
                  if ($key == 2 && $value['them'] !== 1) {

                        $error = array (
                              'name' => "Thất bại",
                              'content' => "Bạn không có quyền thêm mới nội dung này !",
                        );

                        $data = array (
                              'error' => $error,
                              'fail' => true
                        );
            
                        $this->view->load('index', $data);
                        die();
                  }

            }

            $this->view->load('index');
      }

      function edit($id) {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['sua'] == 1) { 
                        $getCustomer_edit = $this->model->getOne('customers', $id);
              
                         if (isset($_POST['submit_update'])) {    
                                
                                      $this->model->update('customers', $id,
                                      array (
                                                  'last_name' => $_POST['last_name'],
                                                  'first_name' => $_POST['first_name'],
                                                  'sex' => $_POST['sex'],
                                                  'birthday' => $_POST['birthday'],
                                                  'phone' => $_POST['phone'],
                                                  'email' => $_POST['email'],
                                                  'address' => $_POST['address'],
                                                  'note' => $_POST['note'],
                                            )
                                      );

                                      $error = array(
                                          'name' => 'Thành công !',
                                          'content' => 'Cập nhật khách hành thành công !',
                                      );

                                      $date = $this->date->getDateTime();
                                      $this->model->post('historys',
                                            array (
                                                  'id_page' => '2',
                                                  'date' => $date,
                                                  'id_nhanvien' => $_SESSION['id'],
                                                  'noidung' => $_SESSION['username'] .' đã chỉnh sửa khách hàng ' . $_POST['last_name']. "" . $_POST['first_name'],
                                            )
                                      );
              
                                      $getCustomers = $this->model->get('customers');
              
                                      $data = array (
                                            'customers' => $getCustomers,
                                            'error' => $error,
                                            'success' => true
                                      );
              
                                      $this->view->load('index', $data);
                                      die();
                                }
              
                          $data = array (
                                'customer_edit' => $getCustomer_edit
                           );
              
                         $this->view->load('index', $data);
                  } 
                  if ($key == 2 && $value['sua'] !== 1) { 
                        $error = array(
                              'name' => 'Thất bại!',
                              'content' => 'Bạn không có quyền chính sửa nội dung này !',
                          );
  
                          $getCustomers = $this->model->get('customers');
  
                          $data = array (
                                'customers' => $getCustomers,
                                'error' => $error,
                                'fail' => true
                          );
  
                          $this->view->load('index', $data);
                          die();
                  }
            }
      }



      function delete ($id) {
            $customer = $this->db->query("SELECT * FROM khachhang WHERE id_khachhang = '$id'");
            $row = $customer->fetch_assoc();
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['xoa'] == 1) { 
                        $this->model->delete('customers',$id);

                        $error = array(
                              'name' => 'Thành công !',
                              'content' => 'Xóa thành công !',
                          );
  
                          $getCustomers = $this->model->get('customers');
  
                          $data = array (
                                'customers' => $getCustomers,
                                'error' => $error,
                                'success' => true
                          );

        
                          $date = $this->date->getDateTime();
                          $this->model->post('historys',
                                array (
                                      'id_page' => '2',
                                      'date' => $date,
                                      'id_nhanvien' => $_SESSION['id'],
                                      'noidung' => $_SESSION['username'] .' đã xóa khách hàng ' . $row['tenlot'] . ' ' . $row['tenkhachhang'],
                                )
                          );
  
  
                          $this->view->load('index', $data);
                          die();
                  }

                  if ($key == 2 && $value['xoa'] !== 1) { 
                        $error = array(
                              'name' => 'Thất bại !',
                              'content' => 'Bạn không có quyền xóa nội dung này !',
                          );
  
                          $getCustomers = $this->model->get('customers');
  
                          $data = array (
                                'customers' => $getCustomers,
                                'error' => $error,
                                'fail' => true
                          );
  
                          $this->view->load('index', $data);
                          die();
                  }
            }
            

      }
  }
