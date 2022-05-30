// declare all the things
const subnavs = document.querySelectorAll('#mobile-menu .menu-item-has-children .is_subnav');

function initMobileMenu() {
  const hamburger = document.querySelector('#menuicon');
  const closeBtn = document.querySelector('.fa-xmark');

  // mmmmmm, hamburger
  hamburger.addEventListener('click', () => {
    // Standard style
    // document.querySelector('#mobile-menu').style.display = 'block';

    // Styling for circle reveal menu
    document.querySelector('#mobile-menu').style.display = 'flex';
    toggleMobileMenu();
    disableScroll();
  })

  // deploy the iron curtain and open side menu
  document.querySelector('#mobile-overlay').addEventListener('click', () => {
    subnavs.forEach(sub => {
      sub.style.maxHeight = '0';
    })
    toggleMobileMenu();
    enableScroll();
  })

  // close mobile menu
  closeBtn.addEventListener('click', () => {
    toggleMobileMenu();
    enableScroll();
  })
}

// this is where the fun begins
function toggleMobileMenu() {
  document.body.classList.toggle('mobile-menu-open');
}

// prevent scrolling in all facets when mobile menu is open
// left: 37, up: 38, right: 39, down: 40,
// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
var keys = {37: 1, 38: 1, 39: 1, 40: 1};

function preventDefault(e) {
  e.preventDefault();
}

function preventDefaultForScrollKeys(e) {
  if (keys[e.keyCode]) {
    preventDefault(e);
    return false;
  }
}

// modern Chrome requires { passive: false } when adding event
var supportsPassive = false;
try {
  window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
    get: function () { supportsPassive = true; } 
  }));
} catch(e) { console.log('idk...'); }

var wheelOpt = supportsPassive ? { passive: false } : false;
var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';


// call this to Disable scroll
function disableScroll() {
  window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
  window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
  window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
  window.addEventListener('keydown', preventDefaultForScrollKeys, false);
}

// call this to Enable scroll
function enableScroll() {
  window.removeEventListener('DOMMouseScroll', preventDefault, false);
  window.removeEventListener(wheelEvent, preventDefault, wheelOpt); 
  window.removeEventListener('touchmove', preventDefault, wheelOpt);
  window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
}

// when page loads, do the things
window.addEventListener('DOMContentLoaded', initMobileMenu);