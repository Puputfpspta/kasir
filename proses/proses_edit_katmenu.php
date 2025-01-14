<?php
include "connect.php";

// Mendapatkan nilai dari POST request dengan sanitasi
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$jenismenu = (isset($_POST['jenismenu'])) ? htmlentities($_POST['jenismenu']) : "";
$katmenu = (isset($_POST['katmenu'])) ? htmlentities($_POST['katmenu']) : "";

if (!empty($_POST['input_katmenu_validate'])) {
    // Validasi ID
    $select = mysqli_query($conn, "SELECT * FROM tb_kategori_menu WHERE id_kat_menu = '$id'");
    if (mysqli_num_rows($select) == 0) {
        $message = '<script>alert("ID kategori menu tidak ditemukan");
        window.location="../katmenu"</script>';
        echo $message;
        exit;
    }
    
    // Pengecekan apakah kategori menu yang baru sudah ada di kategori lain
    $select = mysqli_query($conn, "SELECT kategori_menu FROM tb_kategori_menu WHERE kategori_menu = '$katmenu' AND id_kat_menu != '$id'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Kategori Beras yang dimasukan telah ada");
        window.location="../katmenu"</script>';
    } else {
        // Update query
        $query = "UPDATE tb_kategori_menu SET jenis_menu='$jenismenu', kategori_menu='$katmenu' WHERE id_kat_menu='$id'";
        echo "Query: $query<br>"; // Debugging: tampilkan query

        $result = mysqli_query($conn, $query);

        if ($result) { // Jika query berhasil
            $message = '<script>alert("Data berhasil diedit"); window.location="../katmenu"</script>';
        } else { // Jika query gagal
            $message = '<script>alert("Data gagal diedit: ' . mysqli_error($conn) . '"); window.location="../katmenu"</script>';
        }
    }
}
echo $message;
?>
