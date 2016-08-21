<?php 
	require 'mail.php';

/*
	function sendmail($to, $subject, $message, $headers) {
		mail($to,$subject,$message,$headers);
		//mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
		echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
		// You can also use header('Location: thank_you.php'); to redirect to another page.		
	}
*/

    function createCSV($arr) {
        $fp = fopen('file.csv', 'w');
  	    fputcsv($fp, array_keys($arr));
		fputcsv($fp, array_values($arr));
        fclose($fp);
	}


	function array_2_csv($array) {
		$csv = array();
		foreach ($array as $item) {
			if (is_array($item)) {
				$csv[] = array_2_csv($item);
			} else {
				$csv[] = $item;
			}
		}
		return implode(';', $csv);
	} 

$csv_data = array_2_csv($array);


?>

<!DOCTYPE html>
<head>
<title>Form submission</title>
</head>
<body>

<form action="" method="post">
First Name: <input type="text" name="first_name"><br>
Last Name: <input type="text" name="last_name"><br>
Email: <input type="text" name="email"><br>
Message:<br><textarea rows="5" name="message" cols="30"></textarea><br>
<input type="submit" name="submit" value="Submit">
</form>

<?php

	if(isset($_POST['submit'])){
		$to = "wisam.almarany@gmail.com"; // this is your Email address
		$from = $_POST['email']; // this is the sender's Email address
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$subject = "Form submission";
		$subject2 = "Copy of your form submission";
		$message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
		$message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

		$headers = "From:" . $from;
		$headers2 = "From:" . $to;
		//sendmail($to, $subject, $message, $headers);
        foreach($_POST as $key => $value) {
            echo sprintf("%s => %s <br>", $key, $value);
        }		
		$arr = $_POST;
		unset($arr['submit']);
		sendmail(array_2_csv($arr));
		//createCSV($arr);
    }
?>
	
	
</body>
</html> 


