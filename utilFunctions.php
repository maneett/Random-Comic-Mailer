<?php

// server side e-mail validation
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) 
        && preg_match('/@.+\./', $email);
}

// returning response to javascript
function returnResponse($msg, $status) {
	header("HTTP/1.1 $status $msg ");
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => $msg)));
}

// generating otp
function genetateOTP () {
	return random_int( 100000, 999999 );
}

?>