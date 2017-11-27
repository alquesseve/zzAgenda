<div id="blue">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-4">
				<h3>Manage your conference</h3>
			</div>
		</div>
	</div>
</div>
<div class="w-80 m-auto">
  	<div class="container">
     		<h2>Administration</h2>
		<div class="spacing"></div>
      		<span class="float-right"><a href="index.php?page=add">+Add</a></span>
   		<table class="table table-striped">
		<tr>
			<th>Title</th>
	      		<th>Location</th>
	      		<th>Speaker</th>
	      		<th>Hour</th>
	      		<th>Description</th>
	      		<th>Action</th>
	      	</tr>
	      
	      			<?php
						$confs = getJSON(CONFERENCES);

						if($confs){
							foreach($confs as $conf){
								echo '
									<tr>
					      				<td>'.$conf['titre'].'</td>
					      				<td>'.$conf['lieu'].'</td>
					      				<td>'.$conf['speaker'].'</td>
					      				<td>'.$conf['datetime'].'</td>
					      				<td>'.$conf['description'].'</td>
					      				<td>
											<a href="index.php?page=add&action=edit&id='.$conf['id'].'" title ="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
											<a href="index.php?page=add&action=del&id='.$conf['id'].'" title ="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
										</td>
					      			</tr>
								';
							}
						}
						else {
							echo "Aucune conférence n'est disponible";
						}

				?>
	      		</table>
	  	</div>
		</div>