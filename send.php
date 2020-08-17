<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$email = $_POST['email'];

// Проверка заполненности полей
if(empty($email)){
    // Формирование самого письма
$title = "Новый комментарий";
$body = "
<h2>Новый комментарий</h2>
<b>Комментарий:</b> $message<br>
";
// Отображение результата
header('Location: comment.html');
} else {   
// Формирование самого письма
$title = "Новое обращение Magazine";
$body = "
<h2>Новое обращение</h2>
<b>Почта:</b> $email<br>
";
// Отображение результата
header('Location: subscribe.html');
};

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
    $mail->Username   = 'filonov.temp@gmail.com'; // Логин на почте
    $mail->Password   = 'KT6Crcr7Jm4FEmn'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('filonov.temp@gmail.com', 'Сергей Филонов'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('filonov-temp@rambler.ru'); // Ещё один, если нужен ->

// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}


