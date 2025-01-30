<?php
require '../session/session.php';
include '../../include/function.php';

// Tangkap ID kategori dari parameter GET
$kategoriId = $_GET['kategori'];

// Query produk berdasarkan kategori
if ($kategoriId === "all") {
    // Jika "Semua Produk" dipilih, ambil semua produk
    $query = "SELECT * FROM tb_produk";
} else {
    // Jika kategori tertentu dipilih
    $query = "SELECT * FROM tb_produk WHERE id_kategori = '$kategoriId'";
}

$produk = tampilkan_semua_produk($query);

// Outputkan produk dalam format HTML
if (!empty($produk)): ?>
    <?php foreach ($produk as $item): ?>
        <a class="product-card" href="informasi_produk.php?id_produk=<?= $item['id_produk'] ?>">
            
            <img src="/img/<?= $item['gambar_produk'] ?>" alt="Product Image" />
            <p><?= $item['nama_produk'] ?></p>
        </a>
    <?php endforeach; ?>
<?php else: ?>
    <p>Produk tidak ditemukan.</p>
<?php endif; ?>
