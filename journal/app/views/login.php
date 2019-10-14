<?php $data["banner-name"] = "login"; ?>

<?php include "include/head.php"; ?>
<?php include "include/nav.php"; ?>
<?php include "include/banner.php"; ?>



<div class="container login-form mt-3 mx-auto">
	
	<div class="form-container container">

		<div class="login-title text-center mt-4"><h3 class="font-weight-bold">Login</h3></div>
		<form class="login-form mt-3" id="login" action="<?php echo URLROOT;?>/users/login" method="POST">
			<div class="form-group mx-auto">
				<label class="font-weight-bold" for="fname">first name<sup>*</sup></label>
				<input type="text" id="fname" class="form-control form-control-sm <?php echo (!empty($data['fname_error'])) ? 'is-invalid' : '';?>" name="fname" value="<?php echo $data['fname'];?>">
				<span class="invalid-feedback text-uppercase text-warning"><?php echo $data["fname_error"];?></span>
			</div>
			<div class="form-group mx-auto">
				<label class="font-weight-bold" for="password">Password<sup>*</sup></label>
				<input type="password" id="password" class="form-control form-control-sm <?php echo (!empty($data['password_error'])) ? 'is-invalid' : '';?>" name="password" value="<?php echo $data['password'];?>">
				<span class="invalid-feedback text-uppercase text-warning"><?php echo $data["password_error"];?></span>
			</div>
			<div class="form-group mx-auto d-flex" style="flex-flow: column;">
				<button type="submit" class="login-button py-2 px-4 mx-auto" name="login" value="Login">Login</button>
				<span class="mt-1 text-center font-weight-bold">Don't have an account? <a class="login-register-link" href="<?php echo URLROOT;?>/users/register">Register</a></span>
			</div>
		</form>
	</div>
</div>

<?php include "include/footer.php"; ?>