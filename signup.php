<?php
if($LOGGED_IN) {
	header('Location: ./home.php'); exit();
} else {
require_once('./modules/header.php');
if(isset($_SESSION['values'])) {
	$email = (isset($_SESSION['values']['email'])) ? htmlspecialchars($_SESSION['values']['email']) : '';
	$uname = (isset($_SESSION['values']['username'])) ? htmlspecialchars($_SESSION['values']['username']) : '';
	$fname = (isset($_SESSION['values']['fname'])) ? htmlspecialchars($_SESSION['values']['fname']) : '';
	$lname = (isset($_SESSION['values']['lname'])) ? htmlspecialchars($_SESSION['values']['lname']) : '';
}
?> 
<div class="container">
<div class="row">
<div class="col-12 col-md-8">
	<div class="table-header pt-3">
		<div class="row py-1 stylish-color-dark text-white">
			<div class="col-12">
				<small><b>Sign Up</b></small>
			</div>
		</div>
	</div>
	<div class="sign-up-form mx-auto pt-3">
		<form method="post" action="./config/signup.php">
			<input class="form-control mb-4 rounded-0" type="text" placeholder="Email" name="email" value="<?php echo $email; ?>">
			<input class="form-control mb-4 rounded-0" type="text" placeholder="Username" name="username" value="<?php echo $uname; ?>">
			<input class="form-control mb-4 rounded-0" type="text" placeholder="First Name" name="fname" value="<?php echo $fname; ?>">
			<input class="form-control mb-4 rounded-0" type="text" placeholder="Last Name" name="lname" value="<?php echo $lname; ?>">
			<input class="form-control mb-4 rounded-0" type="password" placeholder="Create Password" name="pass0">
			<input class="form-control mb-3 rounded-0" type="password" placeholder="Confirm Password" name="pass1">
			<button class="btn btn-update btn-md z-depth-0 ml-0" type="submit" value="password" name="signup">Sign Up</button>
		</form>
	<?php
	if(isset($_SESSION['error'])) {
	?>
	<div class="error text-danger pt-3">
		<span>
			<?php
			echo nl2br(htmlspecialchars($_SESSION['error']));
			unset($_SESSION['error']);
			unset($_SESSION['values']);
			?>
		</span>
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