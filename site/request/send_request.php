<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

class Entry{
	public $teacher = "";
	public $start = -1;
	public $equipment = [];
    public $date = "";
	
	public function __contruct($NAME, $PERIOD, $EQUIPARRAY, $DATE){
		$this->teacher = $NAME;
		$this->start = $PERIOD;
		$this->equipment = $EQUIPARRAY;
        $this->date = $DATE;
	}

    public function printtofile($value) {
        $FILEW = fopen("schedule.txt", "w") or die("Failed to write to file");
        fwrite($FILEW, $value.value);
        fwrite($FILEW, "\n");

        fwrite($FILEW, $this->date);
        fwrite($FILEW, "\n");

        fwrite($FILEW, $this->start);
        fwrite($FILEW, "\n");

        fwrite($FILEW, $this->teacher);
        fwrite($FILEW, "\n");

        fclose($FILEW);
    }
//TODO: FINISH process
    public function Process() {
        foreach ($this->equipment as $value) {
            if ($value.name == "room") {
                continue;
            }

            $FILER = fopen("schedule.txt", "r") or die("Failed to read file");

            while(true) {
                $piece = fgetc($FILER);
                if ($piece == feof($FILER)) {
                    fclose($FILER);
                    $this->printtofile($value);
                }
            }

            if ($FILER) {
                fclose($FILER);
            }
        }
    }
}
/*
AJAX inputs
name: name,
date: date,
email: email,
message: message,
password: password,
equipment: equipment,
start: start,
*/
$name = $_REQUEST['name'];
$date = $_REQUEST['date'];
$email = $_REQUEST['email'];
$message = $_REQUEST['message'];
$password = $_REQUEST['password'];
$room = $_REQUEST['equipment'][0].value;
$equipment = $_REQUEST['equipment'];
$period = $_REQUEST['start'];


// Check for empty fields
if(empty($name)  		||
    empty($email) 		||
    empty($date) 		||
	empty($period) 	||
    empty($equipment) ||
    empty($password))
  {
	echo "Args missing!";
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
	print "Incorrect Password";
	return false;
}

$curFileR = fopen("schedule.txt", "r") or die("Unable to open file!");
$curFileW = fopen("schedule.txt", "w") or die("Unable to open file!");

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


$to      = 'nithin.ch10@gmail.com';
$subject = 'LibraryAppointment';
$message = "Someone reserved equipment at West High:\n\n\nName: $name \n\nEmail: $email \n\nDate: $date \n\nMessage: $message ";
$headers = "From: $email" . "\r\n" .
  "Reply-To: $email" . "\r\n";

mail($to, $subject, $message, $headers);
return true;
?>
