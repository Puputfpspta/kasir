<?php
include "connect.php";

// Mendapatkan nilai dari POST request dengan sanitasi
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
if (!empty($_POST['input_user_validate'])) {
    // Buat query
    $query = "DELETE FROM tb_user WHERE id = '$id'";
    echo "Query: $query<br>"; // Debugging: tampilkan query

    // Eksekusi query
    $result = mysqli_query($conn, $query);

    if ($result) { // Jika query berhasil
        $message = '<script>alert("Data berhasil dihapus"); window.location="../user"</script>';
    } else { // Jika query gagal
        $message = '<script>alert("Data gagal dihapus"); window.location="../user"</script>';
    }
}
echo $message;
?>
