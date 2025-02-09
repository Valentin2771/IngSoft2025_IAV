<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mailError = $mailSuccess = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once __DIR__."/helper.php";

    $name = sanitize($_POST["name"]);
    $email = sanitize($_POST["email"]);
    $subject = sanitize($_POST["subject"]);
    $content = $_POST["content"];

    require "vendor/autoload.php";

    $mail = new PHPMailer(true);

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = ""; // the smtp server, like smtp.gmail.com
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = ""; // The user login for the smtp server like 'john.doe12356@gmail.com'
    $mail->Password = ""; // The 16-character app password provided by Gmail, once the Two-Steps authentication is set

    $mail->setFrom($email, $name); 
    // setting the first parameter will not work, due to DKIM https://en.wikipedia.org/wiki/DomainKeys_Identified_Mail
    // In other words: Gmail rewrites setFrom addresses for security reasons, e.g. avoid mail spoofing etc

    /* 
    $mail->From = $email;
    $mail->FromName = $name;
    $mail->Body = $message;
    // We still can't prevent Gmail from rewriting the address provided by user 
    */

    $mail->Subject = $subject;
    $stringToBody = "Hey, the unregistered user '" . $name . "', having " . $email . " as mail address, has sent you the following message:<div>". $content . "<div>";
    $mail->addAddress("valentin.iclozan27@gmail.com", "Blue Jack"); // This is where to receive emails
    $mail->Body = $stringToBody;
    $mail->isHTML(true); // Message can contain html code

    try{
        $mail->send();
        header("location: index.php"); // Redirect user to the landing page on sending successfully
    } catch(Exception $e){
        $mailError = "Message not sent"; // Show an error message if message not sent
    }
}
