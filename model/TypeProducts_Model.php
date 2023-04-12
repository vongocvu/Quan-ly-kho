<?php 
  class TypeProducts_Model extends Base_Model{

      public function get()
      {
            $sql = "SELECT * FROM loaihanghoa";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function get_join()
      {
            $sql = "SELECT *, a.ghichu as ghichu_hanghoa FROM loaihanghoa a, kho b, nhomhang c WHERE a.nhomhang = c.id_nhomhang AND b.id_kho = c.kho";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function getOne($id) {

            $sql = "SELECT * FROM loaihanghoa WHERE id_loaihanghoa = '$id'";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function post($value) {      
                  $name = $value['name'];
                  $type_product = $value['type_product'];
                  $note = $value['note'];

                  $sql = "INSERT INTO loaihanghoa (id_loaihanghoa, tenloaihanghoa, nhomhang, ghichu)
                            VALUES ('','$name', '$type_product','$note')";
                  $this->conn->query($sql);
      }

      public function update($id, $value) {
              $name = $value['name'];
              $type_product = $value['type_product'];
              $note = $value['note'];

            $sql = "UPDATE loaihanghoa SET tenloaihanghoa = '$name', nhomhang = '$type_product', ghichu = '$note' WHERE id_loaihanghoa = '$id'";
            $this->conn->query($sql);
      }

      public function delete($id) {
            $this->conn->query("DELETE FROM loaihanghoa WHERE id_loaihanghoa = '$id'");
      }
  }
?>