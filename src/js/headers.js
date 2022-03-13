// const headers = document.querySelectorAll('.swiper-slide')

// if (innerWidth < 640) {
//   headers.forEach(hdr => {
//     hdr.style.backgroundImage = `url(${hdr.dataset.mobileUrl})`
//   })
// }

// window.addEventListener('resize', handleHeaderImgs)

function handleHeaderImgs() {
  if (innerWidth < 640) {
    headers.forEach(hdr => {
      hdr.style.backgroundImage = `url(${hdr.dataset.mobileUrl})`;
    })
  } else {
    headers.forEach(hdr => {
      hdr.style.backgroundImage = `url(${hdr.dataset.desktopUrl})`;
    })
  }
}