	      <div class="w-50 m-auto">
	      	<form class="form-signin" action="" method="post">
	      		<span><a href="index.php?page=admin">Retour</a></span>
	        <h2 class="form-signin-heading">Ajouter une conférence</h2>

	        <label for="title" class="sr-only">Titre</label>
	        <input type="text" name="title" id="title" class="form-control" placeholder="Titre" required autofocus>
	        <label for="desc" class="sr-only">Description</label>
	        <textarea id="desc" name="description" class="form-control" placeholder="Description" required></textarea>
	        <label for="place" class="sr-only">Lieu</label>
	        <input type="text" name="place" id="place" class="form-control" placeholder="Lieu" required>
	        <label for="speaker" class="sr-only">Speaker</label>
	        <input type="text" name="speaker" id="speaker" class="form-control" placeholder="Speaker" required>
	        <label for="date" class="sr-only">Date</label>
	        <input type="date" name="date" id="date" class="form-control" placeholder="Date" required>
	        <label for="hour" class="sr-only">Heure</label>
	        <input type="time" name="hour" id="hour" class="form-control" placeholder="Heure" required>
	        <button class="btn btn-lg btn-primary btn-block" name="post_conf" type="submit">Ajouter</button>
	      </form>
	  	</div>
	</div>
