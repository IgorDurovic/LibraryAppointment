<?php

class Entry{
	public $teacher = "";
	public $start = -1;
	public $equipment = [];
    public $date = "";
    public $email ="";
    public $errs = "";


	public function __construct($NAME, $PERIOD, $EQ, $DATE, $EMAIL){
		$this->teacher = $NAME;
		$this->start = $PERIOD;
		$this->equipment = $EQ;
        $this->date = $DATE;
        $this->email = $EMAIL;
        $this->errs;
	}


    public function printtofile($value) {
        $FILEW = fopen("s./../statictxt/chedule.txt", "w");

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


    public function Process() {
        foreach ($this->equipment as $value) {
            if ($value['name'] == "room") {
                continue;
            }

            $FILER = fopen("./../statictxt/schedule.txt", "r");

            while(true) {
                $eq = fgets($FILER);
                if ($eq == feof($FILER)) {
                    fclose($FILER);
                    $this->printtofile($value);
                    $this->errs .= "Requested item $eq booked on $this->date for $this->start period.\n";
                }

                $eq = trim($eq);
                $d = trim(fgets($FILER));
                $p = trim(fgets($FILER));
                $t = trim(fgets($FILER));

                if ($value['value'] == $eq &&
                    $this->date == $d &&
                    $this->start == $p) {
                    $this->errs .= "Requested item $eq is already booked on $d for $p period. $eq was not booked\n";
                    break;
                }

            }

            if ($FILER) {
                fclose($FILER);
            }
        }

        return true;
    }

    public function email() {
        //emails the librarian
        $to      = 'nithin.ch10@gmail.com';
        $subject = 'LibraryAppointment';
        $room = $this->equipment[0]['value'];
        $message = "Someone reserved equipment at West High:\n\n\nName: $this->teacher \n\nEmail: $this->email\n\nDate: $this->date \n\nRoom: $room\n\nEquipment:\n";
        foreach ($this->equipment as $value) {
            if ($value['name'] == 'room') {
                continue;
            }
            $tmp = $value['value'];
            $message .= "$tmp\n";
        }
        mail($to, $subject, $message);
    }

    public function __destruct()
    {
        unset($this);
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
$password = $_REQUEST['password'];
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
	echo "There were empty fields!";
	return false;
  }

//split the email to see if it is a slcschools.org email
$email_domain = explode("@", $email)[1];
if ($email_domain !== "slcschools.org") {
	echo "Invalid email, must be @slcschools.org";
	return false;
}


//Checks if the inputed email is valid
$validEmails = fopen("./../statictxt/Vaildemails.txt", "r");
while(true){
    $emailFormated = trim($email);
    $temp = trim(fgets($validEmails));
    if($temp == $emailFormated){
        break;
    }
    else if(feof($validEmails)){
        echo "Unrecognized email - Contact the librarian";
        return false;
    }
}


//password check
if($password !== "PANTHERS"){
	print "Incorrect Password";
	return false;
}

//Make new entry
$currTeacher = new Entry($name, $period, $equipment, $date, $email);
//Write to file and process the request
$currTeacher->Process();
//email the librarian
$currTeacher->email();

echo $currTeacher->errs;
echo"\n\n";
echo "Order Processed.";
$currTeacher->__destruct();
return true;


?>
