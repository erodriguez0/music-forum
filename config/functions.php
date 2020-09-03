<?php
if(!isset($_SESSION)) {
	session_start();
}

function getUserInfo(PDO $conn, $uid) {
	$sql = "SELECT * FROM user,user_info WHERE user_id = info_user AND user_id = :uid";
	$params = array(
		':uid' => $uid
	);
	$stmt = $conn->prepare($sql);
	if($stmt->execute($params)) {
		return $stmt->fetch();
	}
}

function getUserPosts(PDO $conn, $uid) {
	$sql = "SELECT post_id, thread_id, top_id, post_date, post_content, thread_title, thread_content, top_name FROM user, post, thread, topic WHERE user_id = post_user AND post_thread = thread_id AND thread_top = top_id AND user_id = :uid ORDER BY post_date ASC";
	$params = array(
		':uid' => $uid
	);
	$stmt = $conn->prepare($sql);
	if($stmt->execute($params)) {
		return $stmt->fetchAll();
	}
}

function getCategories(PDO $conn) {
	$sql = "SELECT * FROM category";
	$stmt = $conn->prepare($sql);
	if($stmt->execute()) {
		return $stmt->fetchAll();
	}
}

function getTopic(PDO $conn, $cid) {
	$sql = "SELECT * FROM topic WHERE top_cat = :cid";
	$params = array(
		':cid' => $cid
	);
	$stmt = $conn->prepare($sql);
	if($stmt->execute($params)) {
		return $stmt->fetchAll();
	}	
}

function getTopicInfo(PDO $conn, $tid) {
	$sql = "SELECT top_id, top_name FROM topic WHERE top_id = :tid";
	$params = array(
		':tid' => $tid
	);
	$stmt = $conn->prepare($sql);
	if($stmt->execute($params)) {
		return $stmt->fetchAll();
	}	
}

function getCount(PDO $conn, $tid) {
	$sql = "SELECT count(thread_id) AS thread_count FROM topic, thread WHERE thread_top = top_id AND top_id = :tid";
	$params = array(
		':tid' => $tid
	);
	$stmt = $conn->prepare($sql);
	if($stmt->execute($params)) {
		return $stmt->fetch();
	}	
}

function getRecentThreads(PDO $conn) {
	$sql = "SELECT thread_id, thread_title, thread_content, thread_date, user_uname, user_id, top_name, top_id FROM thread, user, topic WHERE user_id = thread_user AND thread_top = top_id ORDER BY thread_date DESC LIMIT 10";
	$stmt = $conn->prepare($sql);
	if($stmt->execute()) {
		return $stmt->fetchAll();
	}
}

function getThreads(PDO $conn, $tid) {
	$sql = "SELECT thread_id, thread_title, thread_content, thread_date, user_id, user_uname FROM thread, user WHERE thread_user = user_id AND thread_top = :tid";
	$params = array(
		':tid' => $tid
	);
	$stmt = $conn->prepare($sql);
	if($stmt->execute($params)) {
		return $stmt->fetchAll();
	}
}

function getThreadInfo(PDO $conn, $tid) {
	$sql = "SELECT thread_title, thread_content, thread_date, user_id, user_uname, top_id, top_name FROM thread, user, topic WHERE thread_user = user_id AND thread_top = top_id AND thread_id = :tid";
	$params = array(
		':tid' => $tid
	);
	$stmt = $conn->prepare($sql);
	if($stmt->execute($params)) {
		return $stmt->fetch();
	}
}

function getThreadPosts(PDO $conn, $tid) {
	$sql = "SELECT user_id, user_uname, user_img, user_level, user_state, post_id, post_content, post_date, post_state FROM user, post WHERE post_user = user_id AND post_thread = :tid ORDER BY post_date ASC";
	$params = array(
		':tid' => $tid
	);
	$stmt = $conn->prepare($sql);
	if($stmt->execute($params)) {
		return $stmt->fetchAll();
	}
}

function getReplies(PDO $conn, $pid) {
	$sql = "SELECT DISTINCT reply_content, reply_date, reply_state, user_id, user_uname, user_state, user_img FROM reply, post, user WHERE user_id = reply_user AND reply_post = :pid ORDER BY reply_date ASC";
	$params = array(
		':pid' => $pid
	);
	$stmt = $conn->prepare($sql);
	if($stmt->execute($params)) {
		return $stmt->fetchAll();
	}
}

function getReplyCount(PDO $conn, $pid) {
	$sql = "SELECT DISTINCT count('reply_id') AS reply_count FROM reply, post WHERE reply_post = post_id AND post_id = :pid";
	$params = array(
		':pid' => $pid
	);
	$stmt = $conn->prepare($sql);
	if($stmt->execute($params)) {
		$row = $stmt->fetch();
		return $row['reply_count'];
	}
}
?>
