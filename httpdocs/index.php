<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Form submission</title>
<link rel="stylesheet" href="css/font-awesome-4.6.3/css/font-awesome.min.css">
<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
 <div class="info"></div>

  
  
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <h1>If you have any questions, please contact us at: mandaeanc@mandaeancensus.org</h1>
        
    <div class="contentform">
        <div id="sendmessage"> Your message has been sent successfully. Thank you. </div>


        <div class="leftcontact">
                  <div class="form-group">
                    <p>First name<span>*</span></p>
                    <span class="icon-case"><i class="fa fa-male"></i></span>
                        <input type="text" name="first_name" id="first_name" required/>
                <div class="validation"></div>
       </div> 

            <div class="form-group">
            <p>Family name <span>*</span></p>
            <span class="icon-case"><i class="fa fa-user"></i></span>
                <input type="text" name="Family_name" id="Family name" required/>
                <div class="validation"></div>
            </div>

            <div class="form-group">
            <p>E-mail <span>*</span></p>    
            <span class="icon-case"><i class="fa fa-envelope-o"></i></span>
                <input type="email" name="email" id="email" required />
                <div class="validation"></div>
            </div>    

            <div class="form-group">
            <p>Street <span>*</span></p>
            <span class="icon-case"><i class="fa fa-home"></i></span>
                <input type="text" name="Street" id="Street"  required/>
                <div class="validation"></div>
            </div>

            <div class="form-group">
            <p>Nr <span>*</span></p>
            <span class="icon-case"><i class="fa fa-location-arrow"></i></span>
                <input type="text" name="Nr" id="Nr"  required/>
                <div class="validation"></div>
            </div>

            <div class="form-group">
            <p>Postcode <span>*</span></p>
            <span class="icon-case"><i class="fa fa-map-marker"></i></span>
                <input type="text" name="postal" id="postal" required />
                <div class="validation"></div>                
            </div>    
             
             <div class="form-group">
             <p>Date of Birth <span>*</span></p>
             <span class="icon-case"><i class="fa fa-birthday-cake"></i></span>
              <input type="date" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" class="datepicker" name="date_of_birth" id="Date of Birth" value="" required/>                <div class="validation"></div>                
            </div>
            
            <div class="form-group">
            <p>Gender <span>*</span></p>
            <span class="icon-case"><i class="fa fa-venus-mars"></i></span>
            <select name="gender"   required="required">
                   <option></option> 
                   <option value="male">F</option> 
                   <option value="female">M</option>
              </select><br>
              <div class="validation"></div>              
            </div>
       </div>

    <div class="rightcontact">    

            <div class="form-group">
            <p>City <span>*</span></p>
            <span class="icon-case"><i class="fa fa-building-o"></i></span>
                <input type="text" name="City" id="City" required />
                <div class="validation"></div>
            </div>    

            <div class="form-group">
            <p>Phone number <span>*</span></p>    
            <span class="icon-case"><i class="fa fa-phone"></i></span>
                <input type="text" name="phone" id="phone" data-rule="maxlen:10" />
                <div class="validation"></div>
            </div>

            <div class="form-group">
            <p>Ocupation <span>*</span></p>
            <span class="icon-case"><i class="fa fa-info"></i></span>
                <input type="text" name="Ocupation" id="Ocupation" required />
                <div class="validation"></div>
            </div>

            <div class="form-group">
            <p>Babtised <span>*</span></p>    
            <span class="icon-case"><i class="fa fa-comment-o"></i></span>
                <input type="text" name="Babtised" id="Babtised" required />
                <div class="validation"></div>
            </div>
        
            <div class="form-group">
            <p>Other <span>*</span></p>
            <span class="icon-case"><i class="fa fa-comments-o"></i></span>
                <textarea name="Other" rows="14" required ></textarea>
                <div class="validation"></div>
            </div>    
    </div>
    </div>
<button type="submit" name="submit" value="Submit" class="bouton-contact">Send</button>

    
</form>    

  


<?php
require 'mail.php';
function array_2_csv($array)
{
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


if (isset($_POST['submit'])) {
	require 'lib/datetime.php';
	//$oDate = new ExtendedDateTime('now', new DateTimeZone("Europe/Amsterdam"));
	//$csvid = $oDate->format('m-d-Y\TH:i:s.u');
	$csvid = "123test";

	/*
    $from          = $_POST['email']; // this is the sender's Email address
    $first_name    = $_POST['first_name'];
    $last_name     = $_POST['last_name'];
    $email         = $_POST['email'];
    $Street        = $_POST['Street'];
    $Nr            = $_POST['Nr'];
    $Postcode      = $_POST['Postcode'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender        = $_POST['gender'];
    $City          = $_POST['City'];
    $phone         = $_POST['phone'];
    $Ocupation     = $_POST['Ocupation'];
    $Babtised      = $_POST['Babtised'];
	
    $subject       = "Form submission";
    $subject2      = "Copy of your form submission";
    $message       = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
    $message2      = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];
    $headers       = "From:" . $from;
    $headers2      = "From:" . $to;
*/

    $arr = $_POST;
	$arr = array_merge(array('csvid' => $csvid), $arr);

    unset($arr['submit']);
    echo "<pre>"; print_r($_POST); echo "</pre>";

    // Send the email
    sendmail(array_2_csv($arr), $csvid, 'wisam.almarany@gmail.com', 'Wisam Almarany');
	//sendmail(array_2_csv($arr), $csvid, 'michiel.pleijte@gmail.com', 'M. Pleijte');
	sendmail(array_2_csv($arr), $csvid, 'censusmandaean@gmail.com', 'mandaean mail');	
	
	
}
?>
   <div class="footer">
    <p>
        Copyright &copy; mandaeancensus. All rights reserved. <a href="http://www.mandaeancensus.org//" title="mandaeancensus">
    </p>
</div>
    
</body>
</html> 