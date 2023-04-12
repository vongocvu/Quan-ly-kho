<?php 
  class Customers_Model extends Base_Model{

      public function get () {
            $sql = "SELECT *, CONCAT(tenlot,' ', tenkhachhang) as hovaten FROM khachhang";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function getOne($id) {

            $sql = "SELECT *, CONCAT(tenlot,' ', tenkhachhang) as hovaten FROM khachhang WHERE id_khachhang = '$id'";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function post($value) {      
                  $last_name = $value['last_name'];
                  $first_name = $value['first_name'];
                  $sex = $value['sex'];
                  $birthday = $value['birthday'];
                  $phone = $value['phone'];
                  $email = $value['email'];
                  $address = $value['address'];
                  $note = $value['note'];
                  $date = $value['date'];

                  $sql = "INSERT INTO khachhang(id_khachhang, tenlot, tenkhachhang, gioitinh, ngaysinh, sodienthoai, email, diachi, ngaytao, ghichu) 
                              VALUES ('','$last_name','$first_name','$sex','$birthday','$phone','$email','$address','$date', '$note')";
                  $this->conn->query($sql);
      }


      public function update ($id, $value) {

            $last_name = $value['last_name'];
            $first_name = $value['first_name'];
            $sex = $value['sex'];
            $birthday = $value['birthday'];
            $phone = $value['phone'];
            $email = $value['email'];
            $address = $value['address'];
            $note = $value['note']; 
             
            $sql = "UPDATE khachhang SET tenlot = '$last_name', tenkhachhang = '$first_name', gioitinh = '$sex', ngaysinh = '$birthday', sodienthoai = '$phone', email = '$email', diachi = '$address', ghichu = '$note' WHERE id_khachhang = '$id'";
            $this->conn->query($sql);
      }

      public function delete ($id) {
            $sql = "DELETE FROM khachhang WHERE id_khachhang = '$id'";
            $this->conn->query($sql);
      }
  }
?>