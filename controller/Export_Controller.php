<?php
        require_once PATH_APPLICATION . '/core/Base_Model.php';

  class Export_Controller extends Base_Controller {
      function export () {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ( $key == 3 && $value['xuat'] == 1) {

                        $db = new Base_Model();

                       $getStores = $this->model->get('store');
                       $getCustomers = $this->model->get('customers');


                       if (isset($_POST['submit_export'])) {

                          if (empty($_POST['store']) || empty($_POST['customer'])) {
                              $error = array (
                                    'name' => "Thất bại",
                                    'content' => "Vui lòng nhập đầy đủ thông tin để xuất kho !"
                              );

                              $data = array (
                                    'stores' => $getStores,
                                    'Customers' => $getCustomers,
                                    'error' => $error,
                                    'fail' => true
                                );
                                $this->view->load('index', $data);
                              die();
                          }

                          $getStore = $this->model->getOne('store', $_POST['store']);
                          $store = $getStore->fetch_assoc();

                          $getCustomer = $this->model->getOne('customers', $_POST['customer']);
                          $Customer = $getCustomer->fetch_assoc();

                           $_SESSION['export_store'] = array (
                                    'kho' => array (
                                          'id' => $_POST['store'],
                                          'name' => $store['tenkho'],
                              ),
                                    'khachhang' => array (
                                          'id' => $_POST['customer'],
                                          'name' => $Customer['hovaten'],
                                          'address' => $Customer['diachi']
                                    )
                              );

                        }

                        $getIdStore = 1;
                      
                        if (isset($_SESSION['export_store'])) {
                              $getIdStore = $_SESSION['export_store']['kho']['id'];
                        }
 
                        $getProducts = $db->conn->query("SELECT * FROM hanghoa a, nhomhang b, kho c WHERE a.nhomhang = b.id_nhomhang AND a.kho = c.id_kho AND c.id_kho = '$getIdStore'");

                         if (isset($_POST['add_product'])) {
                               if ($_POST['name_products'] == "" || $_POST['quantity'] == "" ) {
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

                              if (isset($_SESSION['products_export'][$_POST['name_products']])) {
                                     
                                    $name_product = $_POST['name_products'];
                                    $product = $db->conn->query("SELECT * FROM hanghoa a, nhomhang b, kho c, donvitinh d WHERE a.donvitinh = d.id_donvitinh AND a.nhomhang = b.id_nhomhang AND a.kho = c.id_kho AND a.tenhanghoa = '$name_product'");
                                    $row = $product->fetch_assoc();

                                    if (($row['soluong'] - $_SESSION['products_export'][$_POST['name_products']]['quantity']) < $_POST['quantity']) {
                                          $error = array(
                                                'name' => 'Thất bại !',
                                                'content' => 'Mặt hàng ' . $row['tenhanghoa'] . ' trong kho chỉ còn ' . $row['soluong'] - $_SESSION['products_export'][$_POST['name_products']]['quantity'] . ' ' . $row['tendonvitinh'] . '!'
                                                . '<br/>' . '- Không đủ số lượng để xuất !'
                                                . '<br/>' . '- Vui lòng kiểm tra lại !'
                                          );
                                          $data = array (
                                                'error' => $error,
                                                'fail' => true,
                                                'stores' => $getStores,
                                                'Customers' => $getCustomers,
                                                'Products' => $getProducts,
                                          );

                                          $this->view->load('index', $data);
                                          die();
                                    } else {
                                          $_SESSION['products_export'][$_POST['name_products']]['quantity'] += $_POST['quantity'];
                                    }

                              } else {
                                    $id_store = $_SESSION['export_store']['kho']['id'];
                                    $name_product = $_POST['name_products'];
                                    $products = $db->conn->query("SELECT * FROM hanghoa a, nhomhang b, kho c, donvitinh d WHERE a.donvitinh = d.id_donvitinh AND a.nhomhang = b.id_nhomhang AND a.kho = '$id_store'");
                                    $check = 0;

                                    foreach ($products as $row) {
                                          if ($row['tenhanghoa'] == $name_product) {
                                                $check++;
      
                                                if ($row['soluong'] < $_POST['quantity']) {
                                                      $error = array(
                                                            'name' => 'Thất bại !',
                                                            'content' => 'Mặt hàng ' . $row['tenhanghoa'] . ' trong kho chỉ còn ' . $row['soluong'] . ' ' . $row['tendonvitinh'] . '!'
                                                            . '<br/>' . '- Không đủ số lượng để xuất !'
                                                            . '<br/>' . '- Vui lòng kiểm tra lại !'
                                                      );
            
                                                      $data = array (
                                                            'error' => $error,
                                                            'fail' => true,
                                                            'stores' => $getStores,
                                                            'Customers' => $getCustomers,
                                                            'Products' => $getProducts,
                                                      );
            
                                                      $this->view->load('index', $data);
                                                      die();
            
                                                } else {
                                                      $_SESSION['products_export'][$_POST['name_products']] = array (
                                                         'id' => $row['id_hanghoa'],
                                                         'name' => $row['tenhanghoa'],
                                                         'price' => $row['gianhap'],
                                                         'price_sell' => $row['giabanle'], 
                                                         'price_export' => $row['giabansi'], 
                                                         'unit' => $row['tendonvitinh'],
                                                         'quantity' => $_POST['quantity'],
                                                         'cateProduct'=> $row['tennhomhang'],
                                                         'address' => $row['xuatxu'],
                                                         'note' => $_POST['note'],
                                                      ); 
                  
                                                      $getStores = $this->model->get('store');
                                                      $getCustomers = $this->model->get('customers');
                                                }
                                          } 
                                    }


                                    if ($check == 0) {
                                          $error = array(
                                                'name' => 'Thất bại !',
                                                'content' => 'Mặt hàng ' . $name_product . ' không có trong kho !' . '<br/>' . 'Vui lòng kiểm tra lại !'
                                          );

                                          $data = array (
                                                'error' => $error,
                                                'fail' => true,
                                                'stores' => $getStores,
                                                'Customers' => $getCustomers,
                                                'Products' => $getProducts,
                                          );

                                          $this->view->load('index', $data);
                                          die();
                                    }


                              }

                         }
                        
                      
                       
                       $data = array (
                           'stores' => $getStores,
                           'Customers' => $getCustomers,
                           'Products' => $getProducts,
                       );


                        $this->view->load('index', $data);
                       die();
                  }

                  if ( $key == 3 && $value['xuat'] !== 1) { 
                        $error = array (
                              'name' => "Thất bại",
                              'content' => "Bạn không có quyền nhập kho !",
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


      function cancel_export () {
            unset($_SESSION['export_store']);
            unset($_SESSION['products_export']);

            
            $getStores = $this->model->get('store');
            $getCustomers = $this->model->get('customers');
              
            $data = array (
                  'stores' => $getStores,
                  'Customers' => $getCustomers
              );

            $this->view->load('index', $data);
      }


      function go_invoice () {

            $db = new Base_Model();
            if (empty($_SESSION['products_export'])) {
                  $error = array (
                        'name' => "Cảnh báo !!!!",
                        'content' => "Phiếu xuất chưa có sản phẩm !!!" . '</br>' . '- Vui lòng kiểm tra lại !!!'
                  );
                  $getIdStore = $_SESSION['export_store']['kho']['id'];
                  $getProducts = $db->conn->query("SELECT * FROM hanghoa a, nhomhang b, kho c WHERE a.nhomhang = b.id_nhomhang AND a.kho = c.id_kho AND c.id_kho = '$getIdStore'");

                  $data = array (
                        'Products' => $getProducts,
                        'error' => $error,
                        'fail' => true
                  );

                  $this->view->load('index', $data);
                  die();
            } else {
                  $data = array(
                        'complete' => true
                  );
                  $this->view->load('index', $data);
                  die();
            }
      }

      function comback () {
                  $db = new Base_Model();
                  $getIdStore = $_SESSION['export_store']['kho']['id'];
                  $getProducts = $db->conn->query("SELECT * FROM hanghoa a, nhomhang b, kho c WHERE a.nhomhang = b.id_nhomhang AND b.kho = c.id_kho AND c.id_kho = '$getIdStore'");

                  $data = array (
                        'Products' => $getProducts,
                  );

                  $this->view->load('index', $data);
                  die();
      }


      function complete_export () {
                   $db = new Base_Model();

                  $total_price = 0;

                  foreach ($_SESSION['products_export'] as $key => $product) {
                        $id_product = $product['id'];
                        $quantity = $product['quantity'];
                        $total_price += $product['price_export'] * $product['quantity'] ;
                        $db->conn->query("UPDATE hanghoa SET soluong = soluong - '$quantity' WHERE id_hanghoa = '$id_product'");
                  }

                  $curent_user = $_SESSION['id'];
                  $customer = $_SESSION['export_store']['khachhang']['id'];
                  $store = $_SESSION['export_store']['kho']['id'];
                  $date = $this->date->getDateTime();
                  
                  $db->conn->query("INSERT INTO hoadonxuatkho VALUES ('','$curent_user','$customer','$store','$total_price','0','0','$date','')");
                  $last_id = mysqli_insert_id($db->conn);
                  
                  foreach ($_SESSION['products_export'] as $key => $product) {
                        $id = $product['id'];
                        $quantity = $product['quantity'];
                        $note = $product['note'];
                        $db->conn->query("INSERT INTO chitietxuatkho VALUES ('','$last_id','$id','$quantity','$note ')");
                  }
                  
                  $getStores = $this->model->get('store');
                  $getCustomers = $this->model->get('customers');
                  
                  $date = $this->date->getDateTime();
                  $this->model->post('historys',
                        array (
                              'id_page' => '3',
                              'date' => $date,
                              'id_nhanvien' => $_SESSION['id'],
                              'noidung' => $_SESSION['username'] .' đã xuất kho thành công hóa đơn số  ' . $last_id
                        )
                  );
                  
                  
                  $error = array(
                        'name' => "Thành công !",
                        'content' => "Xuất hóa đơn thành công !"    
                  );
                  
                  $data = array (
                        'stores' => $getStores,
                        'Customers' => $getCustomers,
                        'error' => $error,
                        'success' => true
                  );
                  
                  unset($_SESSION['export_store']);
                  unset($_SESSION['products_export']);

                     $this->view->load('index', $data);
                    die();

            
      }

      function delete_export ($id) {
            $db = new Base_Model();

            foreach ($_SESSION['products_export'] as $key => $value) {
                  if ($key == $id) {
                        unset($_SESSION['products_export'][$key]);
                  }
            }
                  $getIdStore = $_SESSION['export_store']['kho']['id'];
                  $getProducts = $db->conn->query("SELECT * FROM hanghoa a, nhomhang b, kho c WHERE a.nhomhang = b.id_nhomhang AND a.kho = c.id_kho AND a.tenhanghoa = '$getIdStore'");
                  $data = array (
                         'Products' => $getProducts,
                  );
                  $this->view->load('index', $data);
            die();
      }
  }
