<?php
session_start();
include "connect.php";

// Mendapatkan nilai dari POST request dengan sanitasi
$kode_order = isset($_POST['kode_order']) ? htmlentities($_POST['kode_order']) : "";
$meja = isset($_POST['meja']) ? htmlentities($_POST['meja']) : "";
$pelanggan = isset($_POST['pelanggan']) ? htmlentities($_POST['pelanggan']) : "";

if (!empty($_POST['edit_order_validate'])) {
        // Pastikan kolom yang dimasukkan sesuai dengan jumlah nilai
        $query = mysqli_query($conn, "UPDATE tb_order SET meja='$meja', pelanggan='$pelanggan' WHERE id_order = '$kode_order'");
        if ($query) { // Jika query berhasil
            $message = '<script>alert("Orderan berhasil diperbarui"); window.location="../order"</script>';
        } else { // Jika query gagal
            $message = '<script>alert("Orderan gagal diperbarui: ' . mysqli_error($conn) . '"); window.location="../order"</script>';
        }
    }
echo $message;
?>
