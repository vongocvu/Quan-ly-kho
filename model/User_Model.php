<?php 
  class User_Model extends Base_Model{

      public function get_join()
      {
            $sql = "SELECT * , CONCAT(tenlot,' ', tennhanvien) as hovaten, a.kichhoat as user_kichhoat  FROM nhanvien a, bophan b, chucvu c, roles d WHERE a.chucvu = c.id_chucvu AND a.bophan = b.id_bophan AND a.id_roles = d.id_roles";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function get () {
            $sql = "SELECT *, CONCAT(tenlot,' ', tennhanvien) as hovaten FROM nhanvien";
            $result = $this->conn->query($sql);
            return $result;
      }

      public function getOne($id) {

            $sql = "SELECT * FROM nhanvien WHERE id_nhanvien = '$id'";
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
                  $password = $value['password'];
                  $address = $value['address'];
                  $part = $value['part'];
                  $position = $value['position'];
                  $date = $value['date'];
                  $roles = $value['roles'];
                  $status_active = $value['status_active'];

                  $sql = "INSERT INTO nhanvien(id_nhanvien, tenlot, tennhanvien, gioitinh, ngaysinh, sodienthoai, email, password, diachi, bophan, chucvu, id_roles, ngaytao, kichhoat) 
                              VALUES ('','$last_name','$first_name','$sex','$birthday','$phone','$email','$password','$address','$part','$position','$roles','$date','$status_active')";
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
            $part = $value['part']; 
            $position = $value['position'];
            $roles = $value['roles'];
            $status_active = $value['status_active'];
             
            $sql = "UPDATE nhanvien SET tenlot = '$last_name', tennhanvien = '$first_name', gioitinh = '$sex', ngaysinh = '$birthday', sodienthoai = '$phone', email = '$email', diachi = '$address', bophan = '$part', chucvu = '$position', id_roles = '$roles', kichhoat = '$status_active' WHERE id_nhanvien = '$id'";
            $this->conn->query($sql);
      }

      public function delete ($id) {
            $sql = "DELETE FROM nhanvien WHERE id_nhanvien = '$id'";
            $this->conn->query($sql);
      }
  }
?>