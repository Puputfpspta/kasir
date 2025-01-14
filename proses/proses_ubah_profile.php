<?php
session_start();
include "connect.php";

// Mendapatkan nilai dari POST request dengan sanitasi

$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";

if (!empty($_POST['ubah_profile_validate'])) {
            $query = mysqli_query($conn, "UPDATE tb_user SET nama='$nama', nohp='$nohp', alamat='$alamat' WHERE username = '$_SESSION[username_tbm]'");
            if ($query) {
                $message = '<script>alert("Data profile berhasil diupdate"); window.history.back()</script>';
            }else{
                $message = '<script>alert("Data profile gagal diupdate"); window.history.back()</script>';
            }
        }else{
            $message = '<script>alert("Terjadi kesalahan saat update profile"); window.history.back()</script>';
        }
echo $message;
?>