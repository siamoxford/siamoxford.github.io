<?php $name = $_POST['senderemail'];
$email = $_POST['senderemail'];
$message = $_POST['message'];
$formcontent="From: $name \n Message: $message";
$recipient = "siamsc@maths.ox.ac.uk";
$subject = "Contact Form";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
?>
