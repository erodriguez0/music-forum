<div class="col-12 col-md-4 sidebar pt-3 px-0">
<?php
if(!$LOGGED_IN && $FILE != 'login') {
?>
<div class="row">
<div class="col-12">
<div class="table-header px-3">
<div class="row py-1 stylish-color-dark d-none d-md-block text-white">
	<div class="col-12">
		<small><b>Login</b></small>
	</div>
</div>
<div class="pt-md-3 sidebar-block d-none d-md-block pb-3 mx-auto">
	<form class="" method="post" action="./config/login.php">
		<input class="form-control rounded-0" type="text" placeholder="Username" name="user_uname">
		<input class="form-control rounded-0 mt-4" type="password" placeholder="Password" name="user_pwd">
		<button class="btn btn-sm btn-block mt-4 z-depth-0" type="submit" name="login">Login</button>
	</form>
	<div class="sign-up text-center pt-3">
		<span><i class="fas fa-exclamation-circle pr-2"></i>Don't have an account?
		<br>
		<a href="./signup.php">Sign Up!</a></span>
	</div>
</div>
</div>
</div>
</div>
<?php
}
$recent = getRecentThreads($conn);
?>
<div class="px-3">
<div class="table-header">
<div class="row py-1 stylish-color-dark text-white">
	<div class="col-12">
		<small><b>Recent Threads</b></small>
	</div>
</div>
<div class="recent-table pt-2">
<?php
for($i = 0; $i < count($recent); $i++) {
$title = htmlspecialchars($recent[$i]['thread_title']);
$content = htmlspecialchars($recent[$i]['thread_content']);
$tdate = date_create($recent[$i]['thread_date']);
$date = date_format($tdate, "M d \a\\t h:i A");
$uname = htmlspecialchars($recent[$i]['user_uname']);
$forum = htmlspecialchars($recent[$i]['top_name']);
$forum_link = "./viewtopic.php?id=".$recent[$i]['top_id'];
$thread_link = "<a href='./viewthread.php?id=".$recent[$i]['thread_id']."'>";
$user_link = "./viewaccount.php?id=".$recent[$i]['user_id'];
?>
<div class="row py-1">
	<div class="col-12 px-md-3">
		<div class="recent-title">
			<small class="top-title"><b><u><a href="<?php echo $link; ?>"><?php echo $thread_link.$title."</a>"; ?></a></u></b></small>
		</div>
<!-- 		<div class="recent-content">
			<small><?php //echo $content; ?></small>
		</div> -->
		<div class="recent-info">
			<small class="thread-info">Posted by <?php echo "<a href='".$user_link."'>".$uname."</a> at ".$date." in <a href='".$forum_link."'>".$forum."</a>"; ?></small>
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