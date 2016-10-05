<?php

  // src: http://www.the-art-of-web.com/php/blowfish-crypt/





  	// Original PHP code by Chirp Internet: www.chirp.com.au
	// Please acknowledge use of this code by including this header.
	function better_crypt($input, $rounds = 10) {
    	$crypt_options = array(
      		'cost' => $rounds
		);
    	return password_hash($input, PASSWORD_BCRYPT, $crypt_options);
	}

	function check_blowfish_enabled() {
		if(defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
			echo "CRYPT_BLOWFISH is enabled!";
		} else {
			echo "CRYPT_BLOWFISH is NOT enabled!";
		}
	}
   // ===
   //  Usage examples
   // ===
   // $password_hash = better_crypt($password);
   // $password_hash = better_crypt($password, 10); // will take longer
   // $password_hash = better_crypt($password, 15); // will take a LOT longer

	function checkValidPassword($password_entered, $password_hash) {
		if(crypt($password_entered, $password_hash) == $password_hash) {
    		return true;
		} else
			return false;
	}


?>