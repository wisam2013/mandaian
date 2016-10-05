<?php

		// src: http://stackoverflow.com/questions/169428/php-datetime-microseconds-always-returns-0
		class ExtendedDateTime extends DateTime {
			/**
			 * Returns new DateTime object.  Adds microtime for "now" dates
			 * @param string $sTime
			 * @param DateTimeZone $oTimeZone 
			 */
			public function __construct($sTime = 'now', DateTimeZone $oTimeZone = NULL) {
				// check that constructor is called as current date/time
				if (strtotime($sTime) == time()) {
					$aMicrotime = explode(' ', microtime());
					$sTime = date('m-d-Y H:i:s.' . $aMicrotime[0] * 1000000, $aMicrotime[1]);
				}

				// DateTime throws an Exception with a null TimeZone
				if ($oTimeZone instanceof DateTimeZone) {
					parent::__construct($sTime, $oTimeZone);
				} else {
					parent::__construct($sTime);
				}
			}
		}

		// ===
		//  Examples 
		// ===
		// $oDate = new ExtendedDateTime('now', new DateTimeZone("Europe/Amsterdam"));
		// echo $oDate->format('m-d-Y H:i:s.u e');

?>