<HTML>
	<HEAD></HEAD>
	<BODY>

		<?php 
		// require 'lib/csv.php';
		require 'lib/datetime.php';
		require 'lib/security.php';

		$password = "BLA";
   		$password_hash = better_crypt($password, 10); // will take longer
		echo "password_hash = $password_hash <br>";

		if (checkValidPassword("BLA", $password_hash)) {
			echo "YAHOO";
		} else {
			echo "Sad clown :-(";
		}

		
		$oDate = new ExtendedDateTime('now', new DateTimeZone("Europe/Amsterdam"));
		echo $oDate->format('m-d-Y H:i:s.u e');

		$pwd = dirname(__FILE__);
		$csvdir="$pwd/csv";

		echo "<h1>SIMPLE CSV CONCATENATE EXAMPLE</h1><br>";
		$dtz = new DateTimeZone("Europe/Amsterdam"); //Your timezone
		$now = new DateTime(date("m-d-Y H:i:s.u"), $dtz);
		echo $now->format("m-d-Y H:i:s.u");


		$targetfile="$pwd/merge.csv";	
		$result = fopen($targetfile, 'w');
		$dir = new DirectoryIterator($csvdir);

		echo "<b>Opening directory: $csvdir<br>";
        echo "Searching for '.csv' files ... </b><br>";

		$filecounter=0;
		echo "<ol>";
		foreach ($dir as $fileinfo) {
		  if ($fileinfo->isFile() && $fileinfo->getExtension() === 'csv' ) {
				echo "<li>".$fileinfo->getFilename()."</li>";
				$content = file_get_contents($fileinfo->getPathname());
				fwrite($result, $content."\r\n");		
			    $filecounter += 1;
			  }
		}
		echo "</ol>";
		fclose($result);
	
		if($filecounter > 1) {				
			echo "Merged these $filecounter files into $targetfile";
		} else if($filecounter == 1) {
			echo "Only one file found, nothing to merge, please add more than one .csv file in $csvdir";			
		} else {
			echo "No .csv files found, please add more than one .csv file in $csvdir";			
		}


		function pp($arr) {
			echo "<pre>".print_r($arr, true)."</pre>";
		}


		?> 

	</BODY>
</HTML>
