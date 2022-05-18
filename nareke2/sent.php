<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$name = $_POST['user_name'];
$tel = $_POST['user_tel'];
$date1 = $_POST['user_date1'];
$date2 = $_POST['user_date2'];



// Формирование самого письма
$title = "Новая заявка с сайта";
$body = "
<h2>Клиент</h2>
<b>Имя:</b> $name<br>
<b>Телефон:</b> $tel<br>
<b>Желаемая дата заезда:</b> $date1<br> 
<b>Желаемая дата выезда:</b> $date2";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'na.reke@mail.ru'; // Логин на почте
    $mail->Password   = 'Vpnh6ckDU5TLBk7TgFMZ'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('na.reke@mail.ru', 'НА РЕКЕ'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('klekov23@yandex.ru');  
   

   
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
