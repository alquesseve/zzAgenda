<div id="blue">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-4">
				<h3><?=ADMIN_DESC_TEXT?></h3>
			</div>
		</div>
	</div>
</div>
<div class="w-80 m-auto">
  	<div class="container">
     		<h2><?=ADMIN?></h2>
		<div class="spacing"></div>
      		<span class="float-right"><a href="index.php?page=confs&action=add">+<?=ADD?></a></span>
   		<table class="table table-striped">
		<tr>
			<th><?=TITLE?></th>
	      		<th><?=PLACE?></th>
	      		<th><?=SPEAKER?></th>
	      		<th><?=HOUR?></th>
	      		<th><?=DESCRIPTION?></th>
	      		<th><?=ACTION?></th>
	      	</tr>
	      
	      			<?php
						//Get conferences list						
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
											<a href="index.php?page=confs&action=edit&id='.$conf['id'].'" title ="'.EDIT_BUTTON.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
											<a href="index.php?page=confs&action=del&id='.$conf['id'].'" title ="'.DEL_BUTTON.'"><i class="fa fa-trash" aria-hidden="true"></i></a>
										</td>
					      			</tr>
								';
							}
						}
						else {
							echo NO_CONF;
						}

				?>
	      		</table>

<div class="spacing"></div>
      		<span class="float-right"><a href="index.php?page=users&action=add">+<?=ADD?></a></span>
   		<table class="table table-striped">
		<tr>
			<th><?=USERNAME?></th>
	      		<th><?=LEVEL?></th>
	      		<th><?=ACTION?></th>
	      	</tr>
	      
	      			<?php
							//Get users list							
							$users = getJSON(USERS);
	
							//Define tag for user level
							$levelTab= array(NO_TAG, BAN_TAG, MEMBER_TAG, ADMIN_TAG);
							
							if($users){
								foreach($users as $user){
									echo '
										<tr>
						      				<td>'.$user['username'].'</td>
						      				<td>'.$levelTab[$user['level']].'</td>
						      				<td>
												<a href="index.php?page=users&action=edit&id='.$user['id'].'" title ="'.EDIT_BUTTON.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
												<a href="index.php?page=users&action=del&id='.$user['id'].'" title ="'.DEL_BUTTON.'"><i class="fa fa-trash" aria-hidden="true"></i></a>
											</td>
						      			</tr>
									';
								}
							}
				?>
	      		</table>

	  	</div>
		</div>
