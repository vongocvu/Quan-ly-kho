<?php 
  class Distributor_Model extends Base_Model{

      public function get()
      {
            $sql = "SELECT * FROM nhaphanphoi";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function getOne($id) {

            $sql = "SELECT * FROM nhaphanphoi WHERE id_nhaphanphoi = '$id'";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function post($value) {      
                  $name = $value['name'];
                  $taxcode = $value['taxcode'];
                  $phone = $value['phone'];
                  $email = $value['email'];
                  $address = $value['address'];
                  $date = $value['date'];
                  $note = $value['note'];

                  $sql = "INSERT INTO nhaphanphoi (id_nhaphanphoi, tennhaphanphoi, masothue, sodienthoai, email, diachi, ngaytao, ghichu)
                            VALUES ('','$name','$taxcode','$phone','$email','$address','$date','$note')";
                  $this->conn->query($sql);
      }

      public function update($id, $value) {
            $name = $value['name'];
            $taxcode = $value['taxcode'];
            $phone = $value['phone'];
            $email = $value['email'];
            $address = $value['address'];
            $note = $value['note'];

            $sql = "UPDATE nhaphanphoi SET tennhaphanphoi = '$name', masothue = '$taxcode', sodienthoai = '$phone', email = '$email', diachi = '$address', ghichu = '$note' WHERE id_nhaphanphoi = '$id'";
            $this->conn->query($sql);
      }

      public function delete($id) {
            $this->conn->query("DELETE FROM nhaphanphoi WHERE id_nhaphanphoi = '$id'");
      }
  }
?>