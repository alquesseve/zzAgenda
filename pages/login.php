<?php
	$text = NULL;
	if(isset($_GET['callback']) && !$_GET['callback']){
			$text = "Les données saisies ne sont pas valides";
	}
?>

<div id="blue">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-3">
				<h3>Connect to add conferences</h3>
			</div>
		</div><!-- /row -->
	</div> <!-- /container -->
</div><!-- /blue -->

<div class="container mtb">
	<p><?=$text?></p>
	<div class="row">
		<div class="col-lg-8">
			<form  action="" method="post" role="form">
				<h2 class="form-signin-heading">Sign in</h2>
				<label for="login" class="sr-only">Login</label>
				<input type="text" id="login" name="login" class="form-control" placeholder="Login" required autofocus>
				<label for="pwd" class="sr-only">Password</label>
				<input type="password" id="pwd" name="pwd" class="form-control" placeholder="Password" required>
				<div class="spacing"></div>
				<button type="submit" class="btn btn-theme">Connect</button>
			</form>
		</div><! --/col-lg-8 -->
	</div><! --/row -->
</div><! --/container -->
