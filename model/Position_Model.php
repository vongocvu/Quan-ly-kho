<?php 
  class Position_Model extends Base_Model{

      public function get()
      {
            $sql = "SELECT * FROM chucvu";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function getOne($id) {

            $sql = "SELECT * FROM chucvu WHERE id_chucvu = '$id'";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function post($value) {      
                  $name = $value['name'];
                  $part = $value['part'];
                  $note = $value['note'];

                  $sql = "INSERT INTO chucvu(id_chucvu, tenchucvu, bophan, ghichu)
                            VALUES ('','$name','$part','$note')";
                  $this->conn->query($sql);
      }

      public function update ($id, $value) {
            $name = $value['name'];
            $part = $value['part'];
            $note = $value['note'];

            $sql = "UPDATE chucvu SET tenchucvu = '$name', bophan = '$part', ghichu = '$note' WHERE id_chucvu = '$id'";
            $this->conn->query($sql);
      }

      public function delete ($id) {
            $this->conn->query("DELETE FROM chucvu WHERE id_chucvu = '$id'");
      }
  }
?>