<?php 
  class Users_Controller extends Base_Controller {


        function table () {

            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['truycap'] == 1) {
                        $getPosition = $this->model->get('position');
                        $getPart = $this->model->get('part');
                        $getUsers = $this->model->get_join('user');
                        $getRoles = $this->model->get('roles');

                        $data = array (
                              'All_user' => $getUsers,
                              'parts' => $getPart,
                              'positions' => $getPosition,
                              'roles' => $getRoles,
                        );
            
                        $this->view->load('index', $data);
                  }

                  if ($key == 2 && $value['truycap'] !== 1) {
                      $error = array (
                          'name' => 'Thất bại',
                          'content' => 'Bạn không có quyền truy cập chức năng này !'
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

      function add () {

            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['truycap'] == 1) {

                        $getPart = $this->model->get('part');
                        $getPosition = $this->model->get('position');
                        $getRoles = $this->model->get('roles');
            
                        if (isset($_POST['submit_add'])) {

                               if ($key == 2 && $value['them'] == 1) {
                              $date = $this->date->getDateTime();

                              $this->model->post('user', 
                              array (
                                          'last_name' => $_POST['last_name'],
                                          'first_name' => $_POST['first_name'],
                                          'sex' => $_POST['sex'],
                                          'birthday' => $_POST['birthday'],
                                          'phone' => $_POST['phone'],
                                          'email' => $_POST['email'],
                                          'password' => md5($_POST['password']),
                                          'address' => $_POST['address'],
                                          'part' => $_POST['part'],
                                          'position' => $_POST['position'],
                                          'roles' => $_POST['roles'],
                                          'date' => $date,
                                          'status_active' => '1'
                                    )
                              );



                              $date = $this->date->getDateTime();

                              $this->model->post('historys',
                              array (
                                    'id_page' => '2',
                                    'date' => $date,
                                    'id_nhanvien' => $_SESSION['id'],
                                    'noidung' =>  $_SESSION['username'] . ' đã thêm mới nhân viên ' . $_POST['lastname'] . " " . $_POST['first_name'],
                                    )
                              );


                              $error = array (
                                    'name' => 'Thành công !',
                                    'content' => 'Thêm thành công !'
                                );
      
                              $data = array (
                                    'parts' => $getPart,
                                    'positions' => $getPosition,
                                    'roles' => $getRoles,
                                    'error' => $error,
                                    'success' => true
                              );
                  
                              $this->view->load('index', $data);
                              die();
                              }

                              if ($key == 2 && $value['them'] !== 1) {
                                    $error = array (
                                          'name' => 'Thất bại',
                                          'content' => 'Bạn không có quyền thực hiện chức năng này !'
                                    );
            
                                    $data = array (
                                    'error' => $error,
                                    'fail' => true
                                    );
            
                                    $this->view->load('index', $data);
                                    die();
                              }
                        
                        }

                        
                        $data = array (
                              'parts' => $getPart,
                              'positions' => $getPosition,
                              'roles' => $getRoles,
                        );

                        $this->view->load('index', $data);
                        die();
            
                  }

                  if ($key == 2 && $value['truycap'] !== 1) {
                        $error = array (
                              'name' => 'Thất bại',
                              'content' => 'Bạn không có quyền truy cập chức năng này !'
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

      function edit($id) {

      foreach ($_SESSION['function'] as $key => $value) {
            if ($key == 2 && $value['sua'] == 1) {

                  $getUser_edit = $this->model->getOne('user', $id);
                  $getPosition = $this->model->get('position');
                  $getRoles = $this->model->get('roles');
                  $getPart = $this->model->get('part');
        
                  $data = array (
                        'user_edit' => $getUser_edit,
                        'parts' => $getPart,
                        'positions' => $getPosition,
                        'roles' => $getRoles
                    );
                    
                    if (isset($_POST['submit_update'])) {
        
                          $row = $getUser_edit->fetch_assoc();
                          
                          $this->model->update('user', $id,
                                array (
                                            'last_name' => $_POST['last_name'],
                                            'first_name' => $_POST['first_name'],
                                            'sex' => $_POST['sex'],
                                            'birthday' => $_POST['birthday'],
                                            'phone' => $_POST['phone'],
                                            'email' => $_POST['email'],
                                            'address' => $_POST['address'],
                                            'part' => $_POST['part'],
                                            'position' => $_POST['position'],
                                            'roles' => $_POST['roles'],
                                            'status_active' => $row['kichhoat']
                                      )
                                );


                                $date = $this->date->getDateTime();

                              $this->model->post('historys',
                              array (
                                    'id_page' => '2',
                                    'date' => $date,
                                    'id_nhanvien' => $_SESSION['id'],
                                    'noidung' => $_SESSION['username'] .' đã chỉnh sửa thông tin nhân viên ' . $_POST['lastname'] . " " . $_POST['first_name'],
                                    )
                              );
        
                                 $getUsers = $this->model->get_join('user');

                                 $error = array (
                                    'name' => 'Thành công !',
                                    'content' => 'Cập nhật thành công !'
                                );
        
                                $data = array (
                                      'All_user' => $getUsers,
                                      'error' => $error,
                                      'success' => true
                                );
        
                                $this->view->load('index', $data);
                                die();
                          }
        
                   $this->view->load('index', $data);
                   die();
            }

            if ($key == 2 && $value['sua'] !== 1) {
                  $getUsers = $this->model->get_join('user');

                  $error = array (
                     'name' => 'Thất bại !',
                     'content' => 'Bạn không có quyền thực hiện chức năng này !'
                 );

                 $data = array (
                       'All_user' => $getUsers,
                       'error' => $error,
                       'fail' => true
                 );

                 $this->view->load('index', $data);
                 die();
            }
      }
      }

      function delete ($id) {
            $user = $this->db->query("SELECT * FROM nhanvien WHERE id_nhanvien = '$id'");
            $row = $user->fetch_assoc();

            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['xoa'] == 1) {
                        $this->model->delete('user',$id);

                  $getUsers = $this->model->get_join('user');

                  $error = array (
                     'name' => 'Thành công !',
                     'content' => 'Xóa thành công !'
                 );


                 $date = $this->date->getDateTime();
                 $this->model->post('historys',
                       array (
                             'id_page' => '2',
                             'date' => $date,
                             'id_nhanvien' => $_SESSION['id'],
                             'noidung' => $_SESSION['username'] .' đã xóa nhân viên ' . $row['tenlot'] . " " . $row['tennhanvien'],
                       )
                 );

                 $data = array (
                       'All_user' => $getUsers,
                       'error' => $error,
                       'success' => true
                 );

                 $this->view->load('index', $data);
                 die();

                  }

                  if ($key == 2 && $value['xoa'] !== 1) {
                        $getUsers = $this->model->get_join('user');

                        $error = array (
                           'name' => 'Thất bại !',
                           'content' => 'Bạn không có quyền thực hiện chức năng này !'
                       );
      
                       $data = array (
                             'All_user' => $getUsers,
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