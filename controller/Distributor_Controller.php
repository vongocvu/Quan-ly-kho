<?php 
  class Distributor_Controller extends Base_Controller {

      function add () {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['them'] == 1) { 
                              if (isset($_POST['submit_add'])) {


                              $date = $this->date->getDateTime();
                              $this->model->post('distributor',
                                    array (
                                       'name' => $_POST['name'],
                                       'taxcode' => $_POST['taxcode'],
                                       'phone' => $_POST['phone'],
                                       'email' => $_POST['email'],
                                       'address' => $_POST['address'],
                                       'date' => $date,
                                       'note' => $_POST['note'],
                                    )
                                );

                                $error = array (
                                    'name' => "Thành công !",
                                    'content' => "Thêm thành công !"
                                );

                                $data = array (
                                    'error' => $error,
                                    'success' => true
                                );

                                $date = $this->date->getDateTime();
                                $this->model->post('historys',
                                      array (
                                            'id_page' => '2',
                                            'date' => $date,
                                            'id_nhanvien' => $_SESSION['id'],
                                            'noidung' => $_SESSION['username'] .' đã thêm mới nhà phân phối ' . $_POST['name']
                                      )
                                );
        

                                $this->view->load('index', $data);
                                die();
                        }

                        $this->view->load('index');
                        die();

                  }
                  
                  if ($key == 2 && $value['them'] !== 1) { 

                        $error = array (
                              'name' => "Thất bại !",
                              'content' => "Bạn không có quyền thêm nội dung này !"
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


      function table () {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['truycap'] == 1) { 

                        $getDistributors = $this->model->get('distributor');

                        $data = array (
                              'distributors' => $getDistributors,
                        );
            
                        $this->view->load('index', $data);
                  }

                  if ($key == 2 && $value['truycap'] !== 1) { 
                        $error = array (
                              'name' => "Thất bại !",
                              'content' => "Bạn không có quyền truy cập nội dung này !"
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
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['truycap'] == 1 && $value['sua'] == 1 ) { 
                        $getDistributor = $this->model->getOne('distributor', $id);
                        if (isset($_POST['submit_update'])) {
                              $this->model->update('distributor', $id, 
                              array (
                                       'name' => $_POST['name'],
                                       'taxcode' => $_POST['taxcode'],
                                       'phone' => $_POST['phone'],
                                       'email' => $_POST['email'],
                                       'address' => $_POST['address'],
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
                                
                              $getDistributors = $this->model->get('distributor');

                              $error = array (
                                    'name' => "Thành công !",
                                    'content' => "Cập nhật thành công !"
                                );

                              $data = array (
                                    'distributors' => $getDistributors,
                                    'error' => $error,
                                    'success' => true
                              );
              
                             
                  
                              $this->view->load('index', $data);
                              die();
                        }
                
                        $data = array (
                              'distributor_edit' => $getDistributor,
                        );
                
                        $this->view->load('index', $data);

                  }

                  if ($key == 2 && $value['truycap'] !== 1 && $value['sua'] !== 1 ) { 
                        $error = array (
                              'name' => "Thất bại !",
                              'content' => "Bạn không có quyền chỉnh sửa nội dung này !"
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

     function delete ($id) {
           $distributor = $this->db->query("SELECT * FROM nhaphanphoi WHERE id_nhaphanphoi = '$id'");
           $row = $distributor->fetch_assoc();
      foreach ($_SESSION['function'] as $key => $value) {
            if ($key == 2 && $value['truycap'] == 1 && $value['xoa'] == 1 ) { 
                  $this->model->delete('distributor', $id);
                  $getDistributors = $this->model->get('distributor');

                              $error = array (
                                    'name' => "Thành công !",
                                    'content' => "Xóa thành công !"
                                );

                              $data = array (
                                    'distributors' => $getDistributors,
                                    'error' => $error,
                                    'success' => true
                              );

            
                              $date = $this->date->getDateTime();
                              $this->model->post('historys',
                                    array (
                                          'id_page' => '2',
                                          'date' => $date,
                                          'id_nhanvien' => $_SESSION['id'],
                                          'noidung' => $_SESSION['username'] .' đã xóa nhà phân phối ' . $row['tennhaphanphoi'],
                                    )
                              );
                  
                              $this->view->load('index', $data);
                              die();
            }

            if ($key == 2 && $value['truycap'] !== 1 && $value['xoa'] !== 1 ) { 
                  $error = array (
                        'name' => "Thất bại !",
                        'content' => "Bạn không có quyền xóa nội dung này !"
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

?>