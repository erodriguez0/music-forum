<?php
if(!isset($_SESSION)) {
	session_start();
}
require_once('./connect.php');

if(isset($_POST['new-thread'])) {
	$title = isset($_POST['title']) ? $_POST['title'] : '';
	$content = isset($_POST['content']) ? $_POST['content'] : '';
	$err = false;
	$user = $_SESSION['user_id'];
	$top = $_POST['new-thread'];

	if(empty($title) || empty($content)) {
		$_SESSION['error'] = "Fields cannot be empty";
		$err = true;
	}

	if($err === false) {
		$sql = "INSERT INTO thread (thread_title, thread_content, thread_top, thread_user) VALUES (:title, :content, :top, :user)";
		$params = array(
			':title' => $title,
			':content' => $content,
			':top' => $top,
			':user' => $user
		);
		$stmt = $conn->prepare($sql);
		if($stmt->execute($params)) {
			$id = $conn->lastInsertId();
			header("Location: ../viewthread.php?id=".$id); exit();
		}
	} else {
		$_SESSION['values']['title'] = $title;
		$_SESSION['values']['content'] = $content;
		header("Location: ../".$_SESSION['last_page']);
	}	
}

if(isset($_POST['post-reply'])) {
	$content = (isset($_POST['reply-content'])) ? $_POST['reply-content'] : '';
	$pid = $_POST['post-reply'];
	$uid = $_SESSION['user_id'];
	$err = false;

	if(empty($content)) {
		$err = true;
	}

	if($err == false) {
		$sql = "INSERT INTO reply (reply_content, reply_user, reply_post) VALUES (:content, :uid, :pid)";
		$params = array(
			':content' => $content,
			':uid' => $uid,
			':pid' => $pid
		);
		$stmt = $conn->prepare($sql);
		if($stmt->execute($params)) {
			$_SESSION['success'] = "Reply posted";
			header("Location: ../".$_SESSION['last_page']);
		} else {
			$_SESSION['error'] = "Error posting reply";
			header("Location: ../".$_SESSION['last_page']);
		}
	} else {
		$_SESSION['error'] = "Reply cannot be empty";
		header("Location: ../".$_SESSION['last_page']);
	}
}
?>