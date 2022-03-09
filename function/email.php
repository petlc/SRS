<?php

class Email
{
    
    public static function send($to, $subject, $message, $cc = false)
    {
        $mail = new PHPMailer(true);

        $mail->IsSMTP();                                      // set mailer to use SMTP
        $mail->Host = "10.194.23.193";  // specify main and backup server
        //$mail->Host       = "exchange.jp.yazaki.com";   // specify main and backup server
        $mail->SMTPAuth = false;     // turn on SMTP authentication

        $mail->Username   = Config::MAILER_USERNAME;                     // SMTP username
        $mail->Password   = Config::MAILER_PASSWORD;                               // SMTP password
        //$mail->SMTPSecure = 'tls';
        $mail->Port       = 25;
        
        $mail->From = 'smb_srs.pet@ph.yazaki.com';
        $mail->FromName = '[SRS Endorsement]';

        //$mail->setFrom('smb_srs.pet@ph.yazaki.com', 'Mailer');
        $mail->addReplyTo('smb_srs.pet@ph.yazaki.com', 'Information');
        $mail->addCC('smb_srs.pet@ph.yazaki.com');
        
        if($cc != false){
            $mail->addCC($cc);
        }
        
        $mail->Priority = 1;
        
        $mail->AddAddress($to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        
        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }
}

?>