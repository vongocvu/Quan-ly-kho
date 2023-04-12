<?php
class Units_Controller extends Base_Controller
{


      function add()
      {    
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['truycap'] == 1) {
                        foreach ($_SESSION['function'] as $key => $value) {
                              if ($key == 2) {
                                    if ($value['them'] == 1) {
                                                if (isset($_POST['submit_add'])) {

                                                      if ($_POST['name'] == "") { 
                                                            $error = array(
                                                                  'name' => "Lỗi cú pháp !",
                                                                  'content' => "Vui lòng nhập đầy đủ tên trường"
                                                            );

                                                            $data = array(
                                                                  'error' => $error,
                                                                  'fail' => true
                                                            );

                                                            $this->view->load('index', $data);
                                                            die();
                                                      }

                                                      $units = $this->db->query("SELECT * FROM donvitinh");
                                                      
                                                      foreach ($units as $unit) {
                                                            if (strtoupper($unit['tendonvitinh']) == strtoupper($_POST['name'])) {
                                                                  $error = array(
                                                                        'name' => "Lỗi cú pháp !",
                                                                        'content' => "Đơn vị tính này đã tồn tại !"
                                                                  );
      
                                                                  $data = array(
                                                                        'error' => $error,
                                                                        'fail' => true
                                                                  );
      
                                                                  $this->view->load('index', $data);
                                                                  die();
                                                            }
                                                      }

            
                                                $this->model->post(
                                                      'units',
                                                      array(
                                                            'name' => $_POST['name'],
                                                            'note' => $_POST['note'],
                                                      )
                                                );
            
                                                $date = $this->date->getDateTime();
                                                $this->model->post(
                                                      'historys',
                                                      array(
                                                            'id_page' => '2',
                                                            'date' => $date,
                                                            'id_nhanvien' => $_SESSION['id'],
                                                            'noidung' => $_SESSION['username'] . ' đã thêm mới đơn vị tính' . $_POST['name'],
                                                      )
                                                );
            
                                                $error = array(
                                                      'name' => 'Thành công !',
                                                      'content' => "Thêm đơn vị tính thành công !",
                                                );
            
                                                $data = array(
                                                      'error' => $error,
                                                      'success' => true
                                                );
            
                                                $this->view->load('index', $data);
                                                die();
                                          }  
                                          
                                          $this->view->load('index');
                                          die();
                                          
                                    }
                                    
                                    if ($value['them'] !== 1) {
      
                                                $error = array(
                                                      'name' => 'Thất bại !',
                                                      'content' => "Bạn không có quyền thêm mới ở chức năng này!",
                                                );
                        
                                                $data = array(
                                                      'error' => $error,
                                                      'fail' => true
                                                );
                        
                                                $this->view->load('index', $data);
                                                die();
                                    }
                              }
            
                        }
            
                        $this->view->load('index');

                  }

                  if ($key == 2 && $value['truycap'] !== 1) {
                        $error = array(
                              'name' => 'Thất bại !',
                              'content' => "Bạn không có quyền truy cập chức năng này!",
                        );

                        $data = array(
                              'error' => $error,
                              'fail' => true
                        );

                        $this->view->load('index', $data);
                        die();
                  }
            }
      }


      function table()
      {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2) {
                        if ($value['truycap'] == 1) {

                              $getUnits = $this->model->get('units');

                              $data = array(
                                    'units' => $getUnits,
                              );
                              $this->view->load('index', $data);
                              die();
                        }

                        if ($value['truycap'] !== 1) { 

                              $error = array(
                                    'name' => 'Thất bại',
                                    'content' => 'Bạn không có quyền xem thông tin ở mục này !',
                              );
                  
                              $data = array(
                                    'error' => $error,
                                    'fail' => true
                              );
                  
                              $this->view->load('index', $data);
                              die();
                        }
                  }
            }

      }

      function edit($id)
      {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2) {
                        if ($value['sua'] == 1) {
                              $getUnit = $this->model->getOne('units', $id);
                              
                              if (isset($_POST['submit_update'])) {
                                    $this->model->update(
                                          'units',
                                          $id,
                                          array(
                                                'name' => $_POST['name'],
                                                'note' => $_POST['note'],
                                          )
                                    );

                                    $date = $this->date->getDateTime();
                                    $this->model->post(
                                          'historys',
                                          array(
                                                'id_page' => '2',
                                                'date' => $date,
                                                'id_nhanvien' => $_SESSION['id'],
                                                'noidung' =>  $_SESSION['username'] .' đã chỉnh sửa thông tin đơn vị tính ' . $_POST['name'],
                                          )
                                    );

                                    $error = array(
                                          'name' => 'Thành công !',
                                          'content' => 'Cập nhật thành công !',
                                    );

                                    $getUnits = $this->model->get('units');
                                    $data = array(
                                          'units' => $getUnits,
                                          'error' => $error,
                                          'success' => true
                                    );

                                    $this->view->load('index', $data);
                                    die();
                              }

                              $data = array(
                                    'unit_edit' => $getUnit
                              );

                              $this->view->load('index', $data);
                        } 
                         
                        if ($value['sua'] !== 1) {

                              $error = array(
                                    'name' => 'Thất bại',
                                    'content' => 'Bạn không có quyền chỉnh sửa nội dung này !',
                              );
                  
                              $getUnits = $this->model->get('units');
                              $data = array(
                                    'units' => $getUnits,
                                    'error' => $error,
                                    'fail' => true
                              );
                  
                              $this->view->load('index', $data);
                        }
                  }
            }
      }

      function delete($id)
      {
            $unit = $this->db->query("SELECT * FROM donvitinh WHERE id_donvitinh = '$id'");
            $row = $unit->fetch_assoc();

            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2) {
                        if ($value['xoa'] == 1) {

                              $this->model->delete('units', $id);
                              $error = array(
                                    'name' => "Thành công !",
                                    'content' => "Xóa thành công !"
                              );

            
                              $date = $this->date->getDateTime();
                              $this->model->post('historys',
                                    array (
                                          'id_page' => '2',
                                          'date' => $date,
                                          'id_nhanvien' => $_SESSION['id'],
                                          'noidung' => $_SESSION['username'] .' đã xóa đơn vị tính ' . $row['tendonvitinh'],
                                    )
                              );

                              $getUnits = $this->model->get('units');

                              $data = array(
                                    'units' => $getUnits,
                                    'error' => $error,
                                    'success' => true
                              );
                              $this->view->load('index', $data);
                              die();
                        } 

                        if ($value['xoa'] !== 1) {
                              $error = array(
                                    'name' => "Thất bại !",
                                    'content' => "Bạn không có quyền xóa nội dung này !"
                              );
                              $getUnits = $this->model->get('units');

                              $data = array(
                                    'units' => $getUnits,
                                    'error' => $error,
                                    'fail' => true
                              );
                              $this->view->load('index', $data);
                              die();
                        }
                  }
            }
      }
}
