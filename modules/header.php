<?php 
if(!isset($_SESSION)) {
	session_start();
}
require_once('./config/config.php');
require_once('./config/connect.php');
require_once('./config/functions.php');
if($LOGGED_IN) {
	require_once('./config/logout.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $TITLE; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" rel="stylesheet">
	<link href="./assets/css/style.css" rel="stylesheet">
</head>
<body>
<?php
require_once('./modules/nav.php');
?>