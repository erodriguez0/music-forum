<?php
if(!isset($_SESSION)) {
	session_start();
}
require_once('./connect.php');
error_reporting(E_ALL);
ini_set("display_errors", 1);
if(isset($_POST['update'])) {
	if($_POST['update'] == 'password') {
		$pwd0 = (isset($_POST['user_pwd0'])) ? $_POST['user_pwd0'] : '';
		$pwd1 = (isset($_POST['user_pwd1'])) ? $_POST['user_pwd1'] : '';

		// CHECK FOR EMPTY FIELDS
		if(empty($pwd0) || empty($pwd1)) {
			$err = true;
			$_SESSION['error'] = "Password field can't be empty\n";
		}

		// VALIDATE PASSWORD REQUIREMENTS
		$uppercase = preg_match('@[A-Z]@', $pwd0);
		$lowercase = preg_match('@[a-z]@', $pwd0);
		$number    = preg_match('@[0-9]@', $pwd0);
		if(!$uppercase || !$lowercase || !$number || strlen($pwd0) < 7) {
			$err = true;
			$_SESSION['error'] .= "Not alphanumeric or contain at least 1 uppercase\n";
		}

		// CHECK IF PASSWORDS MATCH
		if(strcmp($pwd0, $pwd1) != 0) {
			$err = true;
			$_SESSION['error'] .= "Passwords don't match\n";
		}

		if($err == false) {
			$uid = $_SESSION['user_id'];
			$pwd = password_hash($pwd0, PASSWORD_BCRYPT);
			$sql = "UPDATE user SET user_pwd = :pwd WHERE user_id = :uid";
			$params = array(
				':pwd' => $pwd,
				':uid' => $uid
			);
			$stmt = $conn->prepare($sql);
			if($stmt->execute($params)) {
				$_SESSION['success'] = "Password updated\n";
				header("Location: ../".$_SESSION['last_page']); exit();
			}
		} else {
			header("Location: ../".$_SESSION['last_page']); exit();
		}
	} else if($_POST['update'] == 'info') {
		$gender = (isset($_POST['info_gender'])) ? $_POST['info_gender'] : '';
		$bdate = (isset($_POST['info_bdate'])) ? $_POST['info_bdate'] : '';
		$err = false;
		
		// if(!ctype_alpha($gender)) {
		// 	$_SESSION['error'] = "Gender can only be letters\n";
		// 	$err = true;
		// }

		if($err == false) {
			$uid = $_SESSION['user_id'];
			$sql = "UPDATE user_info SET info_gender = :gender, info_bday = :bdate WHERE info_user = :uid";
			$params = array(
				':gender' => $gender,
				':bdate' => $bdate,
				':uid' => $uid
			);
			$stmt = $conn->prepare($sql);
			if($stmt->execute($params)) {
				$_SESSION['success'] = "Profile updated";
				header("Location: ../".$_SESSION['last_page']); exit();
			} else {
				$_SESSION['error'] = "Cannot update at this time";
				header("Location: ../".$_SESSION['last_page']); exit();
			}
		}
	} else if($_POST['update'] == 'bio') {
		$bio = $_POST['bio'];
		$uid = $_SESSION['user_id'];
		$sql = "UPDATE user_info SET info_bio = :bio WHERE info_user = :uid";
		$params = array(
			':bio' => $bio,
			':uid' => $uid
		);
		$stmt = $conn->prepare($sql);
		if($stmt->execute($params)) {
			$_SESSION['success'] = "Bio updated";
			header("Location: ../".$_SESSION['last_page']); exit();
		} else {
			$_SESSION['error'] = "Cannot update at this time";
			header("Location: ../".$_SESSION['last_page']); exit();
		}
	} else {
		$_SESSION['error'] = "Error updating profile";
		header("Location: ../".$_SESSION['last_page']); exit();
	}
}

// UPDATE PROFILE PICTURE
if(isset($_POST['update-pic']) && isset($_FILES['userfile'])) {
	$file_name = $_FILES['userfile']['name'];
	$file_size = $_FILES['userfile']['size'];
	$file_tmp = $_FILES['userfile']['tmp_name'];
	$file_type = $_FILES['userfile']['type'];
	$file_ext = pathinfo($path, PATHINFO_EXTENSION);
	$base_dir = "../assets/img/";
	$newfilename = round(microtime(true)) . '.' . "jpeg";
	$extensions = array("jpeg", "jpg", "png");

	// CHECK EXTENSION
	if(in_array($file_ext, $extensions) === false) {
		// $_SESSION['error'] = "File type not allowed.";
	}

	// MAX FILE SIZE 2MB
	if($file_size > 2097152) {
		$_SESSION['error'] = "File size limit exceeded";
	}

	// // MAKE DRIECTORY IF DOESN'T EXIST
	// // if(!file_exists($base_dir)) {
	// // 	mkdir($base_dir, 0777, true);
	// // }

	// // IMAGE THUMBNAIL RESIZE

	if(!isset($errors)) {
		// UPLOAD IMAGE, INSERT/UPDATE DATABASE USER_IMG
		if(move_uploaded_file($file_tmp, $base_dir.$newfilename)) {
			$userid = $_SESSION['user_id'];
			$sql = "UPDATE user SET user_img = :file WHERE user_id = :uid";
			$params = array(
				':file' => $newfilename,
				':uid' => $userid
			);
			$stmt = $conn->prepare($sql);
			if($stmt->execute($params)) {
				$delFile = $base_dir.$_SESSION['user_img'];
				if(file_exists($delFile)) {
					if($_SESSION['user_img'] != 'default.png') {
						chmod($delFile, 0644);
						unlink($delFile);
					}
				}
				$_SESSION['user_img'] = $newfilename;
				header("Location: ../".$_SESSION['last_page']); exit();
			}
		} else {
			// ERROR ON SAVING FILE
			
		}
	} else {
		header("Location: ../".$_SESSION['last_page']); exit();
	}
}
?>