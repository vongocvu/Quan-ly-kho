<?php 
   class Historys_Model extends Base_Model {
      public function get () {
            $sql = "SELECT * FROM nhatky";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function getOne($id) {
            $sql = "SELECT * FROM nhatky WHERE id_nhatky = '$id'";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function post($value) {
            $id_page = $value['id_page'];
            $date = $value['date'];
            $id_nhanvien = $value['id_nhanvien'];
            $noidung = $value['noidung'];
            $sql = "INSERT INTO nhatky 
                        VALUES('','$id_page', '$date', '$id_nhanvien', '$noidung')";
            $this->conn->query($sql);
      }
   }
   
?>