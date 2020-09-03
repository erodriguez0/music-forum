<?php
if(!isset($_SESSION)) {
	session_start();
}
// LOG OUT
if(isset($_GET['logout']) && isset($_SESSION['logged_in'])) {
	setcookie(session_name(), '', 100);
	session_unset();
	session_destroy();
	$_SESSION = array();
	header('Location: ./home.php');
}
?>