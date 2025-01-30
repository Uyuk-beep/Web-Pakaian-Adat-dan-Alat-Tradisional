<?php 

require '../session/session.php';

$id_admin = $_SESSION["id_admin"];

include '../../include/function.php';

$nama_admin = admin_login($id_admin);

// $result = mysqli_query($conn, "SELECT * FROM tb_blog");

// $data_blog = mysqli_fetch_assoc($result);

$semua_blog = query("SELECT * FROM tb_blog");

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Adat Kalteng</title>

		<!-- Link CSS -->
		<link rel="stylesheet" href="/CSS/admin/blog/blog.css" />

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
					<a href="../kategori/kategori.php">Kategori</a>
					<a href="blog.php" class="active">Blog</a>
				</div> -->
				<div class="menu">
					<a href="../beranda/index.php">Beranda</a>
					<a href="../produk/produk.php">Produk</a>
					<a href="../kategori/kategori.php">Kategori</a>
					<a href="../kelola_admin/kelola_admin.php">Admin</a>
					<a href="blog.php" class="active">Blog</a>
					<a href="kelola_blog.php" class="kelola-blog"><i class="fa-solid fa-pen"></i>&nbsp Kelola Blog</a>
					<a href="../tentang_kami/tentang_kami.php">Tentang Kami</a>
					<a href="../statistik/statistik.php">Statistik</a>
				</div>
			</div>
			<div class="main">
				<div class="kelola-admin-atau-logout hide">
					<a href="../logout/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp &nbsp &nbsp &nbsp &nbspLogout</a>
				</div>

				<div class="berita">
				<?php foreach ($semua_blog as $data_blog): ?>
					<a href="informasi_blog.php?id_blog=<?= $data_blog['id_blog'] ?>" class="card">
						<img src="/img/blog/<?= $data_blog['gambar_blog'] ?>" alt="">
						<div class="info">
							<h4>
								<?php 
									$judul = $data_blog['judul'];
									$kata = explode(' ', $judul); // Memisahkan judul berdasarkan spasi
									if (count($kata) > 12) {
										$judulPendek = implode(' ', array_slice($kata, 0, 12)) . '...'; // Menggabungkan 17 kata pertama dan menambahkan '...'
									} else {
										$judulPendek = $judul; // Jika kurang dari 17 kata, tampilkan apa adanya
									}
									echo $judulPendek;
								?>
								
							</h4>
							<div class="penulis-tanggal">
								<p>by <?= $data_blog['penulis'] ?></p>
								<p class="tanggal">
									<?php 
										$tanggal = strtotime($data_blog['tanggal']); // Mengubah string tanggal ke timestamp
										echo strftime('%d %B %Y', $tanggal); // Format tanggal menjadi '06 Desember 2024'									
									?>
								</p>
							</div>
							<p>
								<?php 
									$deskripsi = $data_blog['deskripsi_blog'];
									$kata = explode(' ', $deskripsi); // Memisahkan deskripsi berdasarkan spasi
									if (count($kata) > 17) {
										$deskripsiPendek = implode(' ', array_slice($kata, 0, 17)) . '...'; // Menggabungkan 17 kata pertama dan menambahkan '...'
									} else {
										$deskripsiPendek = $deskripsi; // Jika kurang dari 17 kata, tampilkan apa adanya
									}
									echo $deskripsiPendek;
								?>
							</p>
						</div>
					</a>
				<?php endforeach;?>
					
				</div>

			</div>
		</div>
	</body>

	<script src="/JS/kelola_admin.js"></script>
</html>
