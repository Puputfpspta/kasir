<?php
include "connect.php";

// Mendapatkan nilai dari POST request dengan sanitasi
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$name = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";
$password = md5('password');

// Validasi panjang input sebelum memasukkan ke database
if (strlen($nohp) > 15) {
    echo '<script>alert("Nomor HP terlalu panjang")</script>';
    exit;
}

$message = ""; // Inisialisasi variabel $message

if (!empty($id) && !empty($_POST['input_user_validate'])) {
    // Debugging: cek nilai yang diterima dari form
    echo "ID: $id<br>";
    echo "Name: $name<br>";
    echo "Username: $username<br>";
    echo "Level: $level<br>";
    echo "No HP: $nohp<br>";
    echo "Alamat: $alamat<br>";
    //pengecekan username
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' AND id != '$id'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Username yang masukan telah ada");
        window.location="../user"</script>';
    } else {
        // Update query
        $query = "UPDATE tb_user SET nama='$name', username='$username', nohp='$nohp', alamat='$alamat', level='$level' WHERE id='$id'";
        echo "Query: $query<br>"; // Debugging: tampilkan query

        $result = mysqli_query($conn, $query);

        if ($result) { // Jika query berhasil
            $message = '<script>alert("Data berhasil diupdate"); window.location="../user"</script>';
        } else { // Jika query gagal
            $message = '<script>alert("Data gagal diupdate: ' . mysqli_error($conn) . '"); window.location="../user"</script>';
        }
    }
} else {
    $message = '<script>alert("Data tidak lengkap"); window.location="../user"</script>';
}
echo $message;
?>
