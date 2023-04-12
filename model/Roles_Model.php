<?php 
  class Roles_Model extends Base_Model{

      public function get()
      {
            $sql = "SELECT * FROM roles";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function getOne($id) {

            $sql = "SELECT * FROM roles WHERE id_roles = '$id'";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function post($value) {      
                  $name = $value['name'];
                  $position = $value['position'];
                  $note = $value['note'];

                  $sql = "INSERT INTO roles (id_roles, tenroles, vaitro, ghichu, kichhoat)
                            VALUES ('','$name', '$position', '$note', '1')";
                  $this->conn->query($sql);
                  $result = mysqli_insert_id($this->conn);
                  return $result;
      }

      public function update($id, $value) {      
            $name = $value['name'];
            $position = $value['position'];
            $note = $value['note'];
            $status_active = $value['status_active'];

            $sql = "UPDATE roles SET tenroles = '$name', vaitro = '$position', ghichu = '$note', kichhoat = '$status_active' WHERE id_roles = '$id'";
            $this->conn->query($sql);
}

      public function delete($id) { 
            $sql = "DELETE FROM roles WHERE id_roles = '$id'";
            $this->conn->query($sql);
      }
  }
?>