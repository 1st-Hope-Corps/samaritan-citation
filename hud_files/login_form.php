<div class="mobile-content-wrapper" style="display: block;">
	<div style="text-align:center;">
		<span style="font-size: 2rem;">Welcome!</span>
	</div>
	<?php

	if (isset($_SESSION['login_error'])) {
		?>
		<div style="color: #ffffff;font-size:1rem;margin-top: 15px;background-color: #f75050;padding: 10px;text-align: center;font-weight: bold;">Error: You entered incorrect credentials.</div>
		<?php
		unset($_SESSION['login_error']);
	}


	?>
	<form action="<?php echo $sCurrPage; ?>user?page=home" method="post" onsubmit="return validateLogin(this);" style="margin-top: 20px;padding: 20px;text-align: center;">
		<div class="form-control">
			<input type="text" name="name" onfocus="if (this.value == 'Username') this.value = '';" placeholder="Username" />
		</div>
		<div class="form-control">
			<input type="password" name="pass" onfocus="if (this.value == 'Password') this.value = '';" placeholder="Password" />
		</div>
		<div class="form-action">
			<input type="hidden" name="form_id" id="edit-user-login" value="user_login" />
	        <input type="submit" name="op" value="Log in" class="btnuser" /> 
		</div>
	</form>
</div>
