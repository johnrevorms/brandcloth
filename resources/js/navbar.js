window.addEventListener("scroll", () => {
    const navbar = document.getElementById("navbar");
    const logo = document.getElementById("logo");
    const profile = document.getElementById("profile");
    const keranjang = document.getElementById("keranjang");
    const links = document.querySelectorAll("#navbar a");

    if (window.scrollY > 10) {
        // SCROLL: background putih + teks hitam
        navbar.classList.add("bg-white");
        navbar.classList.remove("bg-transparent", "backdrop-blur-md");

        links.forEach((link) => {
            link.classList.remove("text-white");
            link.classList.add("text-black");
        });

        logo.src = "/images/logohitam.png";
        profile.src = "/images/profile.png";
        keranjang.src = "/images/keranjang.png";

    } else {
        // POSISI ATAS: transparan + teks putih
        navbar.classList.remove("bg-white");
        navbar.classList.add("bg-transparent", "backdrop-blur-md");

        links.forEach((link) => {
            link.classList.remove("text-black");
            link.classList.add("text-white");
        });

        logo.src = "/images/logoputih.png";
        profile.src = "/images/profilputih.png";
        keranjang.src = "/images/keranjangputih.png";
    }
});
