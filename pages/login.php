	   <?php
	   $text = NULL;
	   	if(isset($_GET['callback']) && !$_GET['callback']){
	   		$text = "Les données saisies ne sont pas valides";
	   	}
	   ?>

	    <div class="w-50 m-auto">
		  <p><?=$text?></p>
	      	<form class="form-signin" action="" method="post">
				<h2 class="form-signin-heading">Sign in</h2>
				<label for="login" class="sr-only">Login</label>
				<input type="text" id="login" name="login" class="form-control" placeholder="Login" required autofocus>
				<label for="pwd" class="sr-only">Password</label>
				<input type="password" id="pwd" name="pwd" class="form-control" placeholder="Password" required>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			</form>
	  	</div>
	</div>