<?php

class Entry{
	public $teacher = "";
	public $start = -1;
	public $end = -1;
	public $duration = -1;
}

// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['date']) 		||
   empty($_POST['start'])		||
   empty($_POST['password']))	||
   empty()
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }

$password = $_POST['start'];
if($password == "PANTHERS"){
	echo "Incorrect Password";
	return false;
}

$curFileR = fopen("schedule.txt", "r") or die("Unable to open file!");
$curFileW = fopen("schedule.txt", "w") or die("Unable to open file!");


	
$name = $_POST['name'];
$email_address = $_POST['email'];

$validEmails = fopen("valid-mails.txt", "r") or die("Unable to open file");

while(true){
	$temp = fget($validEmails);
	if(temp == $email_address){
		break;
	}
	else if(feof($validEmails)){
		echo "Invalid email";
		return false;
	}
}

$date = $_POST['date'];
$message = $_POST['message'];
$to = 'id.tesla@gmail.com';
$secondEmail = 'nithin.ch10@gmail.com';

$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\ndate: $date\n\nMessage:\n$message";
$headers = "From: $email_address\n";
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
mail($secondEmail,$email_subject,$email_body,$headers);
return true;			
?>
