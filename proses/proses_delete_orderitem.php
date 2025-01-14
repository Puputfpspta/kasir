<?php
include "connect.php";
$kode_order = isset($_POST['kode_order']) ? htmlentities($_POST['kode_order']) : "";
$meja = isset($_POST['meja']) ? htmlentities($_POST['meja']) : "";
$pelanggan = isset($_POST['pelanggan']) ? htmlentities($_POST['pelanggan']) : "";


$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
if (!empty($_POST['delete_orderitem_validate'])) {
        $query = "DELETE FROM tb_list_order WHERE id_list_order = '$id'";
        echo "Query: $query<br>"; 

        $result = mysqli_query($conn, $query);

        if ($result) { 
            $message = '<script>alert("Data berhasil dihapus"); window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';

        } else { 
            $message = '<script>alert("Data gagal dihapus"); window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
        }
    }
echo $message;
?>