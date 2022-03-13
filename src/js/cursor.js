const cursor = document.querySelector('#cursor')

const mouse = {
  pos: {
    x: null,
    y: null
  }
}

const updateMousePosition = () => {
  cursor.style.left = `${mouse.pos.x - 13}px`
  cursor.style.top = `${mouse.pos.y - 13}px`
}

const handleMouseMove = e => {
  mouse.pos.x = e.clientX
  mouse.pos.y = e.clientY
  updateMousePosition()
}

// UNCOMMENT THIS TO INITIATE
// document.addEventListener('mousemove', handleMouseMove)