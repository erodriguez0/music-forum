<?php
require_once('./modules/header.php');
$cat = getCategories($conn);
// $_SESSION['last_page'] = $FILE.".php";
?>
<div class="container">
<div class="row">
<div class="col-12 col-md-8">
	<div class="table-header my-3">
	<div class="row py-1 stylish-color-dark text-white">
		<div class="col-12">
			<small><b>Login</b></small>
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
	$user = (isset($_SESSION['values']['user_uname'])) ? htmlspecialchars($_SESSION['values']['user_uname']) : '';
	?>

	<div class="login-form mx-auto pt-1">
	<form class="" method="post" action="./config/login.php">
		<input class="form-control rounded-0" type="text" placeholder="Username" name="user_uname" value="<?php echo $user; ?>">
		<input class="form-control rounded-0 mt-4" type="password" placeholder="Password" name="user_pwd">
		<button class="btn btn-sm btn-block mt-4 z-depth-0" type="submit" name="login">Login</button>
	</form>
	</div>
</div>
<?php
require_once('./modules/sidebar.php');
?>
</div>
</div>
<?php
require_once('./modules/footer.php');
?>