<!DOCTYPE html>
<head>
<title>Form submission</title>
</head>
<body>

<form action="" method="post">
First Name: <input type="text" name="first_name"><br>
Last Name: <input type="text" name="last_name"><br>
Email: <input type="text" name="email"><br>
Info:<br><textarea rows="5" name="message" cols="30"></textarea><br>
Gender: <select name="gender">
  <option value="male">M</option> 
  <option value="female" selected>F</option>
  </select><br>
<input type="submit" name="submit" value="Submit">
</form>

<?php
	require 'mail.php';


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


	if(isset($_POST['submit'])){
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
		
		
		// Send the email
		sendmail(array_2_csv($arr), 'wisam.almarany@gmail.com', 'Wisam Almarany');
    }
?>
	
	
</body>
</html> 


