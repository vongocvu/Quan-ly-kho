<?php 
  class Function_Model extends Base_Model {
      public function get () {
            $sql = "SELECT * FROM chucnang";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function get_join () {
            $sql = "SELECT * FROM chucnang a, quyenquanly b WHERE a.id_chucnang = b.chucnang";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function getOne ($id) {
            $sql = "SELECT * FROM chucnang a, quyenquanly b WHERE a.id_chucnang = b.chucnang AND b.chucnang = '$id'";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function post($value) {
             $id_roles = $value['id_roles'];
             $id_chucnang = $value['id_chucnang'];   

            $sql = "INSERT INTO quyenquanly 
                      VALUES('','0','0','0','0','0','0','0','$id_roles','$id_chucnang')";
            $this->conn->query($sql);
      }

      public function update ($id, $value) {
            $truycap = $value['truycap'];
            $them = $value['them'];
            $sua = $value['sua'];
            $xoa = $value['xoa'];
            $in = $value['in'];
            $nhap = $value['nhap'];
            $xuat = $value['xuat'];
            $sql = "UPDATE quyenquanly SET truycap = '$truycap', them = '$them', sua = '$sua', xoa = '$xoa', quyen_in = '$in', nhap = '$nhap', xuat = '$xuat' 
                    WHERE id_quyenquanly = '$id'";
                    $this->conn->query($sql);
      }

      public function delete ($id) {
            $this->conn->query("DELETE FROM quyenquanly WHERE id_roles = '$id'");
      }
  }
?>