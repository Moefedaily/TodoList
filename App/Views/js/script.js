const modalToggleBtn = document.querySelector('[data-modal-toggle="create-task-modal"]');

const modalCloseBtn = document.querySelector('[data-modal-target="create-task-modal"]');

const modal = document.getElementById('create-task-modal');

modalToggleBtn.addEventListener('click', function() {
  modal.classList.remove('hidden');
});

modalCloseBtn.addEventListener('click', function() {
  modal.classList.add('hidden');
});


const modalToggleBtns = document.querySelectorAll('[data-modal-toggle="edit-task-modal"]');

const modalCloseBtns = document.querySelectorAll('[data-modal-target="edit-task-modal"]');

modalToggleBtns.forEach(function (btn) {
  btn.addEventListener('click', function () {
    const modalId = this.dataset.modalTarget;
    const modal = document.querySelector(`#${modalId}`);
    modal.classList.remove('hidden');
  });
});

modalCloseBtns.forEach(function (btn) {
  btn.addEventListener('click', function () {
    const modalId = this.dataset.modalTarget;
    const modal = document.querySelector(`#${modalId}`);
    modal.classList.add('hidden');
  });
});