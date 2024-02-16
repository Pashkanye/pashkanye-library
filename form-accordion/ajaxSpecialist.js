"use strict"

document.addEventListener('DOMContentLoaded', function () {
  const specialistForm = document.getElementById('spec-form');
  specialistForm.addEventListener('submit', formSend1);
  const popup = document.getElementById('popup');

  async function formSend1(e) {
    e.preventDefault();

    let error = formValidate(specialistForm);

    let formData1 = new FormData(specialistForm);

    if (error === 0) {
      specialistForm.classList.add('_sending');
      let response = await fetch('specialistSendMail.php', {
        method: 'POST',
        body: formData1
      });
      if (response.ok) {
        let result = await response.json();
        specialistForm.classList.remove('_sending');
        popup.classList.add('_block');
        specialistForm.reset();
        alert(result.message);
        // formPreview.innerHTML = '';

      } else {
        alert("Ошибка JS" + response.status);
        specialistForm.classList.remove('_sending');
      }
    } else {
      alert('Заполните обязательные поля')
    }

  }


  function formValidate(specialistForm) {
    let error = 0;
    let formReq1 = document.querySelectorAll('._req1');

    for (let index = 0; index < formReq1.length; index++) {
      const input = formReq1[index];
      formRemoveError(input);

      if (input.classList.contains('_email1')) {
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