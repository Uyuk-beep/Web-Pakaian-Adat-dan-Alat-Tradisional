<?php 
require '../session/session.php';
include '../../include/function.php';

$id_kategori = $_GET["id_kategori"];

// cek apakah data berhasil dihapus atau tidak
if( hapus_kategori($id_kategori) > 0) {
    echo "
        <script> 
            alert('Kategori berhasil dihapus');
            document.location.href = 'kategori.php';
        </script>
    ";
} else {
    echo "
        <script> 
            alert('Kategori gagal dihapus');
            document.location.href = 'kategori.php';
        </script>
    ";

}