<?php
include "connect.php";

// Mendapatkan nilai dari POST request dengan sanitasi
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$foto = (isset($_POST['foto'])) ? htmlentities($_POST['foto']) : "";
if (!empty($_POST['input_menu_validate'])) {
    // Buat query untuk menghapus baris terkait di tb_list_order
    $query1 = "DELETE FROM tb_list_order WHERE menu = '$id'";
    echo "Query: $query1<br>"; // Debugging: tampilkan query

    // Eksekusi query
    $result1 = mysqli_query($conn, $query1);

    if ($result1) { // Jika query pertama berhasil
        // Buat query untuk menghapus baris di tb_daftar_menu
        $query2 = "DELETE FROM tb_daftar_menu WHERE id = '$id'";
        echo "Query: $query2<br>"; // Debugging: tampilkan query

        // Eksekusi query
        $result2 = mysqli_query($conn, $query2);

        if ($result2) { // Jika query kedua berhasil
            unlink("../assets/img/$foto");
            $message = '<script>alert("daftar beras berhasil dihapus"); window.location="../menu"</script>';
        } else { // Jika query kedua gagal
            $message = '<script>alert("Gagal menghapus daftar beras"); window.location="../menu"</script>';
        }
    } else { // Jika query pertama gagal
        $message = '<script>alert("Gagal menghapus order terkait"); window.location="../menu"</script>';
    }
}
echo $message;
?>