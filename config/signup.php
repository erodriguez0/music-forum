<?php
if(!isset($_SESSION)) {
	session_start();
}
require_once('./connect.php');
// SIGN UP
if(isset($_POST['signup'])) {
	$err = false;
	// GET FIELDS
	$email = $_POST['email'];
	$uname = $_POST['username'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$pass0 = $_POST['pass0'];
	$pass1 = $_POST['pass1'];

	// CHECK IF ANY CHARACTERS ARE EMPTY
	if(empty($email) || empty($uname) || empty($pass0) || empty($pass1)) {
		$err = true;
		$_SESSION['error'] .= "No field can be empty\n";
	}

	// VALIDATE PASSWORD REQUIREMENTS
	$uppercase = preg_match('@[A-Z]@', $pass0);
	$lowercase = preg_match('@[a-z]@', $pass0);
	$number    = preg_match('@[0-9]@', $pass0);
	if(!$uppercase || !$lowercase || !$number || strlen($pass0) < 7) {
		$err = true;
		$_SESSION['error'] .= "Password not alphanumeric\n";
	}

	// CHECK IF PASSWORDS ARE THE SAME
	if(strcmp($pass0, $pass1) != 0) {
		$err = true;
		$_SESSION['error'] .= "Passwords don't match\n";
	}

	// CHECK FOR INVALID CHARACTERS
	$uname_alnum = ctype_alnum_custom($uname);
	$email_alnum = filter_var($email, FILTER_VALIDATE_EMAIL);
	$pass0_alnum = ctype_alnum_custom($pass0);
	$fname_alnum = ctype_alnum_custom($fname);
	$lname_alnum = ctype_alnum_custom($lname);
	if(!$uname_alnum || !$email_alnum || !$pass0_alnum || !$fname_alnum || !$lname_alnum) {
		$err = true;
		$_SESSION['error'] .= "Only letters and numbers\n";
	}

	if($err == false) {
		$dbErr = false;
		$hash = password_hash($pass0, PASSWORD_BCRYPT);
		// CHECK FOR EXISTING USER
		$sql = "SELECT * FROM user WHERE user_uname = :uname OR user_email = :email";
		$params = array(
			':uname' => $uname,
			':email' => $email
		);

		$stmt = $conn->prepare($sql);
		$stmt->execute($params);
		if($stmt->rowCount() > 0) {
			$dbErr = true;
		}

		// INSERT RECORD
		if($dbErr == false) {
			$sql = "INSERT INTO user (user_uname, user_pwd, user_email, user_fname, user_lname) VALUES (:user, :hash, :email, :fname, :lname)";
			$params = array(
				':user' => $uname,
				':hash' => $hash,
				':email' => $email,
				':fname' => $fname,
				':lname' => $lname
			);

			$stmt = $conn->prepare($sql);
			if($stmt->execute($params)) {
				$uid = $conn->lastInsertId();
				$sql = "SELECT * FROM user WHERE user_id = :uid";
				$params = array(
					':uid' => $uid
				);
				$stmt = $conn->prepare($sql);
				if($stmt->execute($params)) {
					$row = $stmt->fetch();
					$_SESSION['user_uname'] = $row['user_uname'];
					$_SESSION['logged_in'] = true;
					$_SESSION['user_level'] = $row['user_level'];
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['user_img'] = $row['user_img'];
					header('Location: ../home.php');
				} else {
					header('Location: ../signup.php');
				}
			} else {

			}
		}
	} else {
		$_SESSION['values']['email'] = $email;
		$_SESSION['values']['username'] = $uname;
		$_SESSION['values']['fname'] = $fname;
		$_SESSION['values']['lname'] = $lname;
		header('Location: ../signup.php');
	}
}

function ctype_alnum_custom($text) {
    return (preg_match('/^[a-zA-Z0-9]+$/', $text) > 0);
}
?>