<?php
	$action = secure($_GET['action']);
	$id = (int) secure($_GET['id']);
	
	if($action != "del")
	{	
		if($id){
			$placeholder = loadConf($id);
			$datetime= formatDate($placeholder['datetime']);
			$placeholder['date'] = $datetime['date'];
			$placeholder['heure'] = $datetime['heure'];
		}	
		else{
			$placeholder = array(
				'titre' => "Titre", 
				'description' => "Description", 
				'lieu' => "Lieu", 
				'speaker' => "Speaker", 
				'date'=> "Date", 
				'heure' => "Heure"
			);
		}
?>	

<div id="blue">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-4">
				<h3>Add your conference</h3>
			</div>
		</div>
	</div>
</div>
<div class="container mtb">
	<div class="row">
		<div class="col-lg-8">
			<h4>Add your conference !</h4>
			<div class="hline"></div>
			<p>Complete the following fields to add your conference</p>
			<form role="form">
				<div class="form-group">
					<label for="speaker" class="sr-only">Speaker</label>
					<input type="text" name="speaker" id="speaker" class="form-control" placeholder="<?= $placeholder['speaker']?>" required>
				</div>
				<div class="form-group">
					<label for="title" class="sr-only">Titre</label>
					<input type="text" name="title" id="title" class="form-control" placeholder="<?= $placeholder['titre']?>" required autofocus>
				</div>
				<div class="form-group">
					<label for="place" class="sr-only">Lieu</label>
					<input type="text" name="place" id="place" class="form-control" placeholder="<?= $placeholder['lieu']?>" required>
				</div>
				<div class="form-group">
					<label for="date" class="sr-only">Date</label>
					<input type="date" name="date" id="date" class="form-control" placeholder="<?= $placeholder['date']?>" required>
				</div>
				<div class="form-group">
					<label for="hour" class="sr-only">Heure</label>
					<input type="time" name="hour" id="hour" class="form-control" placeholder="<?= $placeholder['heure']?>" required>
				</div>
				<div class="form-group">
					<label for="desc" class="sr-only">Description</label>
					<textarea id="desc" name="description" class="form-control" placeholder="<?= $placeholder['description']?>" required></textarea>
				</div>
				<button type="submit" name="post_conf" class="btn btn-theme">Submit</button>
			</form>
		</div> <!--COL-LG-8 -->
	</div> <!--ROW -->
</div> <!--CONTAINER -->

	<?php
	}else{
		?>
		<form class="form-signin" action="" method="post">
			<input type="submit" name= "post_del" value="Supprimer" />
		</form>
		<?php
	}
	?>