<?php
if(!isset($_SESSION)) {
	session_start();
}
require_once('./connect.php');

if(isset($_POST['thread-reply'])) {
	$uid = $_SESSION['user_id'];
	$tid = $_POST['thread-reply'];
	$content = $_POST['reply-content'];
	$err = false;

	if(empty(trim($content))) {
		$_SESSION['error'] = "Reply can't be empty";
		$err = true;
	}

	if($err == false) {
		$sql = "INSERT INTO post (post_content, post_thread, post_user) VALUES (:content, :tid, :uid)";
		$params = array(
			':uid' => $uid,
			':content' => $content,
			':tid' => $tid
		);
		$stmt = $conn->prepare($sql);
		if($stmt->execute($params)) {
			header("Location: ../".$_SESSION['last_page']); exit();
		} else {
			$_SESSION['error'] = "Cannot reply at this moment";
			header("Location: ../".$_SESSION['last_page']); exit();
		}
	}
}
?>