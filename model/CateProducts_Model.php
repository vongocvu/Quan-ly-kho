<?php 
  class CateProducts_Model extends Base_Model{

      public function get()
      {
            $sql = "SELECT * FROM nhomhang";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function getOne($id) {

            $sql = "SELECT * FROM nhomhang WHERE id_nhomhang = '$id'";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function post($value) {      
                  $name = $value['name'];
                  $expiry = $_POST['expiry'];
                  $note = $value['note'];

                  $sql = "INSERT INTO nhomhang (id_nhomhang, tennhomhang, hansudung, ghichu)
                            VALUES ('','$name', '$expiry','$note')";
                  $this->conn->query($sql);
      }

      public function update($id, $value) {
              $name = $value['name'];
              $expiry = $_POST['expiry'];
              $note = $value['note'];

            $sql = "UPDATE nhomhang SET tennhomhang = '$name', hansudung = '$expiry', ghichu = '$note' WHERE id_nhomhang = '$id'";
            $this->conn->query($sql);
      }

      public function delete($id) {
            $this->conn->query("DELETE FROM nhomhang WHERE id_nhomhang = '$id'");
      }
  }
?>