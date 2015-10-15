<?php 
	// destroying session on log out
	session_start();
	$_SESSION = array();
	if (ini_get("session.use_cookies")) {
		$yesterday = time() - (24 * 60 * 60);
		$params = session_get_cookie_params();
		setcookie(session_name(), '', $yesterday,
        	$params["path"], $params["domain"],
        	$params["secure"], $params["httponly"]
        	);
        }
    session_destroy();
    // redirecting user to the index page and passing a message as URL parameter. 
    // Use base64_encode to shorten the text in the url, and url_encode to make sure that the URL doesn't get junked up.
	header('Location:http://titan.dcs.bbk.ac.uk/~ztoth01/php_port/index.php?msg=' . urlencode(base64_encode("You have been successfully logged out!")));
	die();
?>


