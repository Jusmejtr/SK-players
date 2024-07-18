<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';

if(isset($_POST['odosli'])){
  $meno = $_POST['meno'];
  $vyber = $_POST['vyber'];
  $sprava = $_POST['sprava'];

  try{
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'insert your email'; // Gmail adresa, ktorú chcem ako SMTP server
    $mail->Password = 'insert your password'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = '587';

    $mail->setFrom('insert your email'); // Gmail adresa, ktorú som použil ako SMTP server
    $mail->addAddress('insert your email'); // Email na ktorý chcem posielať email

    $mail->isHTML(true);
    $mail->Subject = 'Nova sprava - SK players';
    $mail->Body = "<h3>Meno : $meno <br>Výber: $vyber <br>Správa : $sprava</h3>";

    $mail->send();
    $alert = '<div class="alert-success">
                 <span>Správa bola odoslaná.</span>
                </div>';
  } catch (Exception $e){
     $alert = '<div class="alert-error">
                 <span>Správu sa nepodarilo odoslať. :(</span>
               </div>';
  }
}
?>
