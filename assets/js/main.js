const mobileMenuButton = document.getElementById("mobile-menu-button");
const mobileMenu = document.getElementById("mobile-menu");

if (mobileMenuButton && mobileMenu) {
  mobileMenuButton.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
  });
}

document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    const href = this.getAttribute("href");
    if (href !== "#" && document.querySelector(href)) {
      e.preventDefault();
      document.querySelector(href).scrollIntoView({
        behavior: "smooth",
      });
    }
  });
});

function validateForm(formId) {
  const form = document.getElementById(formId);
  if (!form) return;

  form.addEventListener("submit", function (e) {
    let isValid = true;
    const inputs = form.querySelectorAll("input[required], textarea[required]");

    inputs.forEach((input) => {
      if (!input.value.trim()) {
        isValid = false;
        input.classList.add("border-red-500");

        input.addEventListener("input", function () {
          this.classList.remove("border-red-500");
        });
      }
    });

    const emailInput = form.querySelector('input[type="email"]');
    if (emailInput && emailInput.value) {
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(emailInput.value)) {
        isValid = false;
        emailInput.classList.add("border-red-500");
      }
    }

    if (!isValid) {
      e.preventDefault();
      showNotification("Mohon lengkapi semua field yang diperlukan", "error");
    }
  });
}

function showNotification(message, type = "success") {
  const notification = document.createElement("div");
  notification.className = `fixed top-20 right-4 px-6 py-4 rounded-lg shadow-lg z-50 transform transition-all duration-300 ${
    type === "success" ? "bg-green-500" : "bg-red-500"
  } text-white`;
  notification.textContent = message;

  document.body.appendChild(notification);

  setTimeout(() => {
    notification.style.opacity = "0";
    setTimeout(() => notification.remove(), 300);
  }, 3000);
}

document.addEventListener("DOMContentLoaded", function () {
  validateForm("contact-form");
  validateForm("login-form");
  validateForm("register-form");

  const currentPage = window.location.pathname.split("/").pop() || "index.php";
  document.querySelectorAll("nav a").forEach((link) => {
    if (link.getAttribute("href") === currentPage) {
      link.classList.add("text-primary");
    }
  });

  loadImagesWithSkeleton();
});

function loadImagesWithSkeleton() {
  const images = document.querySelectorAll("img[data-src]");

  images.forEach((img) => {
    const parent = img.parentElement;
    parent.classList.add("skeleton");
  });

  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const img = entry.target;
        const parent = img.parentElement;

        img.onload = function () {
          parent.classList.remove("skeleton");
          img.classList.add("fade-in");
        };

        img.src = img.dataset.src;
        observer.unobserve(img);
      }
    });
  });

  images.forEach((img) => imageObserver.observe(img));
}

window.addEventListener("scroll", function () {
  const scrollBtn = document.getElementById("scroll-to-top");
  if (scrollBtn) {
    if (window.pageYOffset > 300) {
      scrollBtn.classList.remove("hidden");
    } else {
      scrollBtn.classList.add("hidden");
    }
  }
});

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}

document.querySelectorAll(".news-card").forEach((card) => {
  card.addEventListener("mouseenter", function () {
    this.style.transform = "translateY(-5px)";
  });

  card.addEventListener("mouseleave", function () {
    this.style.transform = "translateY(0)";
  });
});
