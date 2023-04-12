<?php
 require_once PATH_APPLICATION . '/core/Base_Model.php';

class Excel_Controller extends Base_Controller
{
      function import()
      {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 3 && $value['nhap'] == 1) {

                        if(isset($_POST["submit_import"])){

                              
                              $fileName = $_FILES["file_excel"]["name"];

                              $arr = array('xlsx','xls');
                              $file_check = pathinfo($fileName, PATHINFO_EXTENSION);
                              if (!in_array($file_check, $arr)) {
                                     $error = array(
                                          'name' => 'Thất bại !',
                                          'content' => ' File không đúng đinh dạng !' . '</br/>' . '- Chỉ được nhập file Excel !',
                                     );

                                     $data = array (
                                         'cancel_pos' => true,
                                         'cancel_import' => true,
                                         'fail' => true,
                                         'error' => $error,
                                     );
                                    $this->view->load('index', $data);
                                    die();
                              }

                              $fileExtension = explode('.', $fileName);
                              $fileExtension = strtolower(end($fileExtension));
                              $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;
            
                              $targetDirectory = PATH_APPLICATION . "/public/FileExcel/" . $newFileName;
                              move_uploaded_file($_FILES['file_excel']['tmp_name'], $targetDirectory);
            
                              error_reporting(0);
                              ini_set('display_errors', 0);
            
                              require PATH_APPLICATION . '/Excel-PHP/excel_reader2.php';
                              require PATH_APPLICATION . '/Excel-PHP/SpreadsheetReader.php';
            
                              $reader = new SpreadsheetReader($targetDirectory);
                              foreach($reader as $key => $row){
                                    if ($key !== 0) {
                                          $_SESSION['content_excel'][$key] = array (
                                              '0' => $row[0],
                                              '1' => $row[1],
                                              '2' => $row[2],
                                              '3' => $row[3],
                                              '4' => $row[4],
                                              '5' => $row[5],
                                              '6' => $row[6],
                                              '7' => $row[7],
                                              '8' => $row[8],
                                              '9' => $row[9],
                                              '10' => $row[10],
                                              '11' => $row[11]
                                          );
                                    }

                              }

                              $data = array (
                                    'title_excel' => $title_excel,
                                    'content_excel' => $content_excel,
                                    'cancel_pos' => true,
                                    'cancel_import' => true,
                                    'preview_excel' => true
                              );

                              $this->view->load('index', $data);
                              die();
                        }

                        $this->view->load('index');
                              die();
                  }

