<?PHP
require('class.authImage.php');
$ai = new authImage();
$message = sprintf("KONTAKT: \n\n");
$message .= sprintf("Imiê i nazwisko (firma): $nazwa\n");
$message .= sprintf("Adres e-mail: $email\n");
$message .= sprintf("Temat: $temat\n");
$message .= sprintf("TRESC:\n");
$message .= sprintf("$tresc");
$moj_mail = "kuznia@kurek.pl";
if (!$ai->validateAuthCode($_POST[auth_code])) die("Bledny kod. Wiadomosc nie zostala wyslana");
mail("$moj_mail", "$temat", $message, "From: $nazwa");
echo "<html><head><META Http-equiv=\"refresh\" Content=\"0;Url=http://www.kurek.pl/index.php?url=zgloszenie.php\"></head>";
?>

