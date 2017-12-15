<?php
	//Get ID and action to apply on a user	
	$action = secure($_GET['action']);
	$id = (int) secure($_GET['id']);
	

	//Define titles of the page
	$titles= array(
		'0' => "",
		'del' => DEL_USER_DESC_TEXT,
		'add' => ADD_USER_DESC_TEXT,
		'edit' => EDIT_USER_DESC_TEXT
	);

	//if a callback has been received
	if(isset($callback) && $callback != ""){
		$errorsign = "style='background-color:#c0392b;!important'";
		$errormsg = LOGIN_CHECKCHAR_FAILED;
	}else{
		$errorsign = NULL;
		$errormsg = CONFIRM_EDIT_ADD;
	}


	//If action is Edit or Add
	if($action != "del")
	{	
		if($id){
			//Load information on the user			
			$placeholder = loadConf($id, USERS);

			//Concat "value=" to all items
			$placeholder= array_map("concatValue", $placeholder);
			$placeholder['password'] = "type='hidden' ".$placeholder['password'];
		}	
		else{
			//build the placeholders items			
			$placeholder = array(
				'username' => USERNAME, 
				'password' => PASSWORD, 
				'level' => LEVEL
			);

			$placeholder= array_map("concatPlaceholder", $placeholder);
			$placeholder['password']= 'type="password" '.$placeholder['password'];
		}

		//if a user has been posted
		if(isset($_POST['post_user'])){
			echo'<div id="blue" '.$errorsign.'>
				<div class="container">
					<div class="row">
						<div class="col-lg-8 col-lg-offset-4">
							<h3>'.$errormsg.'</h3>
						</div>
					</div>
				</div>
			</div>';
			echo "<div class='container mtb'><button class='center btn btn-theme'><a href='index.php?page=admin'>".PREVIEW."</a></button></div>";
		}else{
			$title = ($action)? $titles[$action] : $titles[0];
			echo'<div id="blue" '.$errorsign.'>
				<div class="container">
					<div class="row">
						<div class="col-lg-8 col-lg-offset-4">
							<h3>'.$title.'</h3>
						</div>
					</div>
				</div>
			</div>';
		}
		 
		if(!isset($_POST['post_user']) || $errorsign){
?>	


<div class="container mtb">
	<div class="row">
		<div class="col-lg-8">
			<p><?=ADD_SUB_DESC_TEXT?></p>
			<form role="form" action="" method="post">
				<div class="form-group">
					<label for="username" class="sr-only"><?=USERNAME?></label>
					<input type="text" name="username" id="username" class="form-control" <?= $placeholder['username']?> autofocus required>
				</div>
				<div class="form-group" >
					<label for="password" class="sr-only"><?=PASSWORD?></label>
					<input name="password" id="password" class="form-control" <?= $placeholder['password']?> required>
				</div>
				<div class="form-group">
					<label for="level" class="sr-only"><?=LEVEL?></label>
					<p id="leveldesc">2= <?=MEMBER_TAG?> ; 3= <?=ADMIN_TAG?> ; 0-1= <?=NOVIEW_TAG?></p>
					<input type="number" name="level" id="level" class="form-control" <?= $placeholder['level']?> step="1" min="0" max="3" required>
				</div>
				<button class="center btn btn-theme" ><a href="index.php?page=admin"><?=PREVIEW?></a></button>
				<button type="submit" name="post_user" class="btn btn-theme"><?=SUBMIT?></button>
			</form>
		</div>
	</div> 
</div> 

	<?php
		}
	}else{ //if the action is Delete
		?>
		<div id="blue">
				<div class="container">
					<div class="row">
					<div class="col-lg-8 col-lg-offset-4">
						<h3><?= $titles['del']?></h3>
					</div>
				</div>
			</div>
		</div><?php

	if(isset($_POST['post_del_user'])){
			echo "<div class='container mtb'><p>".CONFIRM_DEL_U."</p>
			<button class='center btn btn-theme'><a href='index.php?page=admin'>".PREVIEW."</a></button></div>";
		}else{		
		?>
		

		<form class="form-signin container mtb" action="" method="post">
			<button class="center btn btn-theme" ><a href="index.php?page=admin"><?=PREVIEW?></a></button>
			<input type="submit" name= "post_del_user" class="center btn btn-theme" value="<?=DEL_BUTTON?>" />
		</form>
		<?php
	}}
	?>
