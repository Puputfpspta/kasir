<?php
session_start();
include "connect.php";

// Mendapatkan nilai dari POST request dengan sanitasi
$kode_order = isset($_POST['kode_order']) ? htmlentities($_POST['kode_order']) : "";
$meja = isset($_POST['meja']) ? htmlentities($_POST['meja']) : "";
$pelanggan = isset($_POST['pelanggan']) ? htmlentities($_POST['pelanggan']) : "";
$catatan = isset($_POST['catatan']) ? htmlentities($_POST['catatan']) : "";
$menu = isset($_POST['menu']) ? htmlentities($_POST['menu']) : "";
$jumlah = isset($_POST['jumlah']) ? htmlentities($_POST['jumlah']) : "";

if (!empty($_POST['input_orderitem_validate'])) {
    // Pengecekan apakah order sudah ada
    $select = mysqli_query($conn, "SELECT * FROM tb_list_order WHERE menu = '$menu' AND kode_order='$kode_order'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Item yang dimasukkan telah ada"); window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
    } else {
        // Pastikan kolom yang dimasukkan sesuai dengan jumlah nilai
        $query = mysqli_query($conn, "INSERT INTO tb_list_order (menu,kode_order,jumlah,catatan) VALUES ('$menu', '$kode_order', '$jumlah', '$catatan')");
        if ($query) { // Jika query berhasil
            $message = '<script>alert("Orderan berhasil dibuat"); window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
        } else { // Jika query gagal
            $message = '<script>alert("Orderan gagal dibuat: ' . mysqli_error($conn) . '"); window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
        }
    }
}
echo $message;
?>