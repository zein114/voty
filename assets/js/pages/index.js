// Logout event handler
function logout(event) {
  event.preventDefault();
  fadeOutAndRedirect("core/logout.php");
}

// Attach logout event listener
document.addEventListener("DOMContentLoaded", function () {
  const logoutBtn = document.querySelector(".logout-btn");
  if (logoutBtn) {
    logoutBtn.addEventListener("click", logout);
  }
});

const electedPositions = document.getElementById('elected-positions');
electedPositions.lastElementChild.style.borderBottom = 'none';


if ( !(countSelectInputs % 2 === 0 ) && window.innerWidth > 768 ) {
  selectInputsForm.lastElementChild.style.width = '100%';
  selectInputsForm.lastElementChild.style.marginLeft = '54%';
}