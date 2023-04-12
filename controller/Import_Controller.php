<?php
        require_once PATH_APPLICATION . '/core/Base_Model.php';

  class Import_Controller extends Base_Controller {
      function import () {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ( $key == 3 && $value['nhap'] == 1) {

                        $db = new Base_Model();

                       $getStores = $this->model->get('store');
                       $getDistributors = $this->model->get('distributor');
                       $getUnits = $db->conn->query("SELECT * FROM donvitinh");


                       if (isset($_POST['submit_import'])) {

                          $getStore = $this->model->getOne('store', $_POST['store']);
                          $store = $getStore->fetch_assoc();

                          $getDistributor = $this->model->getOne('distributor', $_POST['distributor']);
                          $distributor = $getDistributor->fetch_assoc();

                           $_SESSION['import_store'] = array (
                                    'kho' => array (
                                          'id' => $_POST['store'],
                                          'name' => $store['tenkho'],
                                          'admin' => $store['quanlykho'],
                              ),
                                    'nhaphanphoi' => array (
                                          'id' => $_POST['distributor'],
                                          'name' => $distributor['tennhaphanphoi'],
                                          'address' => $distributor['diachi'],
                                          'paxcode' => $distributor['masothue']
                                    )
                              );

                        }

                        $getIdStore = 1;
                      
                        if (isset($_SESSION['import_store'])) {
                              $getIdStore = $_SESSION['import_store']['kho']['id'];
                        }
 
                        $getTypeProducts = $this->db->query("SELECT * FROM hanghoa WHERE kho = '$getIdStore'");

                         if (isset($_POST['add_product'])) {

                              if (isset($_SESSION['products'][$_POST['name_products']])) {

                                    $_SESSION['products'][$_POST['name_products']]['quantity'] += $_POST['quantity'];

                              } else {
                                    $id_unit = $_POST['unit'];
                                    $id_cate = $_POST['cate'];
                                    $unit = $this->db->query("SELECT * FROM donvitinh WHERE id_donvitinh = '$id_unit'");
                                    $cate = $this->db->query("SELECT * FROM nhomhang WHERE id_nhomhang = '$id_cate'");
                                    $row_unit = $unit->fetch_assoc();
                                    $row_cate = $cate->fetch_assoc();
                                    $_SESSION['products'][$_POST['name_products']] = array (
                                       'name' => $_POST['name_products'],
                                       'cateProduct'=> $_POST['cate'],
                                       'address' => $_POST['address'],
                                       'price' => $_POST['price'],
                                       'price_sell' => $_POST['price_sell'], 
                                       'price_export' => $_POST['price_export'], 
                                       'quantity' => $_POST['quantity'],
                                       'unit' => $_POST['unit'],
                                       'expiry' => $_POST['expiry'],
                                       'image' => $_FILES['image']['name'],
                                       'note' => $_POST['note'],
                                       'store' => $getIdStore,
                                       'name_unit' =>$row_unit['tendonvitinh'],
                                       'name_cate' =>$row_cate['tennhomhang'],
                                    ); 

                                    $getStores = $this->model->get('store');
                                    $getDistributors = $this->model->get('distributor');
                              }

                         }
                        
                      
                       
                       $data = array (
                           'stores' => $getStores,
                           'distributors' => $getDistributors,
                           'typeProducts' => $getTypeProducts,
                           'units' => $getUnits
                       );


                        $this->view->load('index', $data);
                       die();
                  }

                  if ( $key == 3 && $value['nhap'] !== 1) { 
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


      function cancel_import () {
            unset($_SESSION['import_store']);
            unset($_SESSION['products']);

            
            $getStores = $this->model->get('store');
            $getDistributors = $this->model->get('distributor');
              
            $data = array (
                  'stores' => $getStores,
                  'distributors' => $getDistributors,
              );

            $this->view->load('index', $data);
      }


      function go_invoice () {

            $db = new Base_Model();
            if (empty($_SESSION['products'])) {
                  $error = array (
                        'name' => "Cảnh báo !!!!",
                        'content' => "Phiếu nhập chưa có sản phẩm !!!" . '</br>' . '- Vui lòng kiểm tra lại !!!'
                  );
                  $getIdStore = $_SESSION['import_store']['kho']['id'];
                  $getUnits = $db->conn->query("SELECT * FROM donvitinh");
                  $getTypeProducts = $db->conn->query("SELECT * FROM hanghoa a, nhomhang b, kho c WHERE a.nhomhang = b.id_nhomhang AND a.kho = c.id_kho AND c.id_kho = '$getIdStore'");

                  $data = array (
                        'typeProducts' => $getTypeProducts,
                        'units' => $getUnits,
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
                  $getIdStore = $_SESSION['import_store']['kho']['id'];
                  $getUnits = $db->conn->query("SELECT * FROM donvitinh");
                  $getTypeProducts = $db->conn->query("SELECT * FROM hanghoa a, nhomhang b, kho c WHERE a.nhomhang = b.id_nhomhang AND a.kho = c.id_kho AND c.id_kho = '$getIdStore'");

                  $data = array (
                        'typeProducts' => $getTypeProducts,
                        'units' => $getUnits,
                  );

                  $this->view->load('index', $data);
                  die();
      }


      function complete_import () {
                   $db = new Base_Model();

                   $total_price = 0;
                   $date = $this->date->getDateTime();
                        
                  $curent_user = $_SESSION['id'];
                  $distributor = $_SESSION['import_store']['nhaphanphoi']['id'];
                  $store = $_SESSION['import_store']['kho']['id'];

                  $db->conn->query("INSERT INTO hoadonnhapkho VALUES ('','$curent_user','$distributor','$store','$total_price','0','$date','')");
                  $last_id = mysqli_insert_id($db->conn);

                  foreach ($_SESSION['products'] as $key => $product) {
                        $name = $product['name'];
                        $price = $product['price'];
                        $price_sell = $product['price_sell'];
                        $price_export = $product['price_export'];
                        $unit = $product['unit'];     
                        $quantity = $product['quantity'];
                        $cateProduct_id = $product['cateProduct'];
                        $address = $product['address'];
                        $note = $product['note'];
                        $image = $product['image'];
                        $total_price += $product['price'] * $product['quantity'];
                        $expiry = $product['expiry'];
                        $store = $product['store'];

                        $check = 0;
                        $get_products = $db->conn->query("SELECT * FROM hanghoa");

                        foreach ($get_products as $item) {
                              if ($item['tenhanghoa'] == $name && $item['kho'] == $store) {
                                   $db->conn->query("UPDATE hanghoa SET soluong = soluong + '$quantity' WHERE tenhanghoa = '$name' AND kho = '$store'");
                                   $last_id_product = $item['id_hanghoa'];
                                   $db->conn->query("INSERT INTO chitietnhapkho VALUES ('','$last_id','$last_id_product','$quantity','$note ')");
                                   $check++;
                              }
                        }
                         
                        if ($check == 0) {
                              $db->conn->query("INSERT INTO hanghoa VALUES ('','$name','$image','$unit','$quantity','$price','$price_export','$price_sell','$address','$date','$expiry','$store','$cateProduct_id','$note')");
                              $last_id_product = mysqli_insert_id($db->conn);
                              $db->conn->query("INSERT INTO chitietnhapkho VALUES ('','$last_id','$last_id_product','$quantity','$note ')");
                        }
                  }

                  unset($_SESSION['import_store']);
                  unset($_SESSION['products']);

                  $getStores = $this->model->get('store');
                  $getDistributors = $this->model->get('distributor');


                  $error = array(
                        'name' => "Thành công !",
                        'content' => "In hóa đơn thành công !"    
                  );

                  $date = $this->date->getDateTime();
                  $this->model->post('historys',
                        array (
                              'id_page' => '3',
                              'date' => $date,
                              'id_nhanvien' => $_SESSION['id'],
                              'noidung' => $_SESSION['username'] .' đã nhập kho thành công hóa đơn số  ' . $last_id
                        )
                  );

                  $data = array (
                        'stores' => $getStores,
                        'distributors' => $getDistributors,
                        'error' => $error,
                        'success' => true
                  );


                     $this->view->load('index', $data);
                    die();

            
      }

      function delete_import ($id) {
            $db = new Base_Model();

            foreach ($_SESSION['products'] as $key => $value) {
                  if ($key == $id) {
                        unset($_SESSION['products'][$key]);
                  }
            }
                  $getIdStore = $_SESSION['import_store']['kho']['id'];
                  $getUnits = $db->conn->query("SELECT * FROM donvitinh");
                  $getTypeProducts = $db->conn->query("SELECT * FROM hanghoa a, nhomhang b, kho c WHERE a.nhomhang = b.id_nhomhang AND a.kho = c.id_kho AND c.id_kho = '$getIdStore'");
                  $data = array (
                         'typeProducts' => $getTypeProducts,
                         'units' => $getUnits
                  );
                  $this->view->load('index', $data);
            die();
      }
  }
