<?php 

  class Store_Controller extends Base_Controller {

      function add() {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['truycap'] == 1 && $value['them'] == 1 ) { 
                        if (isset($_POST['submit_add'])) {


                             
                              if ($_POST['name'] == "" || $_POST['admin'] == "") {
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

                              $stores = $this->db->query("SELECT * FROM kho");
                              foreach ($stores as $store) {
                                    $nameStore = $this->accents->removeAccents($store['tenkho']);
                                    $nameInput = $this->accents->removeAccents($_POST['name']);
                                    if (strtoupper($nameStore) == strtoupper($nameInput)) {
                                          $error = array(
                                                'name' => "Lỗi cú pháp !",
                                                'content' => "Kho này đã tồn tại !"
                                          );

                                          $data = array(
                                                'error' => $error,
                                                'fail' => true
                                          );

                                          $this->view->load('index', $data);
                                          die();
                                    }
                              }

                              $name = $_POST['name'];
                              $admin = $_POST['admin'];
                              $note = $_POST['note'];
                              $this->db->query("INSERT INTO kho VALUES('','$name','$admin','1','$note')");
                              $error = array (
                                    'name' => 'Thành công !',
                                    'content' => 'Bạn vừa thêm thành công kho với tên là ' . $name . ' !'
                              );

                              $date = $this->date->getDateTime();
                              $this->model->post('historys',
                                    array (
                                          'id_page' => '2',
                                          'date' => $date,
                                          'id_nhanvien' => $_SESSION['id'],
                                          'noidung' => $_SESSION['username'] .' đã thêm thành công ' . $_POST['name']
                                    )
                              );
                  
                              $data = array (
                              'error' => $error,
                              'success' => true
                              );
                  
                              $this->view->load('index', $data);
                              die();
                        }

                        $data = array (
                              );
                  
                              $this->view->load('index', $data);
                              die();
                  }

                  if ($key == 2 && $value['truycap'] !== 1 && $value['them'] !== 1 ) {

                        $error = array (
                              'name' => 'Thất bại',
                              'content' => 'Bạn không có quyền thêm nội dung này !'
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
                  if ($key == 2 && $value['sua'] == 1 ) { 
                        
                        if (isset($_POST['submit_update'])) {
                              $name = $_POST['name'];
                              $admin = $_POST['admin'];
                              $note = $_POST['note'];

                              $this->db->query("UPDATE kho SET tenkho = '$name', quanlykho = '$admin', ghichu = '$note' WHERE id_kho = '$id'");
                
                              $date = $this->date->getDateTime();
                              $this->model->post('historys',
                                    array (
                                          'id_page' => '2',
                                          'date' => $date,
                                          'id_nhanvien' => $_SESSION['id'],
                                          'noidung' => $_SESSION['username'] .' đã chỉnh sửa ' . $_POST['name']
                                    )
                              );
                  
                
                              $error = array (
                                    'name' => 'Thành công',
                                    'content' => 'Chỉnh sửa thành công !'
                              );
                  
                              $data = array (
                                    'error' => $error,
                                    'success' => true
                              );
                  
                              $this->view->load('index', $data);
                              die();
                        }

                        $getStore = $this->db->query("SELECT * FROM kho WHERE id_kho = '$id'");
                
                        $data = array (
                              'store_edit' => $getStore,
                        );
                
                        $this->view->load('index', $data);
                        die();
                  }

                  if ($key == 2 && $value['sua'] !== 1 ) {
      
                              $error = array (
                                    'name' => 'Thất bại',
                                    'content' => 'Bạn không có quyền chỉnh sửa nội dung này !'
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

        function setting ($id) {
             $getArea = $this->model->getOne('area', $id);
             $getStores = $this->model->get_join('store');
             $users = $this->model->get('user');

             $data = array (
                'area_setting' => $getArea,
                'users' => $users,
                'Stores' => $getStores
             );

             $this->view->load('index', $data);
        }


      function active_store($id) {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['sua'] == 1 ) { 

                       if (isset($_POST['submit_active'])) {

                             $status_active = $_POST['status_active'];
                            
                              $this->db->query("UPDATE kho SET kichhoat = '$status_active'");
               
                             $active = "ngưng kích hoạt";
               
                             if ($_POST['status_active'] == 1) {
                                   $active = "kích hoạt";
                             }
               
                             $date = $this->date->getDateTime();
                             $this->model->post('historys',
                             array (
                                   'id_page' => '2',
                                   'date' => $date,
                                   'id_nhanvien' => $_SESSION['id'],
                                   'noidung' => $_SESSION['id'] .' đã ' . $active . ' kho ' .  $id,
                                   )
                             );
                             header("Location: index.php?c=store&a=add");
                             die();
                       }
                  }
                  if ($key == 2 && $value['sua'] !== 1 ) { 
                        
        
                                $error = array (
                                      'name' => 'Thất bại',
                                      'content' => 'Bạn không có quyền chỉnh sửa nội dung này !'
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


     function move_store ($id) {
        $db = new Base_model();

        $GET_Store_move = $db->conn->query("SELECT * FROM kho WHERE id_kho != '$id'");
       
        if (isset($_POST['complete_move'])) {
            $soluong = $_POST['number_move'];
            $khochuyen = $_POST['select_move'];
            $id_hanghoa = $_POST['id_product'];
            $id_kho = $_POST['id_store']; 
            $db->conn->query("UPDATE hanghoa SET soluong = soluong - '$soluong' WHERE id_hanghoa = '$id_hanghoa'");
            
            $_FindStore = $db->conn->query("SELECT * FROM hanghoa WHERE kho = '$khochuyen'");
            $getProduct = $db->conn->query("SELECT * FROM hanghoa WHERE id_hanghoa = '$id_hanghoa'");
            $row = $getProduct->fetch_assoc();
            $check = 0;
            foreach ($_FindStore as $item) {
                 if ($item['tenhanghoa'] == $row['tenhanghoa']) {
                    $id_hanghoachuyen = $item['id_hanghoa'];
                    $db->conn->query("UPDATE hanghoa SET soluong = soluong + '$soluong' WHERE id_hanghoa = '$id_hanghoachuyen'");
                    $check++;
                 }
            }

            if ($check == 0) {
               $name = $row['tenhanghoa'];
               $image = $row['hinhanh'];
               $unit = $row['donvitinh'];
               $quantity = $soluong;
               $price = $row['gianhap'];
               $price_export = $row['giabansi'];
               $price_sell = $row['giabanle'];
               $address = $row['xuatxu'];
               $store = $khochuyen;
               $cate = $row['nhomhang'];
               $note = $_POST['note'];
               $expiry = $row['hansudung'];
               $date = $this->date->getDateTime();
               $db->conn->query("INSERT INTO hanghoa VALUES ('','$name','$image','$unit','$quantity','$price','$price_export','$price_sell','$address','$date','$expiry','$store','$cate','$note')");
            }

            header("Location: index.php?c=store&a=move_store&id=$id_kho");
        }
 
        $data = array (
            'Store_move' => $GET_Store_move
        );

        $this->view->load('index', $data);
     }

     function delete ($id) {
      
      foreach ($_SESSION['function'] as $key => $value) {
            if ($key == 2 && $value['xoa'] == 1 ) {  
                  
                  $this->model->delete('store', $id);
                  $error = array (
                        'name' => 'Thành công',
                        'content' => 'Xóa thành công !'
                  );
        
                  $data = array (
                        'error' => $error,
                        'success' => true
                  );
        
                  $this->view->load('index', $data);
                  die();
            }

            if ($key == 2 && $value['xoa'] !== 1 ) {  

                  $error = array (
                        'name' => 'Thất bại',
                        'content' => 'Bạn không có quyền xóa nội dung này !'
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



     function inventory_excel ($id) {

         $data = "
            <table border='1'>
            <thead>
                  <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn vị tính</th>
                        <th>Giá xuất kho</th>
                        <th>Ngày xuất kho</th>
                        <th>Nhân viên</th>
                        <th>Khách hàng</th>
                        <th>Thành tiền</th>
                        <th>Ghi chú</th>
                  </tr>
            </thead>
            <tbody>
         ";        

                  if (!function_exists('currency_format')) {
                        function currency_format($number, $suffix = ' vnđ')
                        {
                        if (!empty($number)) {
                        return number_format($number, 0, ',', '.') . "{$suffix}";
                        }
                        }
                  }

                  $id_kho = $id;
                  $Products = $this->db->query("SELECT *, c.soluong as soluongxuat, CONCAT(e.tenlot,' ',e.tennhanvien) as hotennhanvien, CONCAT(f.tenlot,' ',f.tenkhachhang) as hotenkhachhang, b.ghichu as ghichuxuat
                                                FROM hanghoa a, hoadonxuatkho b, chitietxuatkho c, donvitinh d, nhanvien e, khachhang f
                                                WHERE a.kho = b.kho AND a.id_hanghoa = c.sanpham AND b.id_hoadonxuatkho = c.hoadon 
                                                AND e.id_nhanvien = b.nhanvien AND f.id_khachhang = b.khachhang AND a.donvitinh = d.id_donvitinh AND a.kho = '$id_kho' AND b.thanhtoan = '0'");
                        $i = 1;
                        $total = 0;
                  foreach ($Products as $product) {
                              $total += $product['soluongxuat'] * $product['giabansi'];
                              $total_product = currency_format($product['soluongxuat'] * $product['giabansi']);
                              extract($product);
                              ob_start();
                             
                              $price_export = currency_format($giabansi);
                              $i++;
                         $data.= "
                              <tr style='text-align: center;'>
                              <td>$i</td>
                              <td>$tenhanghoa</td>
                              <td>$soluongxuat</td>
                              <td>$tendonvitinh</td>
                              <td>$price_export</td>
                              <td>$thoigianxuat</td>
                              <td>$hotennhanvien</td>
                              <td>$hotenkhachhang</td>
                              <td>$total_product</td>
                              <td>$ghichuxuat</td>
                              </tr>
                              ";
                            ob_clean();
                  }
                  $currency = currency_format($total);
                  $data .="
                              <tr style='text-align: center;'>
                              <td colspan='8' style=' font-weight: bold; color: red'>Tổng cộng:</td>
                              <td colspan='1'  style=' font-weight: bold; color: red'>$currency</td>
                              <td></td>
                              </tr>
                        </tbody>
                  </table>
                                          
                  ";

                  echo $data; 
                  
                  $Store = $this->db->query("SELECT * FROM kho WHERE id_kho = '$id'");
                  $row = $Store->fetch_assoc();
                  extract($row);
                  ob_start();
                  $file_name = 'Hàng tồn kho ' . "$tenkho"; 
                  ob_clean();      
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=$file_name.xls");
     }
  }

?>