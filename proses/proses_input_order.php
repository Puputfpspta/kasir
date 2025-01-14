<?php
session_start();
include "connect.php";

// Mendapatkan nilai dari POST request dengan sanitasi
$kode_order = isset($_POST['kode_order']) ? htmlentities($_POST['kode_order']) : "";
$meja = isset($_POST['meja']) ? htmlentities($_POST['meja']) : "";
$pelanggan = isset($_POST['pelanggan']) ? htmlentities($_POST['pelanggan']) : "";

if (!empty($_POST['input_order_validate'])) {
    // Pengecekan apakah order sudah ada
    $select = mysqli_query($conn, "SELECT * FROM tb_order WHERE id_order = '$kode_order'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Order yang dimasukkan telah ada"); window.location="../order"</script>';
    } else {
        // Pastikan kolom yang dimasukkan sesuai dengan jumlah nilai
        $query = mysqli_query($conn, "INSERT INTO tb_order (id_order, meja, pelanggan, pelayan) VALUES ('$kode_order', '$meja', '$pelanggan', '$_SESSION[id_tbm]')");
        if ($query) { // Jika query berhasil
            $message = '<script>alert("Orderan berhasil dibuat"); window.location="../?x=orderitem&order='.$kode_order.'&meja='.$meja.'&pelanggan='.$pelanggan.'"</script>';
        } else { // Jika query gagal
            $message = '<script>alert("Orderan gagal dibuat: ' . mysqli_error($conn) . '")</script>';
        }
    }
}
echo $message;
?>
