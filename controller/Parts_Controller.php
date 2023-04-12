<?php 
  class Parts_Controller extends Base_Controller {
        
        function add () {
            
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['them'] == 1 ) { 
                         if (isset($_POST['submit_add'])) {

                              if ($_POST['part_name'] == "") {
                                    $error = array(
                                          'name' => "Warning !",
                                          'content' => "Bạn chưa nhập tên chức vụ !"
                                    );
            
                                    $data = array (
                                          'error' => $error,
                                          'fail' => true
                                    );
                        
                                    $this->view->load('index', $data);
                                    die();
                              }

                              $parts = $this->db->query("SELECT * FROM bophan");
                              foreach ($parts as $part) {
                                    $namePart = $this->accents->removeAccents($part['tenbophan']);
                                    $nameInput = $this->accents->removeAccents($_POST['part_name']);
                                    if (strtoupper($namePart) == strtoupper($nameInput)) {
                                          $error = array(
                                                'name' => "Lỗi cú pháp !",
                                                'content' => "Bộ phận này đã tồn tại !"
                                          );

                                          $data = array(
                                                'error' => $error,
                                                'fail' => true
                                          );

                                          $this->view->load('index', $data);
                                          die();
                                    }
                              }

                              $this->model->post('part',
                                    array (
                                          'name' => $_POST['part_name'],
                                          'note' => $_POST['part_note'],
                                          )
                                    );

                                    $date = $this->date->getDateTime();
                                    $this->model->post('historys',
                                          array (
                                                'id_page' => '2',
                                                'date' => $date,
                                                'id_nhanvien' => $_SESSION['id'],
                                                'noidung' => $_SESSION['username'] .' đã thêm mới bộ phận ' .$_POST['part_name']
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
                                    
                                          $this->view->load('index', $data);
                                                die();
                              }

                              $this->view->load('index');
                                    die();
                  
                        }

                        if ($key == 2 && $value['them'] !== 1 ) {
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

      }


      function table () {

            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['truycap'] == 1) { 

                        $getParts = $this->model->get('part');
                        $data = array (
                              'parts' => $getParts,
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
            $getStores = $this->model->get('store');
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['truycap'] == 1 && $value['sua'] == 1 ) { 

                        $getPart = $this->model->getOne('part', $id);
                        
                        if (isset($_POST['submit_update'])) {
                              $this->model->update('part', $id, 
                              array (
                                       'name' => $_POST['part_name'],
                                       'note' => $_POST['part_note'],
                                    ));
                
                                    $date = $this->date->getDateTime();
                                    $this->model->post('historys',
                                          array (
                                                'id_page' => '2',
                                                'date' => $date,
                                                'id_nhanvien' => $_SESSION['id'],
                                                'noidung' => $_SESSION['username'] .' đã chỉnh sửa bộ phận  ' . $_POST['part_name']
                                          )
                                    );

                              $error = array (
                                    'name' => "Thành công !",
                                    'content' => "Cập nhật thành công !"
                                );
                                
                              $getParts = $this->model->get('part');

                              $data = array (
                                    'parts' => $getParts,
                                    'error' => $error,
                                    'success' => true
                              );
                  
                              $this->view->load('index', $data);
                              die();
                        }
                
                        $data = array (
                              'part_edit' => $getPart,
                        );
                
                        $this->view->load('index', $data);

                  }

                  if ($key == 2 && $value['truycap'] !== 1 && $value['sua'] !== 1 ) { 
                        $error = array (
                              'name' => "Thất bại !",
                              'content' => "Bạn không có quyền chỉnh sửa nội dung này !"
                          );

                          $getParts = $this->model->get('part');

                          $data = array (
                                'parts' => $getParts,
                                'error' => $error,
                                'fail' => true
                          );

                          $this->view->load('index', $data);
                          die();
                  }
            }
  }

     function delete ($id) {
            
           $part = $this->db->query("SELECT * FROM bophan WHERE id_bophan = '$id'");
           $row = $part->fetch_assoc();
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['truycap'] == 1 && $value['xoa'] == 1 ) { 
                        $this->model->delete('part', $id);
                        $error = array (
                              'name' => "Thành công !",
                              'content' => "Xóa thành công !"
                        );

      
                        $date = $this->date->getDateTime();
                        $this->model->post('historys',
                              array (
                                    'id_page' => '2',
                                    'date' => $date,
                                    'id_nhanvien' => $_SESSION['id'],
                                    'noidung' => $_SESSION['username'] .' đã xóa bộ phận ' . $row['tenbophan'],
                              )
                        );
                        
                        $getParts = $this->model->get('part');
                                $data = array (
                                    'parts' => $getParts,
                                    'error' => $error,
                                    'success' => true
                              );
                  
                              $this->view->load('index', $data);
                              die();
            }

            if ($key == 2 && $value['truycap'] !== 1 && $value['xoa'] !== 1 ) { 
                  $error = array (
                        'name' => "Thất bại !",
                        'content' => "Bạn không có quyền xóa nội dung này !"
                    );

                    $getParts = $this->model->get('part');
                    $data = array (
                        'parts' => $getParts,
                        'error' => $error,
                        'fail' => true
                  );

                    $this->view->load('index', $data);
                    die();
            }
      }
     }
  }
