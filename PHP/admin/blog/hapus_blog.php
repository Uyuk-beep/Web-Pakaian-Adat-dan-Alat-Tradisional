<?php 
require '../session/session.php';
include '../../include/function.php';

$id_blog = $_GET["id_blog"];

// cek apakah data berhasil dihapus atau tidak
if( hapus_blog($id_blog) > 0) {
    echo "
        <script> 
            alert('Blog berhasil dihapus');
            document.location.href = 'kelola_blog.php';
        </script>
    ";
} else {
    echo "
        <script> 
            alert('Blog gagal dihapus');
            document.location.href = 'kelola_blog.php';
        </script>
    ";

}