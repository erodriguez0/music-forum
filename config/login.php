<?php
// include_once('./config/config.php');
if(!isset($_SESSION)) {
	session_start();
}
require_once('./connect.php');
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// LOG IN
if(isset($_POST['login'])) {
	$err = false;
	$user = (isset($_POST['user_uname'])) ? $_POST['user_uname'] : '';
	$pass = (isset($_POST['user_pwd'])) ? $_POST['user_pwd'] : '';

	// CHECK FOR EMPTY FIELDS
	if(empty($user) || empty($pass)) {
		$_SESSION['error'] = "Input field cannot be empty\n";
		$err = true;
	}

	//CHECK FOR INVALID CHARACTERS
	// if(!ctype_alnum($user) || !ctype_alnum($pass)) {
	// 	$_SESSION['err']['login'][] = 'Invalid characters in input fields';
	// 	$err = true;
	// }

	// PERFORM LOGIN
	if($err === false) {
		$hash = '';
		$user_level = '';
		$user_id = '';
		$sql = "SELECT * FROM user WHERE user_uname = :uname";
		$params = array(
			':uname' => $user
		);
		$stmt = $conn->prepare($sql);
		$stmt->execute($params);
		while($row = $stmt->fetch()) {
			$hash = $row['user_pwd'];
			$user_level = $row['user_level'];
			$user_id = $row['user_id'];
			$user_img = $row['user_img'];
		}
		if(password_verify($pass, $hash)) {
			$_SESSION['user_uname'] = $user;
			$_SESSION['logged_in'] = true;
			$_SESSION['user_level'] = $user_level;
			$_SESSION['user_id'] = $user_id;
			$_SESSION['user_img'] = $user_img;
			header('Location: ../'.$_SESSION['last_page']); exit();
		} else {
			$_SESSION['values']['user_uname'] = $user;
			$_SESSION['error'] .= "Wrong password or user not found";
			header('Location: ../login.php'); exit();
		}
	} else {
		$_SESSION['values']['user_uname'] = $user;
		header('Location: ../login.php'); exit();
	}
}