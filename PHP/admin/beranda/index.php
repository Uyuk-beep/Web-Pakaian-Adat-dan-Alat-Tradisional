<?php 

require '../session/session.php';

$id_admin = $_SESSION["id_admin"];

include '../../include/function.php';

$nama_admin = admin_login($id_admin);

$semua_produk = tampilkan_semua_produk("SELECT * FROM tb_produk");

$semua_kategori = tampilkan_semua_kategori("SELECT * FROM tb_kategori");

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Adat Kalteng</title>

		<!-- Link CSS -->
		<link rel="stylesheet" href="/CSS/admin/beranda/index.css" />

		<!-- Font Awesome -->
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
			integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		/>

		<!-- Google Font -->
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
			rel="stylesheet"
		/>
	</head>
	<body>
		<div class="container poppins">
			<div class="navbar">
				<h1>ADAT KALTENG</h1>
				<div class="menu">
					<div class="admin">
						<i class="fa-solid fa-user"></i>
						&nbsp;&nbsp;<?= $nama_admin['nama'] ?>
					</div>
				</div>
			</div>
			<div class="sidebar">
				<div class="menu">
					<a href="index.php" class="active">Beranda</a>
					<a href="../produk/produk.php">Produk</a>
					<a href="../kategori/kategori.php">Kategori</a>
					<a href="../kelola_admin/kelola_admin.php">Admin</a>
					<a href="../blog/blog.php">Blog</a>
					<a href="../tentang_kami/tentang_kami.php">Tentang Kami</a>
					<a href="../statistik/statistik.php">Statistik</a>
				</div>
			</div>
			<div class="main">
				<div class="kelola-admin-atau-logout hide">
					<!-- <a href="../kelola_admin/kelola_admin.php">Kelola Admin</a> -->
					<!-- <a href="/PHP/pengunjung/index.php">Logout</a> -->
					<a href="../logout/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp &nbsp &nbsp &nbsp &nbspLogout</a>
				</div>

				<!-- Kategori -->
				<select class="kategori" id="kategori-select">
					<option value="all">-- Semua Produk --</option>
					<?php foreach ($semua_kategori as $kategori): ?>
						<option value="<?= $kategori['id_kategori'] ?>"><?= $kategori['kategori'] ?></option>
					<?php endforeach;?>
				</select>

				<!-- Product -->
				<div class="product" id="product-container">
					<?php foreach ($semua_produk as $produk): ?>
					<a class="product-card" href="informasi_produk.php?id_produk=<?= $produk['id_produk'] ?>">
						<!-- <img
							src="https://via.placeholder.com/100"
							alt="Product Image"
						/>
						<p>Nama Produk</p> -->
						<img
							src="/img/<?= $produk['gambar_produk'] ?>"
							alt="Product Image"
						/>
						<p><?= $produk['nama_produk'] ?></p>
					</a>
					<?php endforeach;?>
				</div>
			</div>
		</div>
	</body>

	
	<script src="/JS/ajax_admin.js"></script>
	<script src="/JS/kelola_admin.js"></script>
</html>
