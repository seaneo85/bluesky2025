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