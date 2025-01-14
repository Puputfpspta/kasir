<?php
session_start();
include "connect.php";

$id = isset($_POST['id']) ? htmlentities($_POST['id']) : "";
$catatan = isset($_POST['catatan']) ? htmlentities($_POST['catatan']) : "";

if (!empty($_POST['terima_orderitem_validate'])) {
        $query = mysqli_query($conn, "UPDATE tb_list_order SET catatan='$catatan', status=1 WHERE id_list_order='$id'");
        if ($query) { // Jika query berhasil
            $message = '<script>alert("Berhasil dikirim oleh kurir"); window.location="../dapur"</script>';
        } else { // Jika query gagal
            $message = '<script>alert("Gagal dikirim oleh kurir"); window.location="../dapur"</script>';
        }
    }

echo $message;
?>