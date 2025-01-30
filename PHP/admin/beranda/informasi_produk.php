<?php 

require '../session/session.php';

$id_admin = $_SESSION["id_admin"];

include '../../include/function.php';

$nama_admin = admin_login($id_admin);

$id_produk = $_GET['id_produk'];

$result = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id_produk = $id_produk");

$data_informasi_produk = mysqli_fetch_assoc($result);

$query = "SELECT tp.*, tdp.*
	FROM tb_produk AS tp
	INNER JOIN tb_detail_produk AS tdp
	ON tp.id_produk = tdp.id_produk 
	WHERE tp.id_produk = '$id_produk'
	GROUP BY tp.id_produk";

$data_produk = tampilkan_semua_produk($query);

if (isset($_GET['ubah_deskripsi'])) {
    if (ubah_detail_produk($_GET) > 0) {
        echo "
            <script>
            alert('Deskripsi produk berhasil diubah');
            document.location.href = 'index.php';
            </script>
            ";
    }
} 



?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Adat Kalteng</title>

		<!-- Link CSS -->
		<link rel="stylesheet" href="/CSS/admin/beranda/informasi_produk.css" />

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
					<!-- <a href="/PHP/pengunjung/index.php">Logout</a> -->
					<a href="../logout/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp &nbsp &nbsp &nbsp &nbspLogout</a>
				</div>

				<div class="card">
					<a class="back" href="index.php">
						<i class="fa-solid fa-arrow-left"></i>
					</a>
					<?php foreach ($data_produk as $produk): ?>
					<h1><?= $produk['nama_produk'] ?></h1>
					<br/>
					<div class="info">
						<div class="border-img">
							<img
								src="/img/<?= $produk['gambar_produk'] ?>"
								alt="Product Image"
							/>
							<div class="image-gallery">
								<?php if ( $produk['video_produk'] != '') : ?>
									<img src="/img/<?= $produk['gambar_produk'] ?>">
									<video>
										<source src="/video/<?= $produk['video_produk'] ?>" type="video/mp4">
									</video>
								<?php else : ?>
									<img src="/img/<?= $produk['gambar_produk'] ?>">
								<?php endif; ?>
									
							</div>
						</div>
						<p><?= $produk['deskripsi'] ?></p>
					</div>
					<?php endforeach;?>
				</div>
			</div>
		</div>

		<div id="video-overlay" class="hidden">
			<div class="video-container">
				<video controls width="320" id="overlay-video">
					<source src="/video/Kecapi.mp4" type="video/mp4">
					Browser Anda tidak mendukung video.
				</video>
				<span id="close-overlay">&times;</span>
			</div>
		</div>

	</body>

	<script>
		document.addEventListener("DOMContentLoaded", function () {
			const videoThumbnails = document.querySelectorAll(".image-gallery video");
			const videoOverlay = document.getElementById("video-overlay");
			const overlayVideo = document.getElementById("overlay-video");
			const closeOverlay = document.getElementById("close-overlay");

			videoThumbnails.forEach((thumbnail) => {
				thumbnail.addEventListener("click", function () {
					const videoSource = thumbnail.querySelector("source").src;
					overlayVideo.querySelector("source").src = videoSource;
					overlayVideo.load();
					videoOverlay.classList.remove("hidden");
				});
			});

			closeOverlay.addEventListener("click", function () {
				overlayVideo.pause();
				videoOverlay.classList.add("hidden");
			});

			// Optional: Close overlay when clicking outside the video
			videoOverlay.addEventListener("click", function (e) {
				if (e.target === videoOverlay) {
					overlayVideo.pause();
					videoOverlay.classList.add("hidden");
				}
			});
		});

	</script>

	<script src="/JS/script_informasi_produk.js"></script>
	<script src="/JS/kelola_admin.js"></script>
</html>
