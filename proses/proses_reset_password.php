<?php
include "connect.php";

// Mendapatkan nilai dari POST request dengan sanitasi
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
if (!empty($_POST['input_user_validate'])) {
    // Buat query
    $query = mysqli_query($conn, "UPDATE tb_user SET password=md5('password') WHERE id = '$id'");
    // Eksekusi query
    if ($query) { // Jika query berhasil
        $message = '<script>alert("Password berhasil direset"); window.location="../user"</script>';
    } else { // Jika query gagal
        $message = '<script>alert("password gagal direset")</script>';
    }
}
echo $message;
?>
