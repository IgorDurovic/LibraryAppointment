<?php

class Entry{
	public $teacher = "";
	public $start = -1;
	public $end = -1;
	public $duration = -1;
}
/*
INPUTS from ajax
name: name,
date: date,
email: email,
message: message
password: password
*/
$name = $_POST['name'];
$date = $_POST['date']
$email = $_POST['email'];
$message = $_POST['message'];
$password = $_POST['password'];


// Check for empty fields
if(empty($name)  		||
   empty($email) 		||
   empty($date) 		||
   empty($password]))
  {
	echo "No arguments Provided!";
	return false;
  }

//split the email to see if it is a slcschools.org email
$email_domain = explode("@", $email)[1];
if ($email_domain !== "slcschools.org") {
	echo "Invalid email, must be @slcschools.org";
	return false;
}

//password check
if($password !== "PANTHERS"){
	echo "Incorrect Password";
	return false;
}

$curFileR = fopen("schedule.txt", "r") or die("Unable to open file!");
$curFileW = fopen("schedule.txt", "w") or die("Unable to open file!");

$validEmails = fopen("valid-mails.txt", "r") or die("Unable to open file");

while(true){
	$emailFormated = trim($email);
	$temp = trim(fget($validEmails));
	if(temp == $emailFormated){
		break;
	}
	else if(feof($validEmails)){
		echo "Invalid email";
		return false;
	}
}

$to      = 'nithin.ch10@gmail.com';
$subject = 'LibraryAppointment';
$message = "Someone reserved equipment at West High:\n\n\nName: $name \n\nEmail: $email \n\nDate: $date \n\nMessage: $message ";
$headers = "From: $email" . "\r\n" .
  "Reply-To: $email" . "\r\n";

mail($to, $subject, $message, $headers);
return true;
?>
