/*
// declare the things
const links = document.querySelectorAll('#nav-main [data-link]');

function initMenuLinks() {
  links?.forEach(link => {
    const subnav = link.closest('li').querySelector('.is_subnav')
    if (!subnav) return
    
    const navHeight = subnav.getBoundingClientRect().height;
    subnav.dataset.height = navHeight;
    
    subnav.style.maxHeight = 0;
    subnav.style.opacity = 1;
    
    link.addEventListener('mouseover', mouseOver);
  })
}

// when hover, open dropdown
function mouseOver(e) {
  const subnav = e.target.closest('li').querySelector('.is_subnav');
  
  subnav.style.maxHeight = `${subnav.dataset.height}px`;
  
  const li = e.target.closest('li');
  
  li.addEventListener('mouseleave', mouseOut);
}

// when mouse leaves, close dropdown
function mouseOut(e) {
  const li = e.target;
  li.querySelector('.is_subnav').style.maxHeight = 0;
}

// do the stuff
initMenuLinks();
*/