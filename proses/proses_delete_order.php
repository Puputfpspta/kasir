<?php
include "connect.php";

$kode_order = isset($_POST['kode_order']) ? htmlentities($_POST['kode_order']) : "";
$message = "";

if (!empty($_POST['delete_order_validate'])) {
    // Menggunakan prepared statement untuk mencegah SQL injection
    $stmt = $conn->prepare("SELECT kode_order FROM tb_list_order WHERE kode_order = ?");
    $stmt->bind_param("s", $kode_order);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $message = '<script>alert("Order telah memiliki item order yang membuat order ini tidak dapat dihapus"); window.location="../order"</script>';
    } else {
        // Menggunakan prepared statement untuk delete query
        $stmt = $conn->prepare("DELETE FROM tb_order WHERE id_order = ?");
        $stmt->bind_param("s", $kode_order);

        if ($stmt->execute()) {
            $message = '<script>alert("Data berhasil dihapus"); window.location="../order"</script>';
        } else {
            $message = '<script>alert("Data gagal dihapus"); window.location="../order"</script>';
        }
    }
    $stmt->close();
}
echo $message;
?>
