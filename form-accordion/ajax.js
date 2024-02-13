"use strict"

document.addEventListener('DOMContentLoaded', function () {
  const pacientForm = document.getElementById('pacient-form');
  const config = {
    method: 'POST',
    body: formData
  }
  pacientForm.addEventListener('submit', formSend);

  async function formSend(e) {
    e.preventDefault();

    let error = formValidate(pacientForm);

    let formData = new FormData(pacientForm);

    if (error === 0) {
      pacientForm.classList.add('_sending');
      let response = await fetch('pacientSendMail.php', config);
      if (response.ok) {
        let result = await response.json();
        alert(result.message);
        formPreview.innerHTML = '';
        pacientForm.reset();
        pacientForm.classList.remove('_sending');
      } else {
        alert("Ошибка JS" + response.status);
        pacientForm.classList.remove('_sending');
      }
    } else {
      alert('Заполните обязательные поля')
    }

  }


  function formValidate(pacientForm) {
    let error = 0;
    let formReq = document.querySelectorAll('._req');

    for (let index = 0; index < formReq.length; index++) {
      const input = formReq[index];
      formRemoveError(input);

      if (input.classList.contains('_email')) {
        if (emailTest(input)) {
          formAddError(input);
          error++;
        }
      } else if (input.getAttribute("type") === "checkbox" && input.checked === false) {
        formAddError(input);
        error++;
      } else {
        if (input.value === '') {
          formAddError(input);
          error++;
        }
      }

    }
    return error;
  }

  function formAddError(input) {
    input.parentElement.classList.add('_error');
    input.classList.add('_error');
  }

  function formRemoveError(input) {
    input.parentElement.classList.remove('_error');
    input.classList.remove('_error');
  }
  // Функция теста e-mail
  function emailTest(input) {
    return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(input.value);
  }

});