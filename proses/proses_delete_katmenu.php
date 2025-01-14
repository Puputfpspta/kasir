<?php
include "connect.php";

// Mendapatkan nilai dari POST request dengan sanitasi
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($_POST['hapus_kategori_validate'])) {
    // Buat query
    $select = mysqli_query($conn, "SELECT kategori FROM tb_daftar_menu WHERE kategori = '$id'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Kategori tidak dapat dihapus karena sedang digunakan dalam daftar beras");
        window.location="../katmenu"</script>';
    }else{
    $query = "DELETE FROM tb_kategori_menu WHERE id_kat_menu = '$id'";
    echo "Query: $query<br>"; // Debugging: tampilkan query

    // Eksekusi query
    $result = mysqli_query($conn, $query);

    if ($result) { // Jika query berhasil
        $message = '<script>alert("Kategori berhasil dihapus"); window.location="../katmenu"</script>';
    } else { // Jika query gagal
        $message = '<script>alert("Kategori Gagal dihapus"); window.location="../katmenu"</script>';
    }
}
}

echo $message;
?>