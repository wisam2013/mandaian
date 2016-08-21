<?php
$filename  = "file.csv";
$path      = "./";
$file      = $filename;
$file_size = filesize($file);
$handle    = fopen($file, "r");
$content   = fread($handle, $file_size);
fclose($handle);

$content = "YAHOO; DIT IS WAT ANDERS EN HET WERKT!";
$content = chunk_split(base64_encode($content));
$uid     = md5(uniqid(time()));
$name    = basename($file);

$eol     = PHP_EOL;
$subject = "Mail Out Certificate";
$message = '<h1>Hi i m mashpy</h1>';

$from_name = "mail@example.com";
$from_mail = "mail@example.com";
$replyto   = "mail@example.com";
$mailto    = "michiel.pleijte@gmail.com";
$header    = "From: " . $from_name . " <" . $from_mail . ">\n";
$header .= "Reply-To: " . $replyto . "\n";
$header .= "MIME-Version: 1.0\n";
$header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\n\n";*/
$emessage = "--" . $uid . "\n";
$emessage .= "Content-type:text/html; charset=iso-8859-1\n";
$emessage .= "Content-Transfer-Encoding: 7bit\n\n";
$emessage .= $message . "\n\n";
$emessage .= "--" . $uid . "\n";
$emessage .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\n"; // use different content types here
$emessage .= "Content-Transfer-Encoding: base64\n";
$emessage .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\n\n";
$emessage .= $content . "\n\n";
$emessage .= "--" . $uid . "--";


if (mail($mailto, $subject, $emessage, $header)) {
	echo "mail send ... OK"; // or use booleans here
} else {
	echo "mail send ... ERROR!";
	print_r(error_get_last());
}



?>