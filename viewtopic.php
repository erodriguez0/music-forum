<?php
if(!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
	header('Location: ./home.php'); exit();
} else {
$tid = $_GET['id'];
require_once('./modules/header.php');
$_SESSION['last_page'] = "viewtopic.php?id=".$tid;
$topic = getTopicInfo($conn, $tid);
$top_name = htmlspecialchars($topic[0]['top_name']);
$top_link = "<a href='./viewtopic.php?id=".$topic[0]['top_id']."'>".$top_name."</a>";
if(isset($_SESSION['values'])) {
	$title = (isset($_SESSION['values']['title'])) ? htmlspecialchars($_SESSION['values']['title']) : '';
	$content = (isset($_SESSION['values']['content'])) ? htmlspecialchars($_SESSION['values']['content']) : '';
}
?>
<div class="container">
<div class="row">
<div class="col-12 col-md-8 pt-3">
<div class="forum-header pb-3">
<div class="row py-1 stylish-color-dark text-white">
	<div class="col-12">
		<small><b><a href="./home.php">Home</a> > <?php echo $top_link; ?></b></small>
	</div>
</div>
<div class="row pt-3">
<div class="col-12">
<?php
	if(($LOGGED_IN && $tid != 2) || $LEVEL > 2) {
?>
	<div class="new-thread-block">
		<button id="new-thread" type="button" class="btn btn-sm mb-3 px-3 ml-0 z-depth-0 btn-update"><i class="fas fa-plus"></i> New Thread</button>
		<div id="new-thread-form">
		<form class="" method="post" action="./config/thread.php">
			<textarea rows="2" class="w-100 mx-auto form-control mb-3 rounded-0" placeholder="Title" name="title"><?php echo $title; ?></textarea>
			<textarea rows="8" class="w-100 mx-auto form-control rounded-0" placeholder="Content" name="content"><?php echo $content; ?></textarea>
			<button type="submit" class="btn btn-update btn-sm mt-3 mb-3 px-3 ml-0 z-depth-0" name="new-thread" value="<?php echo $tid; ?>">Submit</button>
		</form>
		</div>
	</div>
<?php
unset($_SESSION['values']);
	}
$threads = getThreads($conn, $tid);
for($i = 0; $i < count($threads); $i++) {
$title = htmlspecialchars($threads[$i]['thread_title']);
$tdate = date_create($threads[$i]['thread_date']);
$uname = htmlspecialchars($threads[$i]['user_uname']);
$date = date_format($tdate, "M d, Y H:i A");
$thread_link = "<a href='./viewthread.php?id=".$threads[$i]['thread_id']."'>";
$user_link = "<a href='./viewaccount.php?id=".$threads[$i]['user_id']."'>";
?>
	<div class="thread-table text-dark">
		<div class="row pb-2">
			<div class="col-12">
				<span class="d-block top-title"><b><?php echo $thread_link.$title."</a>"; ?></b></span>
				<small class="thread-info">Posted by <?php echo $user_link.$uname."</a> on ".$date; ?></small>
			</div>
		</div>
	</div>
<?php
}
?>
</div>
</div>
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