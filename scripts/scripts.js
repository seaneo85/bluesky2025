// Mobile Menu Toggle

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

// Home Page Featured Slider

const swiper = new Swiper('.swiper.featured-slider', {
  spaceBetween: 25,
  lazy: true,
  slidesPerView: 1,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
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

const swiperImageWrapper = document.querySelectorAll('.property-image-wrapper');
const swiperNavigationButtons = document.querySelectorAll('.swiper-button-next, .swiper-button-prev');

// set the top position of navigation buttons based on image height
function setSwiperNavButtonPosition() {
  swiperImageWrapper.forEach(wrapper => {
    const imageHeight = wrapper.offsetHeight;
    const navButtonTop = imageHeight / 2;
    swiperNavigationButtons.forEach(button => {
      button.style.top = `${navButtonTop}px`;
    });
  });
}

window.addEventListener('load', setSwiperNavButtonPosition);
window.addEventListener('resize', setSwiperNavButtonPosition);

// Listing Page Slider

const listingPageSlider = new Swiper('.listing-page-swiper.swiper', {
  spaceBetween: 10,
  lazy: true,
  slidesPerView: 1,
  navigation: {
    nextEl: '.listing-page-swiper .swiper-button-next',
    prevEl: '.listing-page-swiper .swiper-button-prev',
  },
  pagination: {
    el: '.listing-page-swiper .swiper-pagination',
    clickable: true,
    dynamicBullets: true,
    dynamicMainBullets: 4,
  }
});
