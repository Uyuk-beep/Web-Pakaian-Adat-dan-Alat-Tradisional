<?php 

require '../session/session.php';

$id_admin = $_SESSION["id_admin"];

include '../../include/function.php';

$nama_admin = admin_login($id_admin);


$semua_blog = query("SELECT * FROM tb_blog");

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Adat Kalteng</title>

		<!-- Link CSS -->
		<!-- <link rel="stylesheet" href="/CSS/admin/produk/produk.css" /> -->
		<link rel="stylesheet" href="/CSS/admin/blog/kelola_blog.css" />


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
				<!-- <div class="menu">
					<a href="../beranda/index.php">Beranda</a>
					<a href="../tentang_kami/tentang_kami.php">Tentang Kami</a>
					<a href="kategori.php" class="active">Kategori</a>
					<a href="../blog/blog.php">Blog</a>
				</div> -->
				<div class="menu">
					<a href="../beranda/index.php">Beranda</a>
					<a href="../produk/produk.php">Produk</a>
					<a href="../kategori/kategori.php">Kategori</a>
					<a href="../kelola_admin/kelola_admin.php">Admin</a>
					<a href="blog.php" class="active">Blog</a>
					<a href="kelola_blog.php" class="kelola-blog active"><i class="fa-solid fa-pen"></i>&nbsp Kelola Blog</a>
					<a href="../tentang_kami/tentang_kami.php">Tentang Kami</a>
					<a href="../statistik/statistik.php">Statistik</a>
				</div>
			</div>
			<div class="main">
				<div class="kelola-admin-atau-logout hide">
					<!-- <a href="../kelola_admin/kelola_admin.php">Kelola Admin</a> -->
					<a href="../logout/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp &nbsp &nbsp &nbsp &nbspLogout</a>
				</div>

				<div class="card">
					<div class="judul-dan-tambah">
						<h2>Kelola Blog</h2>
						<a href="tambah_blog.php"
							>Tambah <i class="fa-solid fa-circle-plus"></i
						></a>
					</div>
					<div class="border">
						<table>
							<tr>
								<th>Nomor</th>
								<th>Gambar</th>
								<th>Judul</th>
								<th>Penulis</th>
								<th>Tanggal</th>
								<th>Aksi</th>
							</tr>
							<?php $i = 1; ?>
							<?php foreach ($semua_blog as $data_blog): ?>
							<tr>
								<td><?= $i; ?></td>
								<td><img src="/img/blog/<?= $data_blog['gambar_blog'] ?>"/></td>
								<td><?= $data_blog['judul'] ?></td>
								<td><?= $data_blog['penulis'] ?></td>
								<td>
									<?php 
										setlocale(LC_TIME, 'id_ID.UTF-8');
										$tanggal = strtotime($data_blog['tanggal']); // Mengubah string tanggal ke timestamp
										echo strftime('%d %B %Y', $tanggal); // Format tanggal menjadi '06 Desember 2024'									
									?>
								</td>
								<td>
									<a href="edit_blog.php?id_blog=<?= $data_blog['id_blog'] ?>" class="ubah">
										Ubah <i class="fa-solid fa-pen"></i>
									</a>
									&nbsp;
									<a href="hapus_blog.php?id_blog=<?= $data_blog['id_blog'] ?>" class="hapus" onclick="return confirm('Yakin menghapus blog ini ?')">
										Hapus <i class="fa-solid fa-trash"></i>
									</a>
								</td>
							</tr>
							<?php $i++; ?>
							<?php endforeach;?>
						
						</table>
					</div>
				</div>
			</div>
		</div>
	</body>

	<script src="/JS/kelola_admin.js"></script>
</html>
