     <div class="w-75 m-auto">
	      	<div class="container">

			<?php
				$confs = getJSON(CONFERENCES);

				if($confs){
				
					foreach($confs as $conf){

					$datetime= formatDate($conf['datetime']);

					echo '
						<div class="meeting w-75 pt-5">
							<div class="container row">
								<div class="pr-4">'.$datetime['date'] . " " . $datetime['heure'] .'</div>
								<div class="col">
									<h2>'.$conf['titre'].'</h2>
									<p>'.$conf['lieu'].'</p>
									<p>'.$conf['speaker'].'</p>
								</div>
								<div>'.$conf['description'].'</div>
							</div>
						</div>
					';
					}
				}else {
					echo "Aucune conférence n'est disponible";
				}
			?>

	      	</div>
	  	</div>
	</div>
