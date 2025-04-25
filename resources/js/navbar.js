window.addEventListener("scroll", () => {
    const navbar = document.getElementById("navbar");
    const logo = document.getElementById("logo");

    if (window.scrollY > 10) {
      navbar.classList.remove("bg-white");
      navbar.classList.add("bg-transparant");
      navbar.classList.add("backdrop-blur-md");

      navbar.classList.replace("text-black", "text-white");

      logo.src = "/images/logoputih.png";
    } else {
      navbar.classList.add("bg-white");
      navbar.classList.remove("bg-transparent");
      navbar.classList.remove("backdrop-blur-md");

      navbar.classList.replace("text-white", "text-black");

      logo.src = "/images/logohitam.png";
    }
  });
