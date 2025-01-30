<?php 

require '../session/session.php';

$id_admin = $_SESSION["id_admin"];

include '../../include/function.php';

$nama_admin = admin_login($id_admin);

$id_blog = $_GET['id_blog'];

$result = mysqli_query($conn, "SELECT * FROM tb_blog WHERE id_blog = $id_blog");

$data_blog = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Adat Kalteng</title>

		<!-- Link CSS -->
		<link rel="stylesheet" href="/CSS/admin/blog/informasi_blog.css" />

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
			<div class="main">
				<div class="kelola-admin-atau-logout hide">
					<!-- <a href="../kelola_admin/kelola_admin.php">Kelola Admin</a> -->
					<a href="../logout/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp &nbsp &nbsp &nbsp &nbspLogout</a>
				</div>

				<div class="card">
					<a class="back" href="blog.php">
						<i class="fa-solid fa-arrow-left"></i>
					</a>
					<div class="informasi-blog">
						<h4><?= $data_blog['judul'] ?></h4>
						<br>
						<img src="/img/blog/<?= $data_blog['gambar_blog'] ?>" alt="">
						<div class="penulis-tanggal">
							<p class="sumber">by <?= $data_blog['penulis'] ?></p>
							<br><br>
							<p class="tanggal">
								<?php 
									setlocale(LC_TIME, 'id_ID.UTF-8');
									$tanggal = strtotime($data_blog['tanggal']); // Mengubah string tanggal ke timestamp
									echo strftime('%d %B %Y', $tanggal); // Format tanggal menjadi '06 Desember 2024'									
								?>
							</p>
						</div>
						<p class="deskripsi"><?= nl2br($data_blog['deskripsi_blog']) ?></p>
					</div>
				</div>
			</div>
		</div>
	</body>

	<script src="/JS/kelola_admin.js"></script>
</html>
