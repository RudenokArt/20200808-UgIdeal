<?php
/**
 * Отправка почты через PHP (SMTP)
 * Сделано в Live-code.ru
 * Автор: Mowshon
 * Дата: 11.11.11
 */




// Подключаем SMTP класс для работы с почтой
include_once('km_smtp_class.php');

// Конфигурационный массив
$SenderConfig = array(
  "SMTP_server"   =>  "smtp.yandex.ru",
  "SMTP_port"     =>  "465",
  "SMTP_email"    =>  "zakazugideal@yandex.ru",
  "SMTP_pass"     =>  "Patvakanlala197307",
  "SMTP_type"     =>  "ssl"
);

// Email получателя/Получателей
//$Receiver = "rudenokart@yandex.ru";
$Receiver = trim(file_get_contents('../../modular/profile/admin-mail.txt'));
// Тема сообщения
$Subject = "Фотообои. Онлай заявка";

// Текст сообщения (в HTML)
// $Text = "Привет!<br />
// Сообщение отправлено из скрипта <strong>Mowshon</strong><br />
// Сайт: http://live-code.ru";

$Text = "Заказ в приложенном файле";

// Вложение в письме - адрес к файлу
$Attachment = '../user_download/order.jpg';

/* $mail = new KM_Mailer(сервер, порт, пользователь, пароль, тип); */
/* Тип может быть: null, tls или ssl */
$mail = new KM_Mailer($SenderConfig['SMTP_server'], $SenderConfig['SMTP_port'], $SenderConfig['SMTP_email'], $SenderConfig['SMTP_pass'], $SenderConfig['SMTP_type']);
if($mail->isLogin) {
    // Прикрепить файл
  if($Attachment) {$mail->addAttachment($Attachment);}

    // Добавить ещё получателей
  $mail->addRecipient($_GET['order_send']);
    // $mail->addRecipient('user@yandex.ru');

  /* $mail->send(От, Для, Тема, Текст, Заголовок = опционально) */
  $SendMail = $mail->send($SenderConfig['SMTP_email'], $Receiver, $Subject, $Text);

    // Очищаем список получателей
  $mail->clearRecipients();
  $mail->clearCC();
  $mail->clearBCC();
  $mail->clearAttachments();

  ?>
  <div style="display: flex">
    <div style="margin:auto">
      <h3>
        Ваш заказ отправлен адмнистратору!
      </h3>
    </div>
  </div>
  <?php 
  echo '<meta http-equiv="refresh" content="2; url=../index.php" />';
}
else {
  echo "Возникла ошибка во время подключения к SMTP-серверу<br />";
}
?>

