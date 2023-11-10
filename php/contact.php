<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the form fields and remove whitespace.
    $message      = strip_tags(trim($_POST["message"]));
    $name         = strip_tags(trim($_POST["name"]));
    $typeProject  = strip_tags(trim($_POST["typeProject"]));
    $contactType  = strip_tags(trim($_POST["contactType"]));
    $contactField = strip_tags(trim($_POST["contactField"]));
    $agree        = strip_tags(trim($_POST["agree"]));

    if ($contactType == 'email') {
        if (!filter_var($contactField, FILTER_VALIDATE_EMAIL)) {
            http_response_code(200);
            echo "Email is not correct";
            exit();
        }
    }
    if (($name == '') or ($contactField == '') or ($message == '')) {
        http_response_code(200);
        echo "Not all fields are filled in";
        exit();
    }
    if ($agree == 'on') {

        $botToken = '6830693524:AAEgrQzrIe-P3bNhSXNSKely9pH8bGk9nOs';
        $chatId   = '-1002097679361';

        $telegramMessage = "Type project: $typeProject\n";
        $telegramMessage .= "Name: $name\n";
        $telegramMessage .= "contact: $contactType - $contactField\n";
        $telegramMessage .= "Message: $message";

        // Create the URL for sending the message to the Telegram bot.
        $telegramApiUrl     = "https://api.telegram.org/bot{$botToken}/sendMessage";
        $telegramParameters = [
            'chat_id' => $chatId,
            'text'    => $telegramMessage,
        ];

        // Send the message to the Telegram bot using cURL.
        $ch = curl_init($telegramApiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $telegramParameters);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $telegramResponse = curl_exec($ch);
        curl_close($ch);

        // Check if the message was sent successfully to the Telegram bot.
        if ($telegramResponse && json_decode($telegramResponse)->ok) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank you! Your message has been sent successfully. Our managers will contact you.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong, and we couldn't send your message to the Telegram bot.";
        }
    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(200);
        echo "You must agree to the terms";
        exit();
    }
}
/*
 *  CONFIGURE EVERYTHING HERE
 */

//// an email address that will be in the From field of the email.
//$from = 'contact form <demo@domain.com>';
//
//// an email address that will receive the email with the output of the form
//$sendTo = 'themeht23@gmail.com';
//
//// subject of the email
//$subject = 'New message from contact form';
//
//// form field names and their translations.
//// array variable name => Text to appear in the email
//$fields = array('name' => 'Name', 'surname' => 'Surname', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message');
//
//// message that will be displayed when everything is OK :)
//$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';
//
//// If something goes wrong, we will display this message.
//$errorMessage = 'There was an error while submitting the form. Please try again later';
//
///*
// *  LET'S DO THE SENDING
// */
//
//// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
//error_reporting(E_ALL & ~E_NOTICE);
//
//try
//{
//
//    if(count($_POST) == 0) throw new \Exception('Form is empty');
//
//    $emailText = "You have a new message from your contact form\n=============================\n";
//
//    foreach ($_POST as $key => $value) {
//        // If the field exists in the $fields array, include it in the email
//        if (isset($fields[$key])) {
//            $emailText .= "$fields[$key]: $value\n";
//        }
//    }
//
//    // All the neccessary headers for the email.
//    $headers = array('Content-Type: text/plain; charset="UTF-8";',
//        'From: ' . $from,
//        'Reply-To: ' . $from,
//        'Return-Path: ' . $from,
//    );
//
//    // Send email
//    mail($sendTo, $subject, $emailText, implode("\n", $headers));
//
//    $responseArray = array('type' => 'success', 'message' => $okMessage);
//}
//catch (\Exception $e)
//{
//    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
//}
//
//
//// if requested by AJAX request return JSON response
//if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
//    $encoded = json_encode($responseArray);
//
//    header('Content-Type: application/json');
//
//    echo $encoded;
//}
//// else just display the message
//else {
//    echo $responseArray['message'];
//}