                  if ($key == 3 && $value['nhap'] !== 1) {
                        $error = array(
                              'name' => 'Lỗi quyền !',
                              'content' => "Bạn không có quyền thực hiện chức năng này !",
                        );

                        $data = array(
                              'error' => $error,
                              'fail' => true,
                        );

                        $this->view->load('index', $data);
                        die();
                  }
            }
      }


      function cancel_excel () {
            $data = array (
                  'cancel_pos' => true,
                  'cancel_import' => true,
            );
            
            unset($_SESSION['title_excel']);
            unset($_SESSION['content_excel']);
            $this->view->load('index', $data);
            die();
      }


      function save_import_excel () {
            $db = new Base_Model();
            $products = $db->conn->query("SELECT * FROM hanghoa");
                  foreach ($_SESSION['content_excel'] as $key => $value) {
                        $check = 0;
                        $name = $value['0'];
                        $image = $value['1'];
                        $unit = $value['2'];
                        $quantity = $value['3'];
                        $price = $value['4'];
                        $price_sell = $value['5'];
                        $price_export = $value['6'];
                        $address = $value['7'];
                        $expiry = $value['8'];
                        $cateProduct_id = $value['9'];
                        $store_id = $value['10'];
                        $note = $value['11'];
                        $date = $this->date->getDateTime();

                        foreach ($products as $product) {
                              if ($product['tenhanghoa'] == $name && $product['kho'] == $store_id) {
                                    $db->conn->query("UPDATE hanghoa SET soluong = soluong + '$quantity' WHERE tenhanghoa = '$name' AND kho = '$store_id'");
                                    $check++;
                              }

                        }
                        
                        if ($check == 0) {
                              $db->conn->query("INSERT INTO hanghoa VALUES ('','$name','$image','$unit','$quantity','$price','$price_export','$price_sell','$address','$date','$expiry','$store_id','$cateProduct_id','$note')");
                        }

                  }

                  $date = $this->date->getDateTime();
                  $this->model->post('historys',
                        array (
                              'id_page' => '3',
                              'date' => $date,
                              'id_nhanvien' => $_SESSION['id'],
                              'noidung' => $_SESSION['username'] .' đã nhập thành công 1 file Excel'
                        )
                  );
                  

            $error = array(
              'name' => 'Thành công !',
              'content' => 'Nhập file thành công !'
            );

            $data = array (
              'error' => $error,
              'success' => true
            );
            unset($_SESSION['title_excel']);
            unset($_SESSION['content_excel']);
            $this->view->load('index', $data);
            die();
      }


      function export ($id) {
              $db = new Base_Model();
            $products = $db->conn->query("SELECT * FROM hanghoa a, nhomhang b, donvitinh c, kho d WHERE a.nhomhang = b.id_nhomhang AND a.donvitinh = c.id_donvitinh AND a.kho = d.id_kho AND a.kho = '$id'");

            foreach ($products as $key => $product) {
                  $_SESSION['products_export_excel'][$key] = array (
                        'name' => $product['tenhanghoa'],
                        'unit' => $product['tendonvitinh'],
                        'quantity' => $product['soluong'],
                        'price' => $product['gianhap'],
                        'price_sell' => $product['giabanle'],
                        'price_export' => $product['giabansi'],
                        'address' => $product['xuatxu'],
                        'expiry' => $product['hansudung'],
                        'store' => $product['tenkho'],
                        'cate' => $product['tennhomhang'],
                        'note' => $product['ghichu'],
                  );
            }
      
            $Store = $this->model->getOne('store', $id);
            $row = $Store->fetch_assoc();
            $_SESSION['store'] = $row['tenkho'];

              $data = array (
                  'cancel_pos' => true,
                  'cancel_export' => true,
              );

              $this->view->load('index', $data);
              die();

      }

      function cancel_export () {
            unset($_SESSION['products_export_excel']);
            unset($_SESSION['store']);

            $data = array (
                  'cancel_pos' => true,
                  'cancel_export' => true,
              );

            $this->view->load('index', $data);
            die();
      }


      function save_export_excel () {
            $data ="
            <table>
                  <thead>
                        <tr>
                              <th>STT</th>
                              <th>Tên hàng hóa</th>
                              <th>Đơn vị tính</th>
                              <th>Số lượng</th>
                              <th>Giá nhập</th>
                              <th>Giá bán lẻ</th>
                              <th>Giá bán sỉ</th>
                              <th>Xuất xứ</th>
                              <th>Hạn sử dụng</th>
                              <th>Kho</th>
                              <th>Nhóm hàng</th>
                              <th>Ghi chú</th>
                        </tr>
                  </thead>
            <tbody>";
                     
              foreach ($_SESSION['products_export_excel'] as $key => $item) {
                  $index = $key+1;
                  extract($item);
                  ob_start();
                    $data.= "
                        <tr>
                        <td>$index</td>
                           <td>$name</td>
                           <td>$unit</td>
                           <td>$quantity</td>
                           <td>$price</td>
                           <td>$price_sell</td>
                           <td>$price_export</td>
                           <td>$address</td>
                           <td>$expiry</td>
                           <td>$store</td>
                           <td>$cate</td>
                           <td>$note</td>
                        </tr>
                    ";
                    ob_clean();
              }
            $data.= "</tbody>
                         </table>";
            
            echo $data;      
            $filename = "Danh sách hàng hóa " . $_SESSION['store'];       
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=$filename.xls");

            unset($_SESSION['products_export_excel']);
            unset($_SESSION['store']);

            $date = $this->date->getDateTime();
            $this->model->post('historys',
                  array (
                        'id_page' => '3',
                        'date' => $date,
                        'id_nhanvien' => $_SESSION['id'],
                        'noidung' => $_SESSION['username'] .' đã xuất thành công 1 file Excel với tên ' . $filename
                  )
            );
            
      }
}
