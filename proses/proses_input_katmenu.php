<?php
include "connect.php";

// Mendapatkan nilai dari POST request dengan sanitasi
$jenismenu = (isset($_POST['jenismenu'])) ? htmlentities($_POST['jenismenu']) : "";
$katmenu = (isset($_POST['katmenu'])) ? htmlentities($_POST['katmenu']) : "";

// Validasi panjang input sebelum memasukkan ke database
if (strlen($nohp) > 15) {
    echo '<script>alert("Nomor HP terlalu panjang")</script>';
    exit;
}

if (!empty($_POST['input_katmenu_validate'])) {
    //pengecekan username
    $select = mysqli_query($conn, "SELECT kategori_menu FROM tb_kategori_menu WHERE kategori_menu = '$katmenu'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Kategori yang masukan telah ada");
        window.location="../katmenu"</script>';
    } else {
        // Pastikan kolom yang dimasukkan sesuai dengan jumlah nilai
        $query = mysqli_query($conn, "INSERT INTO tb_kategori_menu (jenis_menu, kategori_menu) VALUES ('$jenismenu', '$katmenu')");
        if ($query) { // Jika query berhasil
            $message = '<script>alert("Data berhasil dimasukan");
        window.location="../katmenu"</script>';
        } else { // Jika query gagal
            $message = '<script>alert("Data gagal dimasukan");
        window.location="../katmenu"</script>';
        }
    }
}
echo $message;
?>