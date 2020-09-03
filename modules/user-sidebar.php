<?php
$user = getUserInfo($conn, $uid);
$img = $user['user_img'];
$uname = htmlspecialchars($user['user_uname']);
$fname = htmlspecialchars($user['user_fname']);
$lname = htmlspecialchars($user['user_lname']);
$gender = (isset($user['info_gender'])) ? htmlspecialchars($user['info_gender']) : 'N/A';
if(isset($user['info_bday'])) {
$bdate = date_create($user['info_bday']);
$bday = date_format($bdate, "M d");
} else {
	$bday = 'N/A';
}
$bio = (isset($user['info_bio'])) ? htmlspecialchars($user['info_bio']) : 'N/A';
$isUserPro = ($_SESSION['user_id'] == $uid) ? true : false;
?>
<div class="col-12 col-md-4 sidebar pt-3 px-0">
<div class="row">
<div class="col-12">
<div class="table-header px-3">
<div class="row py-1 stylish-color-dark text-white">
	<div class="col-12">
		<small><b>Profile</b></small>
	</div>
</div>
<!-- ./ROW -->
</div>
<div class="profile px-3">
<!-- ./TABLE HEADER -->
	<div class="pro-img-frame d-flex justify-content-center align-items-middle mx-auto my-3">
	<div class="pro-img">
		<img src="./assets/img/<?php echo $img; ?>">
	</div>
	</div>
	<?php
	if($isUserPro) {
	?>
	<div class="pt-2">
	<form method="post" action="./config/update.php" enctype="multipart/form-data">
		<label class="fileInput ml-0 btn btn-sm custom-file-button z-depth-0 py-2 px-4">Browse
		<input class="mx-auto btn z-depth-0 p-2" type="file" accept="image/jpeg, image/png" name="userfile">
		</label>
		<button class="btn btn-block btn-sm z-depth-0" type="submit" name="update-pic">Update Picture</button>
	</form>
	</div>
	<?php
	}
	?>
	<div class="pro-user pt-3">
		<h4><?php echo $fname." ".$lname; ?></h4>
		<h5>@<?php echo $uname; ?></h5>
	</div>
	<div class="pro-details pt-3">
		<?php
		if(!isset($_GET['edit']) && $isUserPro) {
		?>
		<a class="btn btn-sm z-depth-0 ml-0" href="./viewaccount.php?edit"><i class="far fa-edit pr-2"></i> Edit</a>
		<?php
		}
		?>
		<div class="row">
			<div class="col-4">
				<small>Gender:</small>
			</div>
			<div class="col-8 text-right">
				<small><?php echo $gender; ?></small>
			</div>
		</div>
		<div class="row">
			<div class="col-4">
				<small>Birthday:</small>
			</div>
			<div class="col-8 text-right">
				<small><?php echo $bday; ?></small>
			</div>
		</div>
	</div>
</div>
<div class="table-header pt-3 px-3">
<div class="row py-1 stylish-color-dark text-white">
	<div class="col-12">
		<small><b>Bio</b></small>
	</div>
</div>
<div class="row pt-3">
<div class="col-12">
<?php echo $bio; ?>
</div>
</div>
<!-- ./ROW -->
</div>
</div>
<!-- ./INNER COL -->
</div>
<!-- ./ROW -->
</div>
<!-- ./COL -->