<?php 

require '../session/session.php';

$id_admin = $_SESSION["id_admin"];

include '../../include/function.php';

$nama_admin = admin_login($id_admin);

if (isset($_POST['tambah_blog'])) {
	if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $namaFile = $_FILES['gambar']['name']; // Nama file lengkap dengan ekstensi
        $tmpName = $_FILES['gambar']['tmp_name']; // Lokasi file sementara

		if (tambah_blog($_POST, $namaFile) > 0) {
			echo "
				<script>
				alert('Blog berhasil ditambah');
				document.location.href = 'blog.php';
				</script>
				";
		}

		// Menentukan folder tujuan penyimpanan file
		$folderUpload = '../../../img/blog/';
		$fileTujuan = $folderUpload . $namaFile;

        // Memindahkan file ke folder tujuan
        if (move_uploaded_file($tmpName, $fileTujuan)) {
            echo "File berhasil diupload: " . $namaFile;
        } else {
            echo "Gagal mengupload file.";
        }

		
    } else {
		// gambar produk
		$namaFile = 'camera.jpg';
		if (tambah_blog($_POST, $namaFile) > 0) {
			echo "
				<script>
				alert('Blog berhasil ditambah');
				document.location.href = 'blog.php';
				</script>
				";
		}
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
		<link rel="stylesheet" href="/CSS/admin/blog/edit_blog.css" />

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
				<form method="post" enctype="multipart/form-data">
					<div class="border">
						<a class="back" href="kelola_blog.php">
							<i class="fa-solid fa-arrow-left"></i>
						</a>
						<h1>Tambah Blog</h1>
						<div class="input">
							<div class="blog">
								<div class="label-input">
									<label for="judul"
										>Judul</label
									>
									<input
										type="text"
										name="judul"
										id="judul"
										required
									/>
								</div>

								<div class="label-input">
									<label for="penulis"
										>Penulis</label
									>
									<input
										type="text"
										name="penulis"
										id="penulis"
										required
									/>
								</div>

								<div class="label-input">
									<label for="tanggal"
										>Tanggal</label
									>
									<input
										type="date"
										name="tanggal"
										id="tanggal"
										required
									/>
								</div>

								<div class="label-input">
									<label for="deskripsi">Deskripsi</label>
									<textarea name="deskripsi" id="deskripsi" required></textarea>
								</div>
								<button name="tambah_blog">Tambah</button>
							</div>
							<div class="upload-gambar">
								<img src="/img/blog/camera.jpg" />
								<button>
									Tambah Foto
									<i class="fa-solid fa-circle-plus"></i>
									<input type="file" name="gambar" required/>
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>

	<script src="/JS/produk.js"></script>
	<script src="/JS/kelola_admin.js"></script>
</html>
