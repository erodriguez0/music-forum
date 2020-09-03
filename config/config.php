<?php
if(!isset($_SESSION)) {
	session_start();
}
// include_once('./connect.php');
$FILE = basename($_SERVER['SCRIPT_NAME'], ".php");
$URL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$URI_PARTS = explode('?', $_SERVER['REQUEST_URI']);
$CLEAN_URL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$URI_PARTS[0]";
// echo $URL;

switch($FILE) {
	case 'home':
		$TITLE = 'Home';
		break;
	case 'login':
		$TITLE = 'Login';
		break;
	case 'signup':
		$TITLE = 'Sign Up';
		break;
	case 'viewaccount':
		$TITLE = 'Account';
		if(isset($_GET['edit'])) {
			$TITLE = 'Edit Account';
		}
		break;
	case 'viewthread':
		$TITLE = 'Thread';
		break;
}

$LOGGED_IN = ($_SESSION['logged_in']) ? true : false;
$LEVEL = (isset($_SESSION['user_level'])) ? $_SESSION['user_level'] : 0;
?>