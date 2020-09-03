<?php
require_once('./modules/header.php');
if((isset($_GET['id']) && !ctype_digit($_GET['id'])) || !isset($_SESSION['user_id'])) {
	header('Location: ./home.php'); exit();
} else if(isset($_GET['id']) && ctype_digit($_GET['id'])) {
	$uid = $_GET['id'];
}
if(!isset($uid)) {
	$uid = $_SESSION['user_id'];
}
$posts = getUserPosts($conn, $uid);
$_SESSION['last_page'] = $FILE.".php";
// var_dump($posts);
?>
<div class="container">
<div class="row px-3">
<?php
require_once('./modules/user-sidebar.php');
?>
<div class="col-12 col-md-8 pt-3">
<?php
if(isset($_GET['edit']) && $uid == $_SESSION['user_id']) {
	$_SESSION['last_page'] = $FILE.".php?edit";
?>
	<div class="forum-header">
		<div class="row py-1 stylish-color-dark text-white">
			<div class="col-12">
				<small><b>Edit Account</b></small>
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
	<form method="post" action="./config/update.php">
	<div class="edit-fields pt-3">
		<div class="row px-3">
			<small><b>Edit Password</b></small>
		</div>
		<div class="row px-md-3">
			<div class="col-12">
				<input class="form-control mt-3 rounded-0" type="password" name="user_pwd0" placeholder="New Password">
				<input class="form-control mt-3 rounded-0" type="password" name="user_pwd1" placeholder="Confirm Password">
				<button class="btn btn-update btn-sm z-depth-0 ml-0 mt-3" type="submit" name="update" value="password">Update</button>
			</div>
		</div>
	</div>
	<div class="edit-fields pt-3">
		<div class="row px-3">
			<small><b>Edit Info</b></small>
		</div>
		<div class="row px-md-3">
			<div class="col-12">
				<input class="form-control mt-3 rounded-0" type="text" name="info_gender" placeholder="Gender" value="<?php echo ($gender != 'N/A') ? $gender : ''; ?>">
				<input class="form-control mt-3 rounded-0" type="date" name="info_bdate" value="<?php $bdayval = date_format($bdate, "Y-m-d"); echo $bdayval; ?>">
				<button class="btn btn-update btn-sm z-depth-0 ml-0 mt-3" type="submit" name="update" value="info">Update</button>
			</div>
		</div>
	</div>
	<div class="edit-fields pt-3">
		<div class="row px-3">
			<small><b>Edit Bio</b></small>
		</div>
		<div class="row px-md-3">
			<div class="col-12">
				<textarea id="info-bio" class="form-control mt-3 rounded-0" name="bio" rows="6" placeholder="A little about yourself..."><?php echo ($bio != 'N/A') ? $bio : ''; ?></textarea>
				<div id="bio-msg">
					<span>&nbsp;</span>
				</div>
				<button class="btn btn-update btn-sm z-depth-0 ml-0 mt-3" type="submit" name="update" value="bio">Update</button>
			</div>
		</div>
	</div>
	</form>
<?php
} else {
?>
	<div class="forum-header">
		<div class="row py-1 stylish-color-dark text-white">
			<div class="col-12">
				<small><b>Activity</b></small>
			</div>
		</div>
	</div>
	<div class="user-activity pt-3">
	<?php
	for($i = 0; $i < count($posts); $i++) {
	$title = "<a href='./viewthread.php?id=".$posts[$i]['thread_id']."'>".htmlspecialchars($posts[$i]['thread_title'])."</a>";
	$pdate = date_create($posts[$i]['post_date']);
	$content = htmlspecialchars($posts[$i]['post_content']);
	$date = date_format($pdate, "M d, Y h:i A");
	$topic = "<a href='./viewtopic.php?id=".$posts[$i]['top_id']."'>".$posts[$i]['top_name']."</a>";
	?>
		<div class="row pb-3">
			<div class="col-12">
				<h6 class="mb-1"><u><?php echo $title; ?></u></h6>
				<p class="my-0 py-0">
					<?php echo $content; ?>
				</p>
				<small>Posted <?php echo $date." on ".$topic; ?></small>
			</div>
		</div>
	<?php
	}
	?>
	</div>
</div>
<?php
}
?>
</div>
</div>
<?php
require_once('./modules/footer.php');
?>