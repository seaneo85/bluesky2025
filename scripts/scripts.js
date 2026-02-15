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

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape' && navMenu.classList.contains('visible')) {
    navMenu.classList.remove('visible');
  }
});

// Home Page Featured Slider

const swiper = new Swiper('.swiper.featured-slider', {
  spaceBetween: 25,
  lazy: true,
  slidesPerView: 'auto',
  centeredSlides: true,
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
      centeredSlides: false,
    },
    900: {
      slidesPerView: 3,
      centeredSlides: false,
    }
  }
});

const swiperImageWrapper = document.querySelectorAll('.property-image-wrapper');
const swiperNavigationButtons = document.querySelectorAll('.swiper-button-next, .swiper-button-prev');

// set the top position of navigation buttons based on image height
function setSwiperNavButtonPosition() {
  if (swiperImageWrapper.length > 0) {
    const imageHeight = swiperImageWrapper[0].offsetHeight;
    const navButtonTop = imageHeight / 2;
    swiperNavigationButtons.forEach(button => {
      button.style.top = `${navButtonTop}px`;
    });
  }
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

// Lightbox functionality for listing page slider
const lightboxOverlay = document.createElement('div');
lightboxOverlay.className = 'lightbox-overlay';
lightboxOverlay.innerHTML = `
  <div class="lightbox-container">
    <button class="lightbox-close">&times;</button>
    <div class="lightbox-slider swiper">
      <div class="swiper-wrapper"></div>
      <div class="lightbox-nav lightbox-prev swiper-button-prev"></div>
      <div class="lightbox-nav lightbox-next swiper-button-next"></div>
    </div>
  </div>
`;
document.body.appendChild(lightboxOverlay);

let lightboxSwiper;

// Make listing slider images clickable
document.addEventListener('click', function(e) {
  const clickedImage = e.target.closest('.listing-page-swiper img');
  if (clickedImage) {
    e.preventDefault();
    openLightbox(clickedImage);
  }
});

function openLightbox(clickedImage) {
  const allImages = document.querySelectorAll('.listing-page-swiper img');
  const clickedIndex = Array.from(allImages).indexOf(clickedImage);
  
  // Clear existing slides
  const lightboxWrapper = lightboxOverlay.querySelector('.swiper-wrapper');
  lightboxWrapper.innerHTML = '';
  
  // Add all images to lightbox slider
  allImages.forEach(img => {
    const slide = document.createElement('div');
    slide.className = 'swiper-slide';
    slide.innerHTML = `<img src="${img.src}" alt="${img.alt}">`;
    lightboxWrapper.appendChild(slide);
  });
  
  // Show lightbox
  lightboxOverlay.classList.add('active');
  document.body.style.overflow = 'hidden';
  
  // Initialize or update lightbox swiper
  if (lightboxSwiper) {
    lightboxSwiper.destroy();
  }
  
  lightboxSwiper = new Swiper('.lightbox-slider', {
    spaceBetween: 0,
    slidesPerView: 1,
    initialSlide: clickedIndex,
    keyboard: {
      enabled: true,
    },
    navigation: {
      nextEl: '.lightbox-next',
      prevEl: '.lightbox-prev',
    },
  });
}

function closeLightbox() {
  lightboxOverlay.classList.remove('active');
  document.body.style.overflow = '';
  if (lightboxSwiper) {
    lightboxSwiper.destroy();
    lightboxSwiper = null;
  }
}

// Close lightbox on overlay click, close button, or escape key
lightboxOverlay.addEventListener('click', function(e) {
  // Close if clicking on the overlay background, close button, or container
  if (e.target === lightboxOverlay || 
      e.target.classList.contains('lightbox-close') ||
      e.target.classList.contains('lightbox-container')) {
    closeLightbox();
  }
});

// Close when clicking on lightbox slide area but not on the image or navigation
document.addEventListener('click', function(e) {
  if (lightboxOverlay.classList.contains('active') && 
      e.target.closest('.lightbox-slider .swiper-slide') && 
      e.target.tagName !== 'IMG' &&
      !e.target.closest('.lightbox-nav')) {
    closeLightbox();
  }
});

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape' && lightboxOverlay.classList.contains('active')) {
    closeLightbox();
  }
});
