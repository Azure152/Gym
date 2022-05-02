<?php

define('SERVER_URL', 'http://localhost/gym2');
define('PUBLIC_ROOT', "{$_SERVER['DOCUMENT_ROOT']}/gym2/public" );
define('ENCRYPT_METHOD', 'AES-256-CBC');
define('ENCRYPT_KEY', '20MakeYourBody22');
define('ENCRYPT_IV', '2202');

function encryption($string){
	$output=FALSE;
	$key=hash('sha256', ENCRYPT_KEY);
	$iv=substr(hash('sha256', ENCRYPT_IV), 0, 16);
	$output=openssl_encrypt($string, ENCRYPT_METHOD, $key, 0, $iv);
	$output=base64_encode($output);
	return $output;
}

function decryption($string){
	$key=hash('sha256', ENCRYPT_KEY);
	$iv=substr(hash('sha256', ENCRYPT_IV), 0, 16);
	$output=openssl_decrypt(base64_decode($string), ENCRYPT_METHOD, $key, 0, $iv);
	return $output;
}

date_default_timezone_set('America/Bogota');

/* <=== ========================================================================
	Seccion de la declaracion para el ajax
======================================================================== ==?> */
