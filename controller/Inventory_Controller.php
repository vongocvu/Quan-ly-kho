<?php
        require_once PATH_APPLICATION . '/core/Base_Model.php';

  class Inventory_Controller extends Base_Controller {
      function inventory_export ($id) {
            foreach ($_SESSION['function'] as $key => $value) {
                  if ( $key == 3 && $value['sua'] == 1) {
                        $db = new Base_Model();
                        if (isset($_GET['status_pay'])){
                              $pay = $_GET['status_pay'];
                              $db->conn->query("UPDATE hoadonxuatkho SET thanhtoan = '$pay' WHERE id_hoadonxuatkho = '$id'");
                        }

                        if (isset($_GET['status_ship'])){
                              $ship = $_GET['status_ship'];
                              $db->conn->query("UPDATE hoadonxuatkho SET giaohang = '$ship' WHERE id_hoadonxuatkho = '$id'");
                        }

                        $data = array(
                              'inventory' => $_GET['store'],
                        );

                        $this->view->load('index', $data);
                  }
            }
      }

      function show_detail($id) {
            $db = new Base_Model();
            $detail_inventory = $db->conn->query("SELECT *,b.ghichu as ghichuxuat, b.soluong as soluongxuat FROM chitietxuatkho b, donvitinh c, hanghoa d, nhomhang e
                                                   WHERE b.sanpham = d.id_hanghoa  AND d.donvitinh = c.id_donvitinh 
                                                   AND d.nhomhang = e.id_nhomhang AND b.hoadon = '$id'");
            $data = array (
                  'inventory' => $_GET['store'],
                  'products_detail' => $detail_inventory
            );

            $this->view->load('index', $data);
      }

      function go_inventory ($id) {
            $data = array (
                  'inventory' => $id
            );

            $this->view->load('index', $data);
      }
}
?>