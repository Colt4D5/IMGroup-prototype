// I do declare...
const navigation = document.querySelector('nav');
const mobileSubnav = document.querySelector('#mobile-nav');


//____________________________________// MOBILE MENU

// declare that mobile stuffs
let liHasChildren = document.querySelectorAll('#mobile-menu .menu-item-has-children');

// the magic that handles subnav heights
function initMobileMenu() {
  liHasChildren.forEach(li => {
    const subnav = li.querySelector('.is_subnav');
    subnav.dataset.height = subnav.getBoundingClientRect().height;
    subnav.style.maxHeight = '0';
  })
}

// event listener for mobile hamburger menu for items with sub-items
function initMobileSubnav() {
  document.querySelectorAll('#mobile-menu li.menu-item-has-children > a').forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      const subnav = link.closest('li').querySelector('ul.is_subnav');
      // console.log(subnav)
      const allSubnavs = document.querySelectorAll('#mobile-menu .is_subnav');
      allSubnavs.forEach(nav => {
        if (nav != subnav) {
          nav.closest('li').classList.remove('is_open');
          nav.style.maxHeight = `0`;
        }
      })
      if (subnav.style.maxHeight == '0px' || subnav.style.MaxHeight == '0') {
        subnav.closest('li').classList.add('is_open');
        subnav.style.maxHeight = `${subnav.dataset.height}px`;
      } else {
        subnav.closest('li').classList.remove('is_open');
        subnav.style.maxHeight = `0`;
        // subnav.closest('li').classList.remove('is_open');
      }
    })
  })
  if (innerWidth > 1024) document.querySelector('#mobile-menu').style.display = 'none';
}

//____________________________________// MOBILE SUBNAV MENU

function initMobileIntSubnav() {
  const mobileSubnav = document.querySelector('#mobile-nav');
  if (mobileSubnav) {
    mobileSubnav.addEventListener('click', toggleMobileSubnav);
    const subnav = document.querySelector('#mobile-subnav');
    subnav.setAttribute('data-height', subnav.getBoundingClientRect().height);
    subnav.style.maxHeight = 0;
    subnav.style.opacity = 1;
    subnav.style.position = 'relative';
    subnav.style.pointerEvents = 'auto';
  }
}

function toggleMobileSubnav() {
  const subnav = document.querySelector('#mobile-subnav');
  if (subnav.style.maxHeight != '0px') {
    subnav.style.maxHeight = 0;
  } else {
    subnav.style.maxHeight = `${subnav.dataset.height}px`;
  }
  // subnav.style.display = 'block'
}

// do the things
initMobileMenu();
initMobileSubnav();
initMobileIntSubnav();