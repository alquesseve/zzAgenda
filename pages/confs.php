<?php
	//Get ID and action to apply on a conference	
	$action = secure($_GET['action']);
	$id = (int) secure($_GET['id']);
	
	//Define page titles
	$titles= array(
		'0' => "Titre défaut",
		'del' => DEL_DESC_TEXT,
		'add' => ADD_DESC_TEXT,
		'edit' => EDIT_DESC_TEXT
	);

	$title = ($action)? $titles[$action] : $titles[0];

	//Display title	
	echo'<div id="blue">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-4">
					<h3>'.$title.'</h3>
				</div>
			</div>
		</div>
	</div>';
	
	//Action is Edit or Add
	if($action != "del")
	{	
		if($id){
			//load informations of the conference			
			$placeholder = loadConf($id);

			$datetime= formatDate($placeholder['datetime']);
			$placeholder['date'] = $datetime['date'];
			$placeholder['heure'] = $datetime['heure'];
			
			//save description
			$tmp = $placeholder['description'];

			//Add "value=" to all items
			$placeholder= array_map("concatValue", $placeholder);

			//Restore description
			$placeholder['description']= $tmp;
		}	
		else{
			//Define the placeholders for the form's fields			
			$placeholder = array(
				'titre' => TITLE, 
				'description' => DESCRIPTION, 
				'lieu' => PLACE, 
				'speaker' => SPEAKER, 
				'date'=> DATE, 
				'heure' => HOUR
			);
			
			//Concat "placeholder=" to all items
			$placeholder= array_map("concatPlaceholder", $placeholder);

			//Rebuild description
			$placeholder['description'] = "<h1>".DESCRIPTION."</h1><p>".DESCRIPTION."</p>";
		}

		//if a conf has been posted
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
					<div class="toolbar">
						<div class="fore-wrapper"><i class='fa fa-font' style='color:#C96;'></i>
							<div class="fore-palette">
							</div>
						</div>
						<div class="back-wrapper"><i class='fa fa-font' style='background:#C96;'></i>
					 		<div class="back-palette">
							</div>
					  	</div>
					  	<a href="#" data-command='bold'><i class='fa fa-bold'></i></a>
						  <a href="#" data-command='italic'><i class='fa fa-italic'></i></a>
						  <a href="#" data-command='underline'><i class='fa fa-underline'></i></a>
						  <a href="#" data-command='strikeThrough'><i class='fa fa-strikethrough'></i></a>
						  <a href="#" data-command='h1'>H1</a>
						  <a href="#" data-command='h2'>H2</a>
						  <a href="#" data-command='createlink'><i class='fa fa-link'></i></a>
						  <a href="#" data-command='unlink'><i class='fa fa-unlink'></i></a>
					</div>
					<div id='editor' contenteditable="true">
						<?=$placeholder['description']?>
					</div>	
					<input id="desc" name="description" type="hidden" value=""/> 					
				</div>
				<button type="submit" onclick="copyDesc()" name="post_conf" class="btn btn-theme"><?=SUBMIT?></button>
			</form>
		</div> <!--COL-LG-8 -->
	</div> <!--ROW -->
</div> <!--CONTAINER -->

	<?php
		}
	}else{ //if the action is Delete
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
