<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

class Entry{
	public $teacher = "";
	public $start = -1;
	public $end = -1;
	public $duration = -1;
}
/*
name: name,
date: date,
email: email,
message: message
password: password
room: room,
equipment: equipment;
*/
$name = $_REQUEST['name'];
$date = $_REQUEST['date'];
$email = $_REQUEST['email'];
$message = $_REQUEST['message'];
$password = $_REQUEST['password'];
$room = $_REQUEST['room'];
$equipment = $_REQUEST['equipment'];


// Check for empty fields
if(empty($name)  		||
   empty($email) 		||
   empty($date) 		||
   empty($password))
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
// if($password !== "PANTHERS"){
// 	echo "Incorrect Password";
// 	return false;
// }

$curFileR = fopen("schedule.txt", "r") or die("Unable to open file!");
$curFileW = fopen("./../schedule.txt", "w") or die("Unable to open file!");

// $validEmails = fopen("valid-mails.txt", "r") or die("Unable to open file");

// while(true){
// 	$emailFormated = trim($email);
// 	$temp = trim(fget($validEmails));
// 	if(temp == $emailFormated){
// 		break;
// 	}
// 	else if(feof($validEmails)){
// 		echo "Invalid email";
// 		return false;
// 	}
// }

fwrite($curFileW, $room);
fwrite($curFileW, "\n\n\n\n\n\n");
fwrite($curFileW, $equipment);
//
// $to      = 'nithin.ch10@gmail.com';
// $subject = 'LibraryAppointment';
// $message = "Someone reserved equipment at West High:\n\n\nName: $name \n\nEmail: $email \n\nDate: $date \n\nMessage: $message ";
// $headers = "From: $email" . "\r\n" .
//   "Reply-To: $email" . "\r\n";
//
// mail($to, $subject, $message, $headers);
return true;
?>
