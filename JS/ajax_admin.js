const kategoriSelect = document.getElementById("kategori-select");
const productContainer = document.getElementById("product-container");

// Event listener untuk perubahan pada dropdown
kategoriSelect.addEventListener("change", function () {
	const kategoriId = kategoriSelect.value;

	// Buat objek AJAX
	const ajax = new XMLHttpRequest();

	// Respon dari server
	ajax.onreadystatechange = function () {
		if (ajax.readyState === 4 && ajax.status === 200) {
			productContainer.innerHTML = ajax.responseText;
		}
	};

	// Eksekusi permintaan ke server
	ajax.open(
		"GET",
		`/PHP/admin/beranda/get_produk.php?kategori=${kategoriId}`,
		true
	);
	ajax.send();
});
