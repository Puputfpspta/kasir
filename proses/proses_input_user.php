<?php
include "connect.php";

// Mendapatkan nilai dari POST request dengan sanitasi
$name = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";
$password = md5('password'); // Pastikan ini sesuai kebutuhan Anda

// Validasi panjang input sebelum memasukkan ke database
if (strlen($nohp) > 15) {
    echo '<script>alert("Nomor HP terlalu panjang")</script>';
    exit;
}

if (!empty($_POST['input_user_validate'])) {
    //pengecekan username
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Username yang masukan telah ada");
        window.location="../user"</script>';
    } else {
        // Pastikan kolom yang dimasukkan sesuai dengan jumlah nilai
        $query = mysqli_query($conn, "INSERT INTO tb_user (nama, username, level, nohp, alamat, password) VALUES ('$name', '$username', '$level', '$nohp', '$alamat', '$password')");
        if ($query) { // Jika query berhasil
            $message = '<script>alert("Data berhasil dimasukan");
        window.location="../user"</script>';
        } else { // Jika query gagal
            $message = '<script>alert("Data gagal dimasukan: ' . mysqli_error($conn) . '")</script>';
        }
    }
}
echo $message;
?>