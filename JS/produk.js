const image = document.querySelector(".main .border .upload-gambar img"),
	input = document.querySelector(".main .border .upload-gambar input");

input.addEventListener("change", () => {
	image.src = URL.createObjectURL(input.files[0]);
});
