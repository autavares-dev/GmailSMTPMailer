<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

# Assuming PHPMailer folder is in the same folder as this file
require(dirname(__FILE__) . '/PHPMailer/src/Exception.php');
require(dirname(__FILE__) . '/PHPMailer/src/PHPMailer.php');
require(dirname(__FILE__) . '/PHPMailer/src/SMTP.php');

/**
 * Returns a PHPMailer instance configured to send e-mails using Gmail`s SMTP.
 *
 * You should configure the e-mail message (body) and any other parameters
 * of the returned PHPMailer before sending.
 *
 * @param string $gmail_user: Gmail account used to send the e-mails.
 * @param string $gmail_app_password: Application password created for the
 * Gmail account given in $gmail_user.
 * @param string $to_email Destination e-mail address.
 * @param string $subject Optional. E-mail subject. Default ''.
 * @param string $from_email Optional. Sender e-mail address, must be equal
 * to $gmail_user or another e-mail alias defined in this Google account.
 * Default null (uses $gmail_user).
 * @param string $from_name Optional. Senders display name. Default ''.
 * @param bool $debug Optional. Shows or not SMTP debug messages.
 * Default false. Use false for production code.
 * @param string $host Optional. SMTP host server. Default 'smtp.gmail.com'.
 * @param int $port Optional. SMTP port. Default 465.
 * @param string $smtp_secure Optional. Encryption to be used int the SMTP.
 * Default PHPMailer::ENCRYPTION_SMTPS.
 *
 * @return PHPMailer
 */
function create_gmail_smtp_mailer(
    $gmail_user,
    $gmail_app_password,
    $to_email,
    $subject = '',
    $from_email = null,
    $from_name = '',
    $debug = false,
    $host = 'smtp.gmail.com',
    $port = 465,
    $smtp_secure = PHPMailer::ENCRYPTION_SMTPS
)
{
    // Creates a new SMTP PHPMailer instance
    $mailer = new PHPMailer();
    $mailer->isSMTP();
    $mailer->SMTPDebug = $debug ? SMTP::DEBUG_SERVER : SMTP::DEBUG_OFF;

    // Gmail SMTP configuration and authentication using APP password
    $mailer->Host = $host;
    $mailer->Port = $port;
    $mailer->SMTPSecure = $smtp_secure;
    $mailer->SMTPAuth = true;
    $mailer->Username = $gmail_user;
    $mailer->Password = $gmail_app_password;

    // Source and destination address
    $mailer->setFrom($from_email ? $from_email : $gmail_user, $from_name);
    $mailer->addReplyTo($to_email);
    $mailer->addAddress($to_email);

    $mailer->Subject = $subject;

    return $mailer;
}
