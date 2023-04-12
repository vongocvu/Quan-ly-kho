<?php 
      require_once PATH_APPLICATION . '/core/Base_Model.php';
   class Auth_Controller extends Base_Controller {
      function login() {
            if (isset($_POST['submit_login'])) {
               $username = $_POST['username'];
               $password = md5($_POST['password']);
               $checklogin = 0;

               $users = $this->model->get('user');
               foreach ($users as $user) {

                  if ($user['email'] == $username && $user['password'] == $password && $user['kichhoat'] == 1) {

                        $db = new Base_Model();

                        $roles_user = $user['id_roles'];

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

                        $_SESSION['username'] = $user['hovaten'];
                        $_SESSION['id'] = $user['id_nhanvien'];
                        $_SESSION['roles'] = $user['id_roles'];
                        $checklogin++;

                        header('Location: index.php?c=home');
                        die();
                     } else if ($user['email'] == $username && $user['password'] == $password && $user['kichhoat'] !== 1) {
                        $error = array(
                           'name' => 'Lỗi hệ thống !',
                           'content' => 'Tài khoản của bạn đã bị ngưng hoạt động !' . '<br/>' . '- Vui lòng liên hệ với quản lý để biết thêm thông tin chi tiết !'
                        );
   
                        $data = array (
                           'error' => $error,
                           'fail' => true
                        );
   
                        $this->view->load('login', $data);
                        die();
                  } 

               }
               
                  if ($checklogin == 0) {
                     $error = array(
                        'name' => 'Lỗi đăng nhập !',
                        'content' => 'Tài khoản hoặc mật khẩu không chính xác !' . '<br/>' . '- Vui lòng kiểm tra lại !'
                     );

                     $data = array (
                        'error' => $error,
                        'fail' => true
                     );

                     $this->view->load('login', $data);
                  }
            }
      }


      function forgotPassword () {

         if (isset($_POST['submit_forgot'])) {
            $emailForgot = $_POST['emailForgot'];

            $Data_Users = $this->model->get('user');


            foreach ($Data_Users as $user) {
               if ($user['email'] == $emailForgot) {
                 
                     require PATH_APPLICATION . "/PHPMailer/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
                     require PATH_APPLICATION . "/PHPMailer/src/SMTP.php"; //nhúng thư viện vào để dùng
                     require PATH_APPLICATION . '/PHPMailer/src/Exception.php'; //nhúng thư viện vào để dùng
                     $mail = new PHPMailer\PHPMailer\PHPMailer(true);  //true: enables exceptions
                       try {
                           $mail->SMTPDebug = 0;  // 0,1,2: chế độ debug. khi mọi cấu hình đều tớt thì chỉnh lại 0 nhé
                           $mail->isSMTP();  
                           $mail->CharSet  = "utf-8";
                           $mail->Host = 'smtp.gmail.com';  //SMTP servers
                           $mail->SMTPAuth = true; // Enable authentication
                           $nguoigui = 'ttanvnv@gmail.com';
                           $matkhau = 'rupmaghjkuxhjpqz';
                           $tennguoigui = 'QLK';
                           $mail->Username = $nguoigui; // SMTP username
                           $mail->Password = $matkhau;   // SMTP password
                           $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
                           $mail->Port = 465;  // port to connect to                
                           $mail->setFrom($nguoigui, $tennguoigui); 
                           $to =  $emailForgot;
                           $to_name = $user['hovaten'];
                           
                           $mail->addAddress($to, $to_name); //mail và tên người nhận  
                           $mail->isHTML(true);  // Set email format to HTML
                           $mail->Subject = 'Thay đổi mật khẩu !';      
                           $noidungthu = "Click vào link để thay đổi mật khẩu !" . 
                                         "<br/>" . "http://localhost:3000/xampp/QLK/index.php?c=auth&a=changePassword&id=" . $user['id_nhanvien'];
                           $mail->Body = $noidungthu;
                           $mail->smtpConnect( array(
                               "ssl" => array(
                                   "verify_peer" => false,
                                   "verify_peer_name" => false,
                                   "allow_self_signed" => true
                               )
                           ));
                           $mail->send();
                           $error = array(
                              'name' => 'Thành công',
                              'content' => 'Kiểm tra Email để khôi phục lại mật khẩu !',
                           );
         
                           $data = array (
                              'error' => $error,
                              'success' => true,
                           );
         
                           $this->view->load('login', $data);
                           die();
                       } catch (Exception $e) {
                        $error = array(
                           'name' => 'Thất bại',
                           'content' => 'Không gửi được Email !',
                        );
      
                        $data = array (
                           'error' => $error,
                           'fail' => true,
                        );
      
                        $this->view->load('login', $data);
                        die();
                       }

                    
               }
               
               if ($user['email'] !== $emailForgot) {
                  $error = array (
                     'name' => 'Thất bại!',
                     'content' => 'Email này không đúng !' . '<br/>' . '- Vui lòng kiểm tra lại !',
                  );

                  $data = array (
                     'error' => $error,
                     'fail' => true
                  );

                  $this->view->load('forgotPassword', $data);
                  die();
               }
            }
         }

         $this->view->load('forgotPassword');
      }


      function changePassword ($id) {
         $db = new Base_Model();
         
         if (isset($_POST['submit_change'])) {
            $password = md5($_POST['password']);

            $db->conn->query("UPDATE nhanvien SET password = '$password' WHERE id_nhanvien = '$id'");
            
            $error = array(
               'name' => 'Thành công',
               'content' => 'Thay đổi mật khẩu thành công !'
              );

              $data = array (
               'error' => $error,
               'success' => true
              );

              if (isset($_GET['status']) && $_GET['status'] == "change") {
                  $this->view->load('index', $data);
                  die();
              }

              $this->view->load('login', $data);
              die();
            }

            $data = array (
               'id' => $id
            );

            $this->view->load('changePassword', $data);
            die();
      }

      function logout() {
         session_destroy();
         header('Location: index.php?c=home');
      }
   }

?>