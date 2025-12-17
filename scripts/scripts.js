const mobileMenuButton = document.getElementById('menu-toggle');
const navMenu = document.getElementById('nav-toggle-container');
const navOverlay = document.getElementById('top-nav')

mobileMenuButton.addEventListener('click', () => {
  navMenu.classList.toggle('visible');
});

navOverlay.addEventListener('click', () => {
  if (navMenu.classList.contains('visible')) {
    navMenu.classList.remove('visible');
  }
});

const swiper = new Swiper('.swiper', {
  spaceBetween: 25,
  lazy: true,
  slidesPerView: 1,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  breakpoints: {
    768: {
      slidesPerView: 2,
    },
    900: {
      slidesPerView: 3,
    }
  }
});
