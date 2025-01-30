<?php 

require '../session/session.php';

$id_admin = $_SESSION["id_admin"];

include '../../include/function.php';

$nama_admin = admin_login($id_admin);

$id_kategori = $_GET['id_kategori'];

$kategori_berdasarkan_id = kategori_berdasarkan_id($id_kategori);


if (isset($_GET['ubah_kategori'])) {

    if (ubah_kategori($_GET) > 0) {
        echo "
            <script>
            alert('Kategori berhasil diubah');
            document.location.href = 'kategori.php';
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
		<link rel="stylesheet" href="/CSS/admin/kategori/edit_kategori.css" />

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
					<a class="back" href="kategori.php">
						<i class="fa-solid fa-arrow-left"></i>
					</a>
					<h1>Edit Kategori</h1>
					<br />

					<form action="" method="get">
						<label for="kategori">Kategori</label>
						<?php foreach ($kategori_berdasarkan_id as $kategori): ?>
						<input
							type="text"
							name="kategori"
							id="kategori"
							value="<?= $kategori['kategori'] ?>"
							required
						/>
						<input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori'] ?>">
						<?php endforeach;?>

						<button name="ubah_kategori">Edit</button>
					</form>
				</div>
			</div>
		</div>
	</body>

	<script src="/JS/kelola_admin.js"></script>
</html>