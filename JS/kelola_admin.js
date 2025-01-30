const aiBtn = document.querySelector(".navbar .menu .admin")
const aiChat = document.querySelector(".main .kelola-admin-atau-logout")

aiBtn.addEventListener("click", () => {
    aiChat.classList.toggle("hide")
})