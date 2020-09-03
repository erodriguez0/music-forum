<?php
if(!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
	header('Location: ./home.php'); exit();
} else {
$tid = $_GET['id'];
require_once('./modules/header.php');
$_SESSION['last_page'] = $FILE.".php?id=".$tid;
$thread = getThreadInfo($conn, $tid);
$title = htmlspecialchars($thread['thread_title']);
$user = htmlspecialchars($thread['user_uname']);
$user_link = "<a href='./viewaccount.php?id=".$thread['user_id']."'>";
$tdate = date_create($thread['thread_date']);
$date = date_format($tdate, "M d, Y h:i A");
$content = nl2br(htmlspecialchars($thread['thread_content']));
$top_name = htmlspecialchars($thread['top_name']);
$top_id = $thread['top_id'];
$top_link = "<a href='./viewtopic.php?id=".$top_id."'>".$top_name."</a>";
// $posts = getThreadPosts($conn, $tid);
?>
<div class="container">
<div class="row">
<div class="col-12 col-md-8 pt-3">
<div class="thread-header">
	<div class="forum-header">
		<div class="row py-1 stylish-color-dark text-white">
			<div class="col-12">
				<small><b><a href="./home.php">Home</a> > <?php echo $top_link; ?></b></small>
			</div>
		</div>
	</div>
	<?php
	if(isset($_SESSION['error'])) {
		echo '<div class="alert alert-danger px-3 mt-3">';
		echo '<small class="text-danger">';
		echo nl2br(htmlspecialchars($_SESSION['error']));
		echo '</small>';
		echo '</div>';
		unset($_SESSION['error']);
	} else if($_SESSION['success']) {
		echo '<div class="alert alert-success px-3 mt-3">';
		echo '<small class="text-success">';
		echo nl2br(htmlspecialchars($_SESSION['success']));
		echo '</small>';
		echo '</div>';
		unset($_SESSION['success']);
	}
	?>
	<div class="row pt-3">
		<div class="col-12">
		<div class="thread-title">
			<h5><?php echo $title; ?></h5>
		</div>
		<div class="thread-user">
			<small>Posted by <?php echo $user_link.$user."</a>"; ?> on <?php echo $date; ?></small>
		</div>
		<div class="thread-content pt-3">
			<p>
				<?php echo $content; ?>
			</p>
		</div>
		</div>
	</div>
	<?php
	if($LOGGED_IN) {
	?>
	<div class="row pt-2">
		<div class="col-12">
			<button type="button" class="btn btn-sm reply-btn btn-update mb-3 px-3 ml-0 z-depth-0" id="reply-btn"><i class="fas fa-reply pr-2"></i>Reply</button>
			<div class="reply-form">
				<form method="post" action="./config/reply.php">
				<textarea class="form-control rounded-0 w-100" rows="4" name="reply-content"></textarea>
				<button class="btn btn-sm float-right btn-update my-3 px-3 ml-0 z-depth-0" type="submit" name="thread-reply" value="<?php echo $tid; ?>">Submit</button>
				</form>
			</div>
		</div>	
	</div>
	<?php
	}
	?>
</div>
<div class="thread-replies pt-3">
<?php
$posts = getThreadPosts($conn, $tid);
echo count($posts)." Replies <hr>";
// print_r($posts);
for($i = 0; $i < count($posts); $i++) {
$puid = $posts[$i]['user_id'];
$ppid = $posts[$i]['post_id'];
$pulink = "./viewaccount.php?id=".$puid;
$puname = htmlspecialchars($posts[$i]['user_uname']);
$pimg = "./assets/img/".$posts[$i]['user_img'];
$pcontent = nl2br(htmlspecialchars($posts[$i]['post_content']));
$pdate = date_create($posts[$i]['post_date'])->format('M d, Y h:i A');
$reply = getReplies($conn, $ppid);
// $replyCount = getReplyCount($conn, $ppid);
?>
	<div class="post-container pt-3">
		<div class="post-info">
				<div class="pr-3 float-left">
					<a href="<?php echo $pulink; ?>"><img class="" src="<?php echo $pimg; ?>"></a>
				</div>
				<div class="">
					<small class="">Posted <?php echo $pdate; ?></small>
					<p class="mb-0"><a href="<?php echo $pulink; ?>"><?php echo $puname; ?></a></p>
				</div>
		</div>
		<div class="post-content pt-4">
			<p>
				<?php echo $pcontent; ?>
			</p>
		</div>
		<?php
		if($LOGGED_IN) {
		?>
		<div class="post-actions">
			<button type="button" class="btn btn-sm reply-btn btn-update mb-3 px-3 ml-0 z-depth-0"><i class="fas fa-reply pr-2" value=""></i>Reply</button>
			<div class="reply-form">
				<form method="post" action="./config/thread.php">
				<textarea class="form-control rounded-0 w-100" rows="4" name="reply-content"></textarea>
				<button class="btn btn-sm btn-update my-3 px-3 ml-0 z-depth-0" type="submit" name="post-reply" value="<?php echo $ppid; ?>">Submit</button>
				</form>
			</div>
		</div>
		<?php
		}
		// if($replyCount > 0) {
		// 	echo '<button type="submit" class="btn btn-sm btn-block my-3 px-3 z-depth-0 show-replies" value="'.$ppid.'">Show Replies</button>';
		// }
		?>
		<?php
		for($j = 0; $j < count($reply); $j++) {
		$rdate = date_create($reply[$j]['reply_date'])->format('M d, Y h:i A');
		$runame = htmlspecialchars($reply[$j]['user_uname']);
		$ruid = $reply[$j]['user_id'];
		$rulink = "./viewaccount.php?id=".$ruid;
		$rimg = "./assets/img/".$reply[$j]['user_img'];
		$reply_content = nl2br(htmlspecialchars($reply[$j]['reply_content']));
		?>
		<div class="reply-container pl-4 mt-1 pb-2 mb-3 border-left">
			<div class="reply-info pb-4">
				<div class="pr-3 float-left">
					<a href="<?php echo $rulink; ?>"><img class="" src="<?php echo $rimg; ?>"></a>
				</div>
				<div class="">
					<small class="">Posted <?php echo $rdate; ?></small>
					<p class="mb-0"><a href="<?php echo $rulink; ?>"><?php echo $runame; ?></a></p>
				</div>
			</div>
			<div class="reply-content">
				<?php echo $reply_content; ?>
			</div>
			<div class="reply-actions">

			</div>
		</div>
		<?php
		}
		?>
		<div id="replies">

		</div>
	</div>
<?php
}
?>
</div>
</div>
<?php
require_once('./modules/sidebar.php');
?>
</div>
</div>
<?php
require_once('./modules/footer.php');
}
?>