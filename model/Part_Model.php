<?php 
  class Part_Model extends Base_Model{

      public function get()
      {
            $sql = "SELECT * FROM bophan";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function getOne($id) {

            $sql = "SELECT * FROM bophan WHERE id_bophan = '$id'";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function post($value) {      
                  $name = $value['name'];
                  $note = $value['note'];

                  $sql = "INSERT INTO bophan (id_bophan, tenbophan, ghichu)
                            VALUES ('','$name','$note')";
                  $this->conn->query($sql);
      }

      public function update($id, $value) {
              $name = $value['name'];
              $note = $value['note'];

            $sql = "UPDATE bophan SET tenbophan = '$name', ghichu = '$note' WHERE id_bophan = '$id'";
            $this->conn->query($sql);
      }

      public function delete($id) {
            $this->conn->query("DELETE FROM bophan WHERE id_bophan = '$id'");
      }
  }
?>