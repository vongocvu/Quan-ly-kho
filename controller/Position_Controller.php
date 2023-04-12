<?php 
  class Position_Controller extends Base_Controller {
        
        function add () {
            
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['them'] == 1 ) { 
                         if (isset($_POST['submit_add'])) {

                              if ($_POST['name'] == "" || $_POST['part'] == "") {
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

                                    $part_id = $_POST['part'];
                                    $positions = $this->db->query("SELECT * FROM chucvu a, bophan b WHERE a.bophan = b.id_bophan AND a.bophan = '$part_id'");
                                    foreach ($positions as $position) {
                                          $namePosition = $this->accents->removeAccents($position['tenchucvu']);
                                    $nameInput = $this->accents->removeAccents($_POST['name']);
                                    if (strtoupper($namePosition) == strtoupper($nameInput)) {
                                          $error = array(
                                                'name' => "Lỗi cú pháp !",
                                                'content' => "Chức vụ này đã tồn tại ở bộ phận " . $position['tenbophan']
                                          );

                                          $data = array(
                                                'error' => $error,
                                                'fail' => true
                                          );

                                          $this->view->load('index', $data);
                                          die();
                                    }
                              }


                              $this->model->post('position',
                                    array (
                                          'name' => $_POST['name'],
                                          'part' => $_POST['part'],
                                          'note' => $_POST['note'],
                                          )
                                    );

                                    $date = $this->date->getDateTime();
                                    $this->model->post('historys',
                                          array (
                                                'id_page' => '2',
                                                'date' => $date,
                                                'id_nhanvien' => $_SESSION['id'],
                                                'noidung' => $_SESSION['username'] .' đã thêm mới chức vụ  ' . $_POST['name']
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

                        $getPositions = $this->db->query("SELECT * FROM chucvu a, bophan b WHERE a.bophan = b.id_bophan");
                        $data = array (
                              'positions' => $getPositions,
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

                        $getPosition = $this->model->getOne('position', $id);
                        
                        if (isset($_POST['submit_update'])) {
                              $this->model->update('position', $id, 
                              array (
                                       'name' => $_POST['name'],
                                       'note' => $_POST['note'],
                                    ));
                
                              $date = $this->date->getDateTime();
                              $this->model->post('historys',
                              array (
                                    'id_page' => '2',
                                    'date' => $date,
                                    'id_nhanvien' => $_SESSION['id'],
                                    'noidung' => $_SESSION['username'] .' đã chỉnh sửa thông tin của chức vụ ' . $_POST['name'],
                                    )
                              );

                              $error = array (
                                    'name' => "Thành công !",
                                    'content' => "Cập nhật thành công !"
                                );
                                
                                $getPositions = $this->db->query("SELECT * FROM chucvu a, bophan b WHERE a.bophan = b.id_bophan");

                              $data = array (
                                    'positions' => $getPositions,
                                    'error' => $error,
                                    'success' => true
                              );
                  
                              $this->view->load('index', $data);
                              die();
                        }
                
                        $data = array (
                              'position_edit' => $getPosition
                        );
                
                        $this->view->load('index', $data);

                  }

                  if ($key == 2 && $value['truycap'] !== 1 && $value['sua'] !== 1 ) { 
                        $error = array (
                              'name' => "Thất bại !",
                              'content' => "Bạn không có quyền chỉnh sửa nội dung này !"
                          );

                          $getPositions = $this->db->query("SELECT * FROM chucvu a, bophan b WHERE a.bophan = b.id_bophan");

                          $data = array (
                                'positions' => $getPositions,
                                'error' => $error,
                                'fail' => true
                          );

                          $this->view->load('index', $data);
                          die();
                  }
            }
  }

     function delete ($id) {
                  $position = $this->db->query("SELECT * FROM chucvu WHERE id_chucvu = '$id'");
                  $row = $position->fetch_assoc();
           
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['truycap'] == 1 && $value['xoa'] == 1 ) { 
                        $this->model->delete('position', $id);
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
                                    'noidung' => $_SESSION['username'] .' đã xóa chức vụ ' . $row['tenchucvu'],
                              )
                        );
                        
                        $getPositions = $this->db->query("SELECT * FROM chucvu a, bophan b WHERE a.bophan = b.id_bophan");
                                $data = array (
                                    'positions' => $getPositions,
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

                    $getPositions = $this->db->query("SELECT * FROM chucvu a, bophan b WHERE a.bophan = b.id_bophan");
                                $data = array (
                                    'positions' => $getPositions,
                                    'error' => $error,
                                    'fail' => true
                              );

                    $this->view->load('index', $data);
                    die();
            }
      }
     }
  }
