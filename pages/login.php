<?php
	//Default callback return value	
	$text = NULL;
	$errorsign = NULL;

	//if a callback has been received
	if(isset($_GET['callback']) && !empty($_GET['callback'])){
			$text = INPUT_ERROR;
			$errorsign = "style='background-color:#c0392b;!important'";
	}

	//Get cookie information if exists
	$username = (isset($_COOKIE['username']))? "value=".secure($_COOKIE['username']) : USERNAME;
?>

<div id="blue" <?=$errorsign?>>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-3">
				<h3><?=(isset($_GET['callback']) && ($_GET['callback'] =="LOGIN_CHECKCHAR_FAILED"))? LOGIN_CHECKCHAR_FAILED : LOGOUT_DESC?></h3>
			</div>
		</div>
	</div> 
</div>

<div class="container mtb">
	<p><?=$text?></p>
	<div class="row">
		<div class="col-lg-8">
			<form  action="" method="post" role="form">
				<h2 class="form-signin-heading"><?=SIGNIN?></h2>
				<label for="login" class="sr-only"><?=USERNAME?></label>
				<input type="text" id="login" name="login" class="form-control" placeholder="<?=USERNAME?>" <?=$username?> required autofocus>
				<label for="pwd" class="sr-only"><?=PASSWORD?></label>
				<input type="password" id="pwd" name="pwd" class="form-control" placeholder="<?=PASSWORD?>" required>
				<div class="spacing"></div>
				<button type="submit" class="btn btn-theme"><?=CONNECT_BUTTON?></button>
			</form>
		</div>
	</div>
</div>
