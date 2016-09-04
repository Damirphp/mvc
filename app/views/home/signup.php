<div class="col-md-5">

	<?php if(Session::exists(Config::get('session/flash_success'))) { ?>
		<div class="alert alert-success">
			<strong>Success! </strong><?php echo Session::get(Config::get('session/flash_success')) ?>
		</div>
	<?php Session::delete(Config::get('session/flash_success')); } ?>

	<h3>Sign Up</h3>
	<p>It’s free and always will be antisocial...</p>
	<hr>
	<form action="<?php Url::link('home/signup') ?>" method="POST">
	  	<div class="form-group">
	    	<label for="first_name">First name:</label>
	    	<input type="text" name="first_name" class="form-control" id="first_name" placeholder="First name..." required>
	  	</div>
	  	<div class="form-group">
	   		<label for="last_name">Last name:</label>
	    	<input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last name..." required> 
	  	</div>
	  	<div class="form-group">
	    	<label for="password">Password:</label>
	    	<input type="password" name="password" class="form-control" id="password" placeholder="Password..." required>
	  	</div>
	  	<div class="form-group">
	    	<label for="confirm_password">Confirm password:</label>
	    	<input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm password..." required>
	  	</div>
	  	<div class="form-group">
	    	<label for="email">E-mail:</label>
	    	<input type="email" name="email" class="form-control" id="email" placeholder="E-mail..." required>
	  	</div>
		<div class="form-group">
	    	<input type="hidden" name="signup_token" class="form-control" value="<?php echo Token::generate('signup') ?>">
	  	</div>
		<hr>
	  	<div class="text-left">
	  		<button type="submit" class="btn btn-default">Sign Up</button>
	  	</div>
	</form>
</div>