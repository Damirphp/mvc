<nav class="navbar navbar-default">
  	<div class="container">

    	<div class="navbar-header">
      		<a class="navbar-brand" href="#">antisocialnetwork</a>
    	</div>

    	<?php if (isset($_SESSION['user'])) { ?>

    		<ul class="nav navbar-nav navbar-right navbar-tabs">
        		
        		<li><a href="#">Profile</a></li>
        		<li><a href="#">Home</a></li>
        		<li><a href="#">Find Friend</a></li>
        		
				<li class="dropdown">
			        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
			        <ul class="dropdown-menu">
			          	<li><a href="<?php Url::link('home/logout') ?>">Log Out</a></li>
			          	<li><a href="#">View</a></li>
			          	<li><a href="#">Edit</a></li> 
			        </ul>
			    </li>

			</ul>

    	<?php } else { ?>

 			<form class="navbar-form navbar-right" action="<?php Url::link('home/login') ?>" method="POST">
			  	<div class="form-group">
			    	<input type="email" class="form-control" name="email" placeholder="E-mail" required>
			  	</div>
			  	<div class="form-group">
			    	<input type="password" class="form-control" name="password" placeholder="Password" required>
			  	</div>
				  <div class="form-group">
			    	<input type="hidden" class="form-control" name="login_token" value="<?php echo Token::generate('login') ?>">
			  	</div>
			  	<button type="submit" class="btn btn-default">Log In</button>
			</form>

		<?php } ?>

	</div>
</nav>
<div class="container">
	<div class="row">
	

