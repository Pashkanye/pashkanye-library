<?php
// Файлы phpmailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/PHPMailer.php';

// Переменные, которые отправляет пользователь
$specialist_name = $_POST['specialist-name'];
$specialist_job = $_POST['specialist-job'];
$specialist_email = $_POST['specialist-email'];
$specialist_phone = $_POST['specialist-phone'];
$specialist_country = $_POST['specialist-country'];
$specialist_region = $_POST['specialist-region'];
$specialist_city = $_POST['specialist-city'];
$spec_pacient_fio = $_POST['spec-pacient-fio'];
$spec_pacient_medcart_num = $_POST['spec-pacient-medcart-num'];
$spec_pacient_age = $_POST['spec-pacient-age'];
$spec_pacient_weight = $_POST['spec-pacient-weight'];
$spec_pacient_sex = $_POST['spec-pacient-sex'];
$spec_pacient_pregnancy = $_POST['spec-pacient-pregnancy'];
$spec_pacient_pregnancy_time = $_POST['spec-pacient-pregnancy-time'];
$spec_pacient_therapy = $_POST['spec-pacient-therapy'];
$spec_pacient_liver = $_POST['spec-pacient-liver'];
$spec_pacient_kidney = $_POST['spec-pacient-kidney'];
$spec_pacient_allergy = $_POST['spec-pacient-allergy'];
$spec_pacient_accompanying_illnesses = $_POST['spec-pacient-accompanying-illnesses'];
$spec_pacient_last_drugs = $_POST['spec-pacient-last-drugs'];
$spec_pacient_drug_name = $_POST['spec-pacient-drug-name'];
$spec_pacient_indication_for_use_drug = $_POST['spec-pacient-indication-for-use-drug'];
$spec_pacient_way_of_injection_drug = $_POST['spec-pacient-way-of-injection-drug'];
$spec_pacient_drug_dose = $_POST['spec-pacient-drug-dose'];
$spec_pacient_drug_exp_date = $_POST['spec-pacient-drug-exp-date'];
$spec_pacient_drug_series = $_POST['spec-pacient-drug-series'];
$spec_pacient_start_drug_use_date = $_POST['spec-pacient-start-drug-use-date'];
$spec_pacient_end_drug_use_date = $_POST['spec-pacient-end-drug-use-date'];
$spec_pacient_unwanted_reaction_desc = $_POST['spec-pacient-unwanted-reaction-desc'];
$spec_pacient_unwanted_reaction_start_date = $_POST['spec-pacient-unwanted-reaction-start-date'];
$spec_pacient_unwanted_reaction_end_date = $_POST['spec-pacient-unwanted-reaction-end-date'];
$spec_pacient_unwanted_reaction_result = $_POST['spec-pacient-unwanted-reaction-result'];


// Формирование самого письма
$title = "Заявление о НР Специалиста";
$body = "
<h2>1. Заявление о НР Специалиста</h2>

<h3>Лицо, сообщающее о НР</h3>

<strong>Имя:</strong> $specialist_name<br>
<strong>Должность:</strong> $specialist_job<br>
<strong>E-mail:</strong> $specialist_email<br>
<strong>Телефон:</strong> $specialist_phone<br>
<strong>Страна:</strong> $specialist_country<br>
<strong>Регион, область:</strong> $specialist_region<br>
<strong>Населенный пункт:</strong> $specialist_city<br><br>

<h3>2. Информация о пациенте</h3>

<strong>Инициалы:</strong> $spec_pacient_fio<br>
<strong>Номер амбулаторной карты или история болезни:</strong> $spec_pacient_medcart_num<br>
<strong>Возраст:</strong> $spec_pacient_age<br>
<strong>Вес:</strong> $spec_pacient_weight<br>
<strong>Пол:</strong> $spec_pacient_sex<br>
<strong>Беременность:</strong> $spec_pacient_pregnancy<br>
<strong>Срок беременности:</strong> $spec_pacient_pregnancy_time<br>
<strong>Лечение:</strong> $spec_pacient_therapy<br>
<strong>Нарушение функции печени:</strong> $spec_pacient_liver<br>
<strong>Нарушении функции почек:</strong> $spec_pacient_kidney<br>
<strong>Аллергия:</strong> $spec_pacient_allergy<br>
<strong>Сопутствующие заболевания:</strong> $spec_pacient_accompanying_illnesses<br>
<strong>Препараты, принимаемые в течение последних 3-х месяцев:</strong> $spec_pacient_last_drugs<br><br>

<h3>3. Информация о препарате, вызвавшем НР</h3>

<strong>Название:</strong> $spec_pacient_drug_name<br>
<strong>Показание для приёма:</strong> $spec_pacient_indication_for_use_drug<br>
<strong>Путь введения:</strong> $spec_pacient_way_of_injection_drug<br>
<strong>Доза:</strong> $spec_pacient_drug_dose<br>
<strong>Срок годности:</strong> $spec_pacient_drug_exp_date<br>
<strong>Серия:</strong> $spec_pacient_drug_series<br>
<strong>Дата начала терапии:</strong> $spec_pacient_start_drug_use_date<br>
<strong>Дата последнего приёма до НР:</strong> $spec_pacient_end_drug_use_date<br><br>

<h3>4. Описание НР</h3>

<strong>Описание НР:</strong> $spec_pacient_unwanted_reaction_desc<br>
<strong>Дата начала НР:</strong> $spec_pacient_unwanted_reaction_start_date<br>
<strong>Дата окончания НР:</strong> $spec_pacient_unwanted_reaction_end_date<br>
<strong>Исход НР:</strong> $spec_pacient_unwanted_reaction_result<br><br>
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
  $mail->isSMTP();
  $mail->CharSet = "UTF-8";
  $mail->SMTPAuth   = true;
  //$mail->SMTPDebug = 2;
  $mail->Debugoutput = function ($str, $level) {
    $GLOBALS['status'][] = $str;
  };

  // Настройки вашей почты
  $mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
  $mail->Username   = 'b2b@girlanda.by'; // Логин на почте
  $mail->Password   = 'vwexnlblbujasvbb'; // Пароль на почте
  $mail->SMTPSecure = 'TLS';
  $mail->Port       = 25;
  $mail->setFrom('b2b@girlanda.by', 'Ваня Директор'); // Адрес самой почты и имя отправителя

  // Получатель письма
  $mail->addAddress('ivan.yakubovich@gmail.com');

  // Прикрипление файлов к письму
  if (!empty($file['name'][0])) {
    for ($ct = 0; $ct < count($file['tmp_name']); $ct++) {
      $uploadfile = tempnam(sys_get_temp_dir(), sha1($file['name'][$ct]));
      $filename = $file['name'][$ct];
      if (move_uploaded_file($file['tmp_name'][$ct], $uploadfile)) {
        $mail->addAttachment($uploadfile, $filename);
        $rfile[] = "Файл $filename прикреплён";
      } else {
        $rfile[] = "Не удалось прикрепить файл $filename";
      }
    }
  }
  // Отправка сообщения
  $mail->isHTML(true);
  $mail->Subject = $title;
  $mail->Body = $body;

  // Проверяем отравленность сообщения
  if ($mail->send()) {
    $result = "success";
  } else {
    $result = "error";
  }
} catch (Exception $e) {
  $result = "error";
  $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status, "message" => "Сообщение успешно отправлено."]);
