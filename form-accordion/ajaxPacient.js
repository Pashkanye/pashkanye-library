"use strict"

document.addEventListener('DOMContentLoaded', function () {
  const pacientForm = document.getElementById('pacient-form');
  pacientForm.addEventListener('submit', formSend2);
  const popup = document.getElementById('popup');

  async function formSend2(e) {
    e.preventDefault();

    let error = formValidate(pacientForm);

    let formData2 = new FormData(pacientForm);

    if (error === 0) {
      pacientForm.classList.add('_sending');
      let response = await fetch('pacientSendMail.php', {
        method: 'POST',
        body: formData2
      });
      if (response.ok) {
        let result = await response.json();
        pacientForm.classList.remove('_sending');
        popup.classList.add('_block');
        pacientForm.reset();
        alert(result.message);
        // formPreview.innerHTML = '';

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
    let formReq2 = document.querySelectorAll('._req2');

    for (let index = 0; index < formReq2.length; index++) {
      const input = formReq2[index];
      formRemoveError(input);

      if (input.classList.contains('_email2')) {
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