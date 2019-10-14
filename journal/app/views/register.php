	
<?php include "include/head.php"; ?>
<?php include "include/nav.php"; ?>
<?php include "include/banner.php"; ?>

	<div class="form-container container">
		<div class="register-title text-center"><h3 class="font-weight-bold">Register</h3></div>
		<form id="register" class="register-form" action="<?php echo URLROOT;?>/users/register" method="POST">
			<div class="form-group mx-auto">
				<label class="font-weight-bold" for="fname">First Name<sup>*</sup></label>
				<input id="fname" type="text" class="form-control form-control-sm <?php echo (!empty($data['fname_error'])) ? 'is-invalid' : '';?>" name="fname" value="<?php echo $data['fname'];?>">
				<span class="invalid-feedback"><?php echo $data["fname_error"];?></span>
			</div>

			<div class="form-group mx-auto">
				<label class="font-weight-bold" for="lname">Last Name<sup>*</sup></label>
				<input id="lname" type="text" class="form-control form-control-sm <?php echo (!empty($data['lname_error'])) ? 'is-invalid' : '';?>" name="lname" value="<?php echo $data['lname'];?>">
				<span class="invalid-feedback"><?php echo $data["lname_error"];?></span>
			</div>

			<div class="form-group mx-auto">
				<label class="font-weight-bold" for="password">Password<sup>*</sup></label>
				<input type="password" id="password" class="form-control form-control-sm <?php echo (!empty($data['password_error'])) ? 'is-invalid' : '';?>" name="password" value="<?php echo $data['password'];?>">
				<span class="invalid-feedback"><?php echo $data["password_error"];?></span>
			</div>

			<div class="form-group mx-auto">
				<label class="font-weight-bold" for="confirm_password">Confirm Password<sup>*</sup></label>
				<input type="password" id="confirm_password" class="form-control form-control-sm <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : '';?>" name="confirm_password" value="<?php echo $data['confirm_password'];?>">
				<span class="invalid-feedback"><?php echo $data["confirm_password_error"];?></span>
			</div>

			<div class="form-group mx-auto">
				<label class="font-weight-bold" for="permission">Status</label>
				<input type="text" id="permission" class="form-control form-control-sm" name="permission" value="<?php echo $data['permission'];?>">
			</div>

			<div class="form-group mx-auto d-flex" style="flex-flow: column;">
				<button type="submit" class="register-button py-2 px-4 mx-auto" name="register" value="Register">Register</button>
				<span class="mt-1 text-center font-weight-bold">Already have an account? <a href="<?php echo URLROOT;?>/users/login">Login</a></span>
			</div>
		</form>
	</div>
</div>


<?php include "include/footer.php"; ?>