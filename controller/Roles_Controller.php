<?php 
  class Roles_Controller extends Base_Controller {

      function add () {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 1 && $value['them'] == 1) {
                        if (isset($_POST['submit_add'])) {

                              if ($_POST['name_roles'] == "" || $_POST['position_roles'] == "" || $_POST['note_roles'] == "") {
                                    $error = array(
                                          'name' => "Warning !",
                                          'content' => "Vui lòng nhập dầy đủ các trường !"
                                    );
 
                                    $getRoles = $this->model->get('roles');
            
                                    $data = array (
                                          'Roles' => $getRoles,
                                          'error' => $error,
                                          'fail' => true
                                    );
                        
                                    $this->view->load('index', $data);
                                    die();
                              } else {
                                    $last_id = $this->model->post('roles',
                                          array (
                                                'name' => $_POST['name_roles'],
                                                'position' => $_POST['position_roles'],
                                                'note' => $_POST['note_roles'],
                                          )
                                    );
                                     $date = $this->date->getDateTime();
                                    $this->model->post('historys',
                                       array (
                                           'id_page' => '1',
                                           'date' => $date,
                                           'id_nhanvien' => $_SESSION['id'],
                                           'noidung' =>  $_SESSION['username'].' đã thêm 1 quyền mới với tên là ' . $_POST['name_roles'],
                                       )
                                    );
      
                                    $getFunctions = $this->model->get('function');
                                    foreach ($getFunctions as $function) {
                                          $this->model->post('function', 
                                                array (
                                                'id_roles' => $last_id,
                                                'id_chucnang' => $function['id_chucnang'],
                                                )
                                          );
                                    }
                              }
                              

                        }
            
                        header('Location: index.php?c=roles&a=table');
                        die();
                  }

                  if ($key == 1 && $value['them'] !== 1) {
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


      function table () {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 1 && $value['truycap'] == 1) {

                        $getRoles = $this->model->get('roles');
            
                        $data = array (
                              'Roles' => $getRoles
                        );
            
                        $this->view->load('index', $data);
                        die();
                  }

                  if ($key == 1 && $value['truycap'] !== 1) {
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
                  die();
            }
      }


      function setting () {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 1 && $value['truycap'] == 1) {

                        $getRoles = $this->model->get('roles');
                        $getUsers = $this->model->get_join('user');
                        $getFunctions= $this->model->get_join('function');
            
                        $data = array (
                              'Roles' => $getRoles,
                              'Users' => $getUsers,
                              'Functions' => $getFunctions
                        );
            
                        $this->view->load('index', $data);
                        die();
                  }

                  if ($key == 1 && $value['truycap'] !== 1) {
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


       function update_setting ($id) {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 1 && $value['sua'] == 1) {

                        $Functions = $this->model->get_join('function');
                        foreach ($Functions as $function) {
                              if ($function['id_roles'] == $id) {
                                    $this->model->update('function', $function['id_quyenquanly'], 
                                       array (
                                           'truycap' => $_POST['truycap'. $function['id_chucnang']],
                                           'them' => $_POST['them'. $function['id_chucnang']],
                                           'sua' => $_POST['sua'. $function['id_chucnang']],
                                           'xoa' => $_POST['xoa'. $function['id_chucnang']],
                                           'in' => $_POST['in'. $function['id_chucnang']],
                                           'nhap' => $_POST['nhap'. $function['id_chucnang']],
                                           'xuat' => $_POST['xuat'. $function['id_chucnang']],
                                       )
                                    );
                              }
                        }
            
                        $getRole = $this->model->getOne('roles', $id);
                        $row = $getRole->fetch_assoc();
            
                        $date = $this->date->getDateTime();
                        $this->model->post('historys',
                        array (
                              'id_page' => '1',
                              'date' => $date,
                              'id_nhanvien' => $_SESSION['id'],
                              'noidung' => $_SESSION['username']. ' đã setting lại quyền ' . $row['tenroles'],
                              )
                        );
                        
                        require_once PATH_APPLICATION . '/core/Base_Model.php';
                        $db = new Base_Model();
            
                        $roles_user = $_SESSION['roles'];
            
                        $get_Roles_Func = $db->conn->query("SELECT * FROM quyenquanly WHERE id_roles = '$roles_user'");
            
                        foreach ($get_Roles_Func as $function) {
                              $_SESSION['function'][$function['chucnang']] = array (
                                    'truycap' => $function['truycap'],
                                    'them' => $function['them'],
                                    'sua' => $function['sua'],
                                    'xoa' => $function['xoa'],
                                    'in' => $function['quyen_in'],
                                    'nhap' => $function['nhap'],
                                    'xuat' => $function['xuat'],
                              );
                        }
            
                        header('Location: index.php?c=roles&a=setting');
                        die();
                  }

                  if ($key == 1 && $value['sua'] !== 1) {
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


      function edit ($id) {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 1 && $value['sua'] == 1) {

                        $getRole = $this->model->getOne('roles', $id);
                        
                        if (isset($_POST['submit_update'])) {
                              $row = $getRole->fetch_assoc();
                              $this->model->update('roles', $id, 
                              array (
                                       'name' => $_POST['name_roles'],
                                       'position' => $_POST['position_roles'],
                                       'note' => $_POST['note_roles'],
                                       'status_active' => $row['kichhoat']
                                    ));
            
                              $date = $this->date->getDateTime();
                              $this->model->post('historys',
                              array (
                                    'id_page' => '1',
                                    'date' => $date,
                                    'id_nhanvien' => $_SESSION['id'],
                                    'noidung' => $_SESSION['username'] .' đã chỉnh sửa thông tin của quyền ' . $_POST['name_roles'],
                                    )
                              );
            
                              $getRoles = $this->model->get('roles');
            
                              $data = array (
                                    'Roles' => $getRoles
                              );
                  
                              $this->view->load('index', $data);
                              die();
                        }
            
                        $data = array (
                              'role_edit' => $getRole
                        );
            
                        $this->view->load('index', $data);
                        die();
                  }

                  if ($key == 1 && $value['sua'] !== 1) {
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

      function delete ($id) {
            $roles = $this->db->query("SELECT * FROM roles WHERE id_roles = '$id'");
            $row = $roles->fetch_assoc();
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 1 && $value['sua'] == 1) {
                        $date = $this->date->getDateTime();
                        $getRolesDelete = $this->model->getOne('roles', $id);
                        $row = $getRolesDelete->fetch_assoc();
                        
      
                        $date = $this->date->getDateTime();
                        $this->model->post('historys',
                              array (
                                    'id_page' => '1',
                                    'date' => $date,
                                    'id_nhanvien' => $_SESSION['id'],
                                    'noidung' => $_SESSION['username'] .' đã xóa quyền ' . $row['tenroles'],
                              )
                        );
                        
                        $this->model->delete('function', $id);
                        $this->model->delete('roles', $id);
                        header('Location: index.php?c=roles&a=table');
                        die();
                  }

                  if ($key == 1 && $value['sua'] !== 1) {
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


      function active_roles($id) {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 1 && $value['sua'] == 1) {

                        $getRole = $this->model->getOne('roles', $id);
                        
                        if (isset($_POST['submit_active'])) {
                              $row = $getRole->fetch_assoc();
                             
                              $this->model->update('roles', $id, 
                              array (
                                          'name' => $row['tenroles'],
                                          'position' => $row['vaitro'],
                                          'note' => $row['ghichu'],
                                          'status_active' => $_POST['status_active']
                                    ));
                              $active = "ngưng kích hoạt";
            
                              if ($_POST['status_active'] == 1) {
                                    $active = "kích hoạt";
                              }
            
                              $date = $this->date->getDateTime();
                              $this->model->post('historys',
                              array (
                                    'id_page' => '1',
                                    'date' => $date,
                                    'id_nhanvien' => $_SESSION['id'],
                                    'noidung' => $_SESSION['username']. ' đã ' . $active . ' quyền ' .  $row['tenroles'],
                                    )
                              );
                        }
                        header('Location: index.php?c=roles&a=add');
                        die();
                  }

                  if ($key == 1 && $value['sua'] !== 1) {
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

      function active_user($id) {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 1 && $value['sua'] == 1) {

                        $getUser = $this->model->getOne('user', $id);
                        
                        if (isset($_POST['submit_active'])) {
                              $row = $getUser->fetch_assoc();
            
                              $this->model->update('user', $id,
                                    array (
                                                'last_name' =>  $row['tenlot'],
                                                'first_name' => $row['tennhanvien'],
                                                'sex' => $row['gioitinh'],
                                                'birthday' => $row['ngaysinh'],
                                                'phone' => $row['sodienthoai'],
                                                'email' => $row['email'],
                                                'password' => $row['password'],
                                                'address' => $row['diachi'],
                                                'part' => $row['bophan'],
                                                'position' => $row['chucvu'],
                                                'roles' => $row['id_roles'],
                                                'status_active' =>  $_POST['status_active'], 
                                          )
                                    );
            
                              $active = "ngưng kích hoạt";
            
                              if ($_POST['status_active'] == 1) {
                                    $active = "kích hoạt";
                              }
            
                              $date = $this->date->getDateTime();
                              $this->model->post('historys',
                              array (
                                    'id_page' => '1',
                                    'date' => $date,
                                    'id_nhanvien' => $_SESSION['id'],
                                    'noidung' => $_SESSION['username'] .' đã ' . $active . ' tài khoản ' .  $row['email'],
                                    )
                              );
                              }
                              header('Location: index.php?c=roles&a=setting');
                  }

                  if ($key == 1 && $value['sua'] !== 1) {
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
            
}
?>