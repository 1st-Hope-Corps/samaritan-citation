<?php
require 'vendor/autoload.php';
require 'sites/default/mail_config.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// sendCustomMailer('aarontolentino123@gmail.com', 'SamCit Notification', 'Someone saw your good deed!');

function sendCustomMailer($recipient, $subject, $content, $content_title = '', $replyTo = ''){
    global $mail_settings;

    //Load Composer's autoloader
    // var_dump($_SERVER['MAIL_HOST']);exit;
    //Create an instance; passing `true` enables exceptions
    $content = getMailContent($content, $content_title);
    // echo $content;
    // exit;
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $mail_settings['host'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $mail_settings['username'];                     //SMTP username
        $mail->Password   = $mail_settings['password'];                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = $mail_settings['port'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('support@samaritancitation.com', 'Samaritan Citation Support');
        $mail->addAddress($recipient);     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional

        if (!empty($replyTo)) {
            $mail->addReplyTo($replyTo);
        }else{
            $mail->addReplyTo('info@ainmind.com', 'Information');
        }
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        return $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        // TODO: Log here:
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function getMailContent($content, $content_title)
{
    $data = [
        'title' => $content_title,
        'content' => $content
    ];
    ob_start();
    $var = require('./mail_notification_template.php');
    $str = ob_get_contents();
    ob_end_clean();

    return $str;
}
