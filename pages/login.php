<?php
	$text = NULL;
	if(isset($_GET['callback']) && !$_GET['callback']){
			$text = INPUT_ERROR;
	}
	$username = (isset($_COOKIE['username']))? secure($_COOKIE['username']) : USERNAME;
?>

<div id="blue">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-3">
				<h3><?=LOGOUT_DESC?></h3>
			</div>
		</div><!-- /row -->
	</div> <!-- /container -->
</div><!-- /blue -->

<div class="container mtb">
	<p><?=$text?></p>
	<div class="row">
		<div class="col-lg-8">
			<form  action="" method="post" role="form">
				<h2 class="form-signin-heading"><?=SIGNIN?></h2>
				<label for="login" class="sr-only"><?=USERNAME?></label>
				<input type="text" id="login" name="login" class="form-control" placeholder="<?=$username?>" required autofocus>
				<label for="pwd" class="sr-only"><?=PASSWORD?></label>
				<input type="password" id="pwd" name="pwd" class="form-control" placeholder="<?=PASSWORD?>" required>
				<div class="spacing"></div>
				<button type="submit" class="btn btn-theme"><?=CONNECT_BUTTON?></button>
			</form>
		</div><! --/col-lg-8 -->
	</div><! --/row -->
</div><! --/container -->
