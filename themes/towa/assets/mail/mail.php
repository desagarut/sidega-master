<?
$name = $_POST{'name'};
$subject = $_POST{'subject'};
$email = $_POST{'email'};
$phone = $_POST{'phone'};
$message = $_POST['message'];

$email_message = "

Name: ".$name."
Subject: ".$subject."
Email: ".$email."
Phone: ".$phone."
Message: ".$message."

";

mail ("example@gmail.com" , "New Message", $email_message);
header("location: ../../mail-success.html");
?>


