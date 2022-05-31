// declare the things
const links = document.querySelectorAll('#nav-main [data-link]');

function initMenuLinks() {
  links?.forEach(link => {
    link.addEventListener('mouseover', mouseOver);
  })
}

// when hover, open dropdown
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

// when mouse leaves, close dropdown
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

// do the stuff
initMenuLinks();