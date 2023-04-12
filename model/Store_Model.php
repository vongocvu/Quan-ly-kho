<?php 
  class Store_Model extends Base_Model{


      public function get_join () {
            $sql = "SELECT *, CONCAT(b.tenlot, ' ', b.tennhanvien) as hovaten, c.kichhoat as store_kichhoat FROM khuvuc a, nhanvien b, kho c WHERE a.quanlykhuvuc = b.id_nhanvien AND a.id_khuvuc = c.khuvuc";
            $result = $this->conn->query($sql);
            return $result;
      }


      public function get()
      {
            $sql = "SELECT * FROM kho";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function getOne($id) {

            $sql = "SELECT * FROM kho WHERE id_kho = '$id'";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function post($value) {      
                  $name = $value['name'];
                  $admin = $value['admin'];
                  $area = $value['area'];
                  $note = $value['note'];

                  $sql = "INSERT INTO kho(id_kho, tenkho, quanlykho, khuvuc, kichhoat, ghichu)
                            VALUES ('','$name','$admin','$area','1','$note')";
                  $this->conn->query($sql);
      }

      public function update($id, $value) {
            $name = $value['name'];
            $admin = $value['admin'];
            $area = $value['area'];
            $status_active = $value['status_active'];
            $note = $value['note'];

            $sql = "UPDATE kho SET tenkho = '$name', quanlykho = '$admin', khuvuc = '$area', kichhoat = '$status_active', ghichu = '$note'
                        WHERE id_kho = '$id'";
            $this->conn->query($sql);
      }

      public function delete ($id) {
            $sql = "DELETE FROM kho WHERE id_kho = '$id'";
            $this->conn->query($sql);
      }
  }
?>