const links = document.querySelectorAll('#nav-main [data-link]');
const navigation = document.querySelector('nav');
const mobileSubnav = document.querySelector('#mobile-nav');

function initMenuLinks() {
  links.forEach(link => {
    link.addEventListener('mouseover', mouseOver);
  })
}

function mouseOver(e) {
  links.forEach(link => {
    link.dataset.link = '';
  })
  const subnav = e.target.closest('li').querySelector('.is_subnav');
  if (subnav) e.target.closest('li').addEventListener('mouseleave', mouseOut);

  navigation.addEventListener('mouseleave', mouseOut);
  if (!subnav) return;

  subnav.classList.add('is_open');
}

function mouseOut(e) {
  links.forEach(link => {
    if (link !== e.target.closest('li')) {
      const subnav = link.closest('li').querySelector('.is_subnav');
      link.dataset.link = '';
      if (subnav) subnav.classList.remove('is_open');
    } else {
      const subnav = link.closest('li').querySelector('.is_subnav');
      if (subnav) setTimeout( () => subnav.classList.remove('is_open'), 300);
    }
  })
}



//____________________________________// MOBILE MENU
let liHasChildren = document.querySelectorAll('#mobile-menu .menu-item-has-children');

function initMobileMenu() {
  liHasChildren.forEach(li => {
    const subnav = li.querySelector('.is_subnav');
    subnav.dataset.height = subnav.getBoundingClientRect().height;
    subnav.style.maxHeight = '0';
  })
}

function initMobileSubnav() {
  document.querySelectorAll('#mobile-menu li.menu-item-has-children > a').forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      const subnav = link.closest('li').querySelector('ul.is_subnav');
      // console.log(subnav)
      const allSubnavs = document.querySelectorAll('#mobile-menu .is_subnav');
      allSubnavs.forEach(nav => {
        if (nav != subnav) {
          nav.closest('li').classList.add('is_open');
          nav.style.maxHeight = `0`;
        }
      })
      if (subnav.style.maxHeight == '0px' || subnav.style.MaxHeight == '0') {
        subnav.closest('li').classList.add('is_open');
        subnav.style.maxHeight = `${subnav.dataset.height}px`;
      } else {
        subnav.style.maxHeight = `0`;
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


initMenuLinks();
initMobileMenu();
initMobileSubnav();
initMobileIntSubnav();

// window.addEventListener('resize', resizeWindow)

// function resizeWindow() {
//   liHasChildren = document.querySelectorAll('#mobile-menu .menu-item-has-children')
//   initMenuLinks()
//   initMobileMenu()
//   initMobileSubnav()
// }