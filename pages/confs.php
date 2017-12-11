<?php
	$action = secure($_GET['action']);
	$id = (int) secure($_GET['id']);
	
	$titles= array(
		'0' => "Titre défaut",
		'del' => DEL_DESC_TEXT,
		'add' => ADD_DESC_TEXT,
		'edit' => EDIT_DESC_TEXT
	);

	$title = ($action)? $titles[$action] : $titles[0];
	echo'<div id="blue">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-4">
					<h3>'.$title.'</h3>
				</div>
			</div>
		</div>
	</div>';

	if($action != "del")
	{	
		if($id){
			$placeholder = loadConf($id);
			$datetime= formatDate($placeholder['datetime']);
			$placeholder['date'] = $datetime['date'];
			$placeholder['heure'] = $datetime['heure'];

			$placeholder= array_map("concatValue", $placeholder);
		}	
		else{
			$placeholder = array(
				'titre' => TITLE, 
				'description' => DESCRIPTION, 
				'lieu' => PLACE, 
				'speaker' => SPEAKER, 
				'date'=> DATE, 
				'heure' => HOUR
			);
			$placeholder= array_map("concatPlaceholder", $placeholder);
		}

		if(isset($_POST['post_conf'])){
		echo'
				<p>'.(isset($callback) && $callback == "")? CONFIRM_EDIT_ADD : DATA_CHARCHECK_FAILED.'</p>
			';
		}else{
?>	


<div class="container mtb">
	<div class="row">
		<div class="col-lg-8">
			<p><?=ADD_SUB_DESC_TEXT?></p>
			<form role="form" action="" method="post">
				<div class="form-group">
					<label for="speaker" class="sr-only"><?=SPEAKER?></label>
					<input type="text" name="speaker" id="speaker" class="form-control" <?= $placeholder['speaker']?> required>
				</div>
				<div class="form-group">
					<label for="title" class="sr-only"><?=TITLE?></label>
					<input type="text" name="title" id="title" class="form-control" <?= $placeholder['titre']?> required autofocus>
				</div>
				<div class="form-group">
					<label for="place" class="sr-only"><?=PLACE?></label>
					<input type="text" name="place" id="place" class="form-control" <?= $placeholder['lieu']?> required>
				</div>
				<div class="form-group">
					<label for="date" class="sr-only"><?=DATE?></label>
					<input type="date" name="date" id="date" class="form-control" <?= $placeholder['date']?> required>
				</div>
				<div class="form-group">
					<label for="hour" class="sr-only"><?=HOUR?></label>
					<input type="time" name="hour" id="hour" class="form-control" <?= $placeholder['heure']?> required>
				</div>
				<div class="form-group">
					<label for="desc" class="sr-only"><?=DESCRIPTION?></label>
					<textarea id="desc" name="description" class="form-control" <?= $placeholder['description']?> required></textarea>
				</div>
				<button type="submit" name="post_conf" class="btn btn-theme"><?=SUBMIT?></button>
			</form>
		</div> <!--COL-LG-8 -->
	</div> <!--ROW -->
</div> <!--CONTAINER -->

	<?php
		}
	}else{
		if(isset($_POST['post_del'])){
			echo "<p>".CONFIRM_DEL."</p>";
		}else{		
		?>
		<form class="form-signin" action="" method="post">
			<input type="submit" name= "post_del" value="<?=DEL_BUTTON?>" />
		</form>
		<?php
	}}
	?>
