<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'PHPMailer/language/');
$mail->IsHtml(true);

$mail->isSMTP();
$mail->SMTPAuth   = true;
//$mail->SMTPDebug = 2;

// От кого
// Настройки вашей почты
$mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
$mail->Username   = 'b2b@girlanda.by'; // Логин на почте
$mail->Password   = 'vwexnlblbujasvbb'; // Пароль на почте
$mail->SMTPSecure = 'SSL';
$mail->Port       = 465;
$mail->setFrom('b2b@girlanda.by', 'Ваня Директор'); // Адрес самой почты и имя отправителя
// Кому
$mail->addAddress('pash.pahs@gmail.com');
// Тема письма
$mail->Subject = 'Тема письма - тест';

// Тело письма
$body = '<h1>Заявление пациента о нежелательной реакции</h1>';

if (trim(!empty($_POST['pacient-name']))) {
  $body .= '<p><strong>Имя:</strong> ' . $_POST['pacient-name'] . '</p>';
}
if (trim(!empty($_POST['pacient-mail']))) {
  $body .= '<p><strong>E-mail:</strong> ' . $_POST['pacient-mail'] . '</p>';
}
if (trim(!empty($_POST['pacient-phone']))) {
  $body .= '<p><strong>Телефон:</strong> ' . $_POST['pacient-phone'] . '</p>';
}
if (trim(!empty($_POST['pacient-status']))) {
  $body .= '<p><strong>Кем является:</strong> ' . $_POST['pacient-status'] . '</p>';
}
if (trim(!empty($_POST['pacient-country']))) {
  $body .= '<p><strong>Страна:</strong> ' . $_POST['pacient-country'] . '</p>';
}
if (trim(!empty($_POST['pacient-region']))) {
  $body .= '<p><strong>Регион, область:</strong> ' . $_POST['pacient-region'] . '</p>';
}
if (trim(!empty($_POST['pacient-city']))) {
  $body .= '<p><strong>Населенный пункт</strong> ' . $_POST['pacient-city'] . '</p>';
}
if (trim(!empty($_POST['pacient-unwanted-reaction-descr']))) {
  $body .= '<p><strong>Описание НР:</strong> ' . $_POST['pacient-unwanted-reaction-descr'] . '</p>';
}

$mail->Body = $body;

if (!$mail->send()) {
  $message = 'Ошибка PHP';
} else {
  $message = 'Данные отправлены!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
