<?php

// $path = "html2xml_template.phun";
// $string 	= file_get_contents($path);
// $newString 	= bin2hex( $string );
// file_put_contents($path, $newString);

// $path = "html2xml_header.phun";
// $string 	= file_get_contents($path);
// $newString 	= bin2hex( $string );
// file_put_contents($path, $newString);

// $path = "xml2html_template.phun";
// $string 	= file_get_contents($path);
// $newString 	= bin2hex( $string );
// file_put_contents($path, $newString);

// $path = "xml2html_header.phun";
// $string 	= file_get_contents($path);
// $newString 	= bin2hex( $string );
// file_put_contents($path, $newString);

// $path = "../plugin_template.p";
// $string 	= file_get_contents($path);
// $newString 	= bin2hex( $string );
// file_put_contents($path, $newString);

$path = "../loader.cnf";
$string 	= file_get_contents($path);
$newString 	= bin2hex( $string );
file_put_contents($path, $newString);

?>