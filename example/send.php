<?php

require(dirname(__FILE__) . '/../GmailSMTPMailer/GmailSMTPMailer.php');

function send($to)
{
    $mailer = create_gmail_smtp_mailer(
        gmail_user: 'YOUR_GMAIL_ADDRESS_HERE',
        gmail_app_password: 'YOUR_APP_PASSWORD_HERE',
        from_name: 'GmailSMTPMailer',
        subject: 'GmailSMTPMailer test',
        to_email: $to,
    );

    $mailer->msgHTML(file_get_contents(dirname(__FILE__) . '/message.html'));
    $mailer->AddEmbeddedImage(dirname(__FILE__) . '/image.png', 'image');

    $error = '';
    if (!$mailer->send())
    {
        $error = $mailer->ErrorInfo;
    }
    return $error;
}
