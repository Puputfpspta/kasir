<?php
include "connect.php";

// Mendapatkan nilai dari POST request dengan sanitasi
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$nama_menu = (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
$keterangan = (isset($_POST['keterangan'])) ? htmlentities($_POST['keterangan']) : "";
$kat_menu = (isset($_POST['kat_menu'])) ? htmlentities($_POST['kat_menu']) : "";
$harga = (isset($_POST['harga'])) ? htmlentities($_POST['harga']) : "";
$stok = (isset($_POST['stok'])) ? htmlentities($_POST['stok']) : "";

$kode_rand = rand(10000, 99999) . "-";
$target_dir = "../assets/img/" . $kode_rand;
$target_file = $target_dir . basename($_FILES['foto']['name']);
$imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (!empty($_POST['input_menu_validate'])) {
    // Validasi ID
    $select = mysqli_query($conn, "SELECT * FROM tb_daftar_menu WHERE id = '$id'");
    if (mysqli_num_rows($select) == 0) {
        $message = '<script>alert("ID Daftar tidak ditemukan");
        window.location="../menu"</script>';
        echo $message;
        exit;
    }
    
    // cek apakah gambar atau bukan
    $cek = getimagesize($_FILES['foto']['tmp_name']);
    if ($cek === false) {
        $message = "Ini bukan file gambar";
        $statusUpload = 0;
    } else {
        $statusUpload = 1;
        if (file_exists($target_file)) {
            $message = "Maaf, file yang dimasukan telah ada";
            $statusUpload = 0;
        } else {
            if ($_FILES['foto']['size'] > 500000) {
                $message = "File foto terlalu besar";
                $statusUpload = 0;
            } else {
                if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
                    $message = "maaf, hanya bisa upload foto dengan format .jpg, .png, .jpeg dan .gif";
                    $statusUpload = 0;
                }
            }
        }
    }

    if ($statusUpload == 0) {
        $message = '<script>alert("' . $message . ', Gambar tidak dapat di upload");
        window.location="../menu"</script>';
    } else {
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $query = mysqli_query($conn, "UPDATE tb_daftar_menu SET foto = '" . $kode_rand . $_FILES['foto']['name'] . "', nama_menu='$nama_menu', keterangan='$keterangan', kategori='$kat_menu', harga='$harga', stok='$stok' WHERE id='$id'");
            if ($query) { // Jika query berhasil
                $message = '<script>alert("Data berhasil diedit");
                window.location="../menu"</script>';
            } else {
                $message = '<script>alert("Data gagal diedit: ' . mysqli_error($conn) . '");
                window.location="../menu"</script>';
            }
        } else {
            $message = '<script>alert("Maaf, terjadi kesalahan yang menyebabkan file tidak dapat diupload");
            window.location="../menu"</script>';
        }
    }
}
echo $message;
?>
