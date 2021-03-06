<?php
/*
These functions are adapted to facebooks php sdk v2.0.4
*/

// Use this to fix facebooks big int so it will render right.
function longintToString($i) {
	if ($i >= PHP_INT_MAX)
		return floor($i / pow(10,6)) . ($i - floor($i / pow(10,6))* pow(10,6));
	else
		return (string)$i;
}

function check_permission($ext_perm) {
	global $facebook;
	$session = $facebook->getSession();
	if (!$session) return false;
	try {
		return $facebook->api(array(
			'method'  => 'users.hasAppPermission',
			'ext_perm'  => $ext_perm,
			'callback'=> ''
		));
	} catch (FacebookApiException $e) {
		error_log($e);
		return false;
	} 
}

function get_permission_url($req_perms, $return_url) {
	global $facebook;
	return $facebook->getLoginUrl(array(
		'req_perms' => $req_perms,
		'next' => $return_url,
		'cancel_url' => $return_url
	));
}

?>