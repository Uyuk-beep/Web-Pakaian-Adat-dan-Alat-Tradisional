<?php 

require '../session/session.php';

$id_admin = $_SESSION["id_admin"];

include '../../include/function.php';

$nama_admin = admin_login($id_admin);

$id_blog = $_GET['id_blog'];

$result = mysqli_query($conn, "SELECT * FROM tb_blog WHERE id_blog = $id_blog");

$data_blog = mysqli_fetch_assoc($result);

if (isset($_POST['ubah_blog'])) {
	if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $namaFile = $_FILES['gambar']['name']; // Nama file lengkap dengan ekstensi
        $tmpName = $_FILES['gambar']['tmp_name']; // Lokasi file sementara

		if (ubah_blog($_POST, $namaFile) > 0) {
			echo "
				<script>
				alert('Blog berhasil diubah');
				document.location.href = 'kelola_blog.php';
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
		$id_blog_sekarang = $_POST['id_blog_sekarang'];
		$result = mysqli_query($conn, "SELECT * FROM tb_blog WHERE id_blog = $id_blog_sekarang");
		$gambar_blog = mysqli_fetch_assoc($result);
		$namaFile = $gambar_blog['gambar_blog'];
		if (ubah_blog($_POST, $namaFile) > 0) {
			echo "
				<script>
				alert('Blog berhasil diubah');
				document.location.href = 'kelola_blog.php';
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
						<h1>Ubah Blog</h1>
						<div class="input">
							<div class="blog">
								<input type="hidden" name="id_blog" value="<?= $data_blog['id_blog'] ?>">
								<input type="hidden" name="id_blog_sekarang" value="<?= $data_blog['id_blog'] ?>">
								<div class="label-input">
									<label for="judul"
										>Judul</label
									>
									<input
										type="text"
										name="judul"
										id="judul"
										value="<?= $data_blog['judul'] ?>"
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
										value="<?= $data_blog['penulis'] ?>"
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
										value="<?= $data_blog['tanggal'] ?>"
										required
									/>
								</div>

								<div class="label-input">
									<label for="deskripsi">Deskripsi</label>
									<textarea name="deskripsi" id="deskripsi" required><?= $data_blog['deskripsi_blog'] ?></textarea>
								</div>
								<button name="ubah_blog">Ubah</button>
							</div>
							<div class="upload-gambar">
								<img src="/img/blog/<?= $data_blog['gambar_blog'] ?>" />
								<button>
									Ubah Foto
									<i class="fa-solid fa-circle-plus"></i>
									<input type="file" name="gambar"/>
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
