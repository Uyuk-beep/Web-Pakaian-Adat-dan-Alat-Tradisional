// Ambil elemen yang diperlukan
const editIcon = document.querySelector(".icon .edit");
const textarea = document.querySelector("textarea");

// Variabel untuk melacak status aktif/tidak aktif
let isEditable = false;

// Event listener untuk tombol edit
editIcon.addEventListener("click", () => {
	isEditable = !isEditable; // Toggle status
	if (isEditable) {
		textarea.removeAttribute("disabled"); // Aktifkan textarea
		textarea.focus(); // Fokuskan ke textarea
		editIcon.style.backgroundColor = "blue"; // Ganti warna latar belakang ke hijau (aktif)
		editIcon.style.color = "white";
	} else {
		textarea.setAttribute("disabled", true); // Nonaktifkan textarea
		editIcon.style.backgroundColor = "transparent"; // Kembalikan ke warna awal (nonaktif)
		editIcon.style.color = "blue";
	}
});

const saveButton = document.querySelector("button[name='ubah_deskripsi']");

// Pastikan save button awalnya non-aktif
saveButton.setAttribute("disabled", true);
saveButton.style.cursor = "not-allowed"; // Indikasi visual

// Variabel untuk melacak status apakah sedang editable
let edit = false;
let initialText = textarea.value; // Simpan nilai awal dari textarea

// Fungsi untuk toggle edit mode
editIcon.addEventListener("click", () => {
	edit = !edit; // Toggle status editable
	if (edit) {
		textarea.removeAttribute("disabled"); // Aktifkan textarea
		textarea.focus(); // Fokuskan pada textarea
	} else {
		textarea.setAttribute("disabled", true); // Nonaktifkan textarea
		saveButton.setAttribute("disabled", true); // Nonaktifkan tombol save
		saveButton.style.cursor = "not-allowed"; // Nonaktifkan visual
	}
});

// Event listener untuk mendeteksi perubahan pada textarea
textarea.addEventListener("input", () => {
	if (textarea.value !== initialText) {
		// Aktifkan tombol save jika ada perubahan
		saveButton.removeAttribute("disabled");
		saveButton.style.cursor = "pointer"; // Indikasi visual aktif
	} else {
		// Nonaktifkan tombol save jika tidak ada perubahan
		saveButton.setAttribute("disabled", true);
		saveButton.style.cursor = "not-allowed"; // Indikasi visual nonaktif
	}
});
