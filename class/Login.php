<?php
// session_start(); 
include_once("Database.php");

class Login extends Database
{
    public function authLogin($data)
    {
        $username = $data["username"];
        $password = $data["password"];

        $sql1 = "SELECT * FROM user WHERE username = '$username'";
        $cek_user = $this->db->query($sql1)->fetch_assoc();

        if (!empty($cek_user)) {
            if ($password == $cek_user['password']) {

                $_SESSION['id'] = $cek_user["id"];

                if ($cek_user['role'] == 'admin') {
                    header("Location: admin/index.php  ");
                } elseif ($cek_user['role'] == 'user') {
                    header("Location: user/index.php");
                }
            }
        } else {
            echo "GAGAL LOGIN";
        }
    }

    public function lastlog($id){
        $join_date = date("Y-m-d H:i:s");

        $sql = "UPDATE user SET terakhir_login='$join_date' WHERE id='$id'";

        if ($this->db->query($sql) == TRUE) {
            echo "Berhasil";
        } else {
            echo "Gagal";
        }
    }
}
