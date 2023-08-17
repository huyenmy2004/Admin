// const buttons = document.querySelectorAll(".fa-bars");
// const contents = document.querySelectorAll(".sidebar, .navbar");

// buttons.forEach((button, index) => {
//   button.addEventListener('click', () => {
//     buttons.forEach(button=>{button.classList.remove('active')});
//   button.classList.toggle('active');

//   contents.forEach(contents=>{contents.classList.remove('active')});
//   contents[index].classList.toggle('active');
//   })

// })

// const toggle = document.querySelector(".fa-bars");
// const sidebar = document.querySelector(".sidebar");

// toggle.addEventListener('click', () => {
//     sidebar.classList.toggle('active');
// })

const ball = document.querySelector(".fa-bars");
const items = document.querySelectorAll(
  ".sidebar, .navbar, .content, .navbar-user"
);

ball.addEventListener("click", () => {
  items.forEach((item) => {
    item.classList.toggle("active");
  });
  ball.classList.toggle("active");
});


const popup = document.querySelector(".button-cancle");
const confirm = document.querySelector(".confirm-popup");

function confirmCancle() {
  confirm.classList.toggle("open-popup");
  popupDeletes.classList.remove("open-delete-popup");
  popupConfirm.classList.remove("open-confirm-popup");
}

function closePopup() {
  confirm.classList.remove("open-popup");
}

// const DeleteButton = document.querySelector(".button-delete");
// const popupDeletes = document.querySelectorAll(".confirm-delete-popup");
// DeleteButton.addEventListener("click", () => {
//   popupDeletes.forEach((popupDelete) => {
//     popupDelete.classList.toggle("open-delete-popup");
//   });
//   DeleteButton.classList.toggle("open-delete-popup");
// });

// function closeDeletePopup() {
//   popupDeletes.classList.remove("open-delete-popup");
// }
const popupDeletes = document.querySelector(".confirm-delete-popup");

function confirmDelete() {
  popupDeletes.classList.toggle("open-delete-popup");
  confirm.classList.remove("open-popup");
  popupConfirm.classList.remove("open-confirm-popup");
}

function closeDeletePopup() {
  popupDeletes.classList.remove("open-delete-popup");
}

const popupConfirm = document.querySelector(".confirm-order-popup");

function confirmButton() {
  popupConfirm.classList.toggle("open-confirm-popup");
  confirm.classList.remove("open-popup");
  popupDeletes.classList.remove("open-delete-popup");
}

function closeConfirmPopup() {
  popupConfirm.classList.remove("open-confirm-popup");
}