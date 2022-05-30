// DIFFERENTIATE BETTWEEN MOUSE/KEYBOARD INPUT
window.addEventListener('keydown', addTabClass);
window.addEventListener('click', removeTabClass);

// add tab class when tab button is pressed for conditional accessibility mode
function addTabClass(e) {
  if (e.keyCode !== 9) return;
  document.body.classList.add('accessibility-enabled');
}

// remove tab class from body upon mouse click to disable assessibility mode
function removeTabClass(e) {
  document.body.classList.remove('accessibility-enabled');
}