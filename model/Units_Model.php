<?php 
  class Units_Model extends Base_Model{

      public function get()
      {
            $sql = "SELECT * FROM donvitinh";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function getOne($id) {

            $sql = "SELECT * FROM donvitinh WHERE id_donvitinh = '$id'";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function post($value) {      
                  $name = $value['name'];
                  $note = $value['note'];

                  $sql = "INSERT INTO donvitinh (id_donvitinh, tendonvitinh, ghichu)
                            VALUES ('','$name','$note')";
                  $this->conn->query($sql);
      }

      public function update($id, $value) {
              $name = $value['name'];
              $note = $value['note'];

            $sql = "UPDATE donvitinh SET tendonvitinh = '$name', ghichu = '$note' WHERE id_donvitinh = '$id'";
            $this->conn->query($sql);
      }

      public function delete($id) {
            $this->conn->query("DELETE FROM donvitinh WHERE id_donvitinh = '$id'");
      }
  }
?>