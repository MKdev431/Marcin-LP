<?php
   
   $message_sent = false;
    if(isset($_POST['email']) && $_POST['email'] != '') {
        
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $userName = $_POST['name'];
            $userEmail = $_POST['email'];
            $userPhone = $_POST['phone'];
            $messageSubject = $_POST['subject'];
            $message = $_POST['message'];

            $to = 'freestyle.431@hotmail.com';
            $body = "";

            $body .= "From: ".$userName. "\r\n";
            $body .= "Email: ".$userEmail. "\r\n";
            $body .= "Phone: ".$userPhone. "\r\n";
            $body .= "Message: ".$message. "\r\n";


            mail($to, $messageSubject, $body);

            $message_sent = true;
            print('Twoja wiadomość została wysłana. Dziękujemy!');
        } else {
            print('Niestety nie udało się wysłać wiadomości. Sprawdź dane i spróbuj ponownie.');
        }
    }
?>