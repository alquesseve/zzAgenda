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


	<div class="w-50 m-auto">
	      	<form class="form-signin" action="" method="post">
	      		<span><a href="index.php?page=admin">Retour</a></span>
	        <h2 class="form-signin-heading">Ajouter une conférence</h2>

	        <label for="title" class="sr-only">Titre</label>
	        <input type="text" name="title" id="title" class="form-control" placeholder="<?= $placeholder['titre']?>" required autofocus>
	        <label for="desc" class="sr-only">Description</label>
	        <textarea id="desc" name="description" class="form-control" placeholder="<?= $placeholder['description']?>" required></textarea>
	        <label for="place" class="sr-only">Lieu</label>
	        <input type="text" name="place" id="place" class="form-control" placeholder="<?= $placeholder['lieu']?>" required>
	        <label for="speaker" class="sr-only">Speaker</label>
	        <input type="text" name="speaker" id="speaker" class="form-control" placeholder="<?= $placeholder['speaker']?>" required>
	        <label for="date" class="sr-only"><?= $placeholder['date']?></label>
	        <input type="date" name="date" id="date" class="form-control" placeholder="" required>
	        <label for="hour" class="sr-only"><?= $placeholder['heure']?></label>
	        <input type="time" name="hour" id="hour" class="form-control" placeholder="" required>
	        <button class="btn btn-lg btn-primary btn-block" name="post_conf" type="submit">Ajouter</button>
	      </form>
	  	</div>
	</div>
	<?php
	}else{
		?>
		<form class="form-signin" action="" method="post">
			<input type="submit" name= "post_del" value="Supprimer" />
		</form>
		<?php
	}
	?>
