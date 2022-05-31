const topBar = document.querySelector('#top-bar');

const header7Init = () => {
  window.addEventListener('scroll', () => {
    const headerHeight = document.querySelector('header')?.getBoundingClientRect().height;
    const navbarHeight = document.querySelector('#top-bar')?.getBoundingClientRect().height;
    topBar?.classList.toggle('sticky', window.scrollY > headerHeight - navbarHeight);
  })
}

// comment out if not used
header7Init();