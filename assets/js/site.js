console.log('Enqueued site.js');

const subnavs = document.querySelectorAll('#mobile-menu .menu-item-has-children .is_subnav');

function initMobileMenu() {
  const hamburger = document.querySelector('#menuicon');

  hamburger.addEventListener('click', () => {
    document.querySelector('#mobile-menu').style.display = 'block';
    toggleMobileMenu();
    disableScroll();
  })

  document.querySelector('#mobile-overlay').addEventListener('click', () => {
    subnavs.forEach(sub => {
      sub.style.maxHeight = '0';
    })
    toggleMobileMenu();
    enableScroll();
  })
}

function toggleMobileMenu() {
  document.body.classList.toggle('mobile-menu-open');
}

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
} catch(e) {}

var wheelOpt = supportsPassive ? { passive: false } : false;
var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';


// call this to Disable
function disableScroll() {
  window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
  window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
  window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
  window.addEventListener('keydown', preventDefaultForScrollKeys, false);
}

// call this to Enable
function enableScroll() {
  window.removeEventListener('DOMMouseScroll', preventDefault, false);
  window.removeEventListener(wheelEvent, preventDefault, wheelOpt); 
  window.removeEventListener('touchmove', preventDefault, wheelOpt);
  window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
}

window.addEventListener('DOMContentLoaded', initMobileMenu);



// DIFFERENTIATE BETTWEEN MOUSE/KEYBOARD INPUT
window.addEventListener('keydown', addTabClass);
window.addEventListener('click', removeTabClass);

function addTabClass(e) {
  if (e.keyCode !== 9) return;
  document.body.classList.add('accessibility-enabled');
}

function removeTabClass(e) {
  document.body.classList.remove('accessibility-enabled');
}