<div id="blue">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-4">
				<h3><?=MAIN_CONF_LIST_TEXT?></h3>
			</div>
		</div>
	</div>
</div>
<div class="container mtb">
	 	<div class="row">
		<?php
			//Get all the conferences
			$confs = getJSON(CONFERENCES);

			if($confs){
				foreach($confs as $conf){
					//separate date and time         				 
					$datetime= formatDate($conf['datetime']);
					
					//display a conf
					echo '
						<div class="col-lg-8">
							<h3> '.$conf['titre'].' - '.$datetime['date'] . ' ' . $datetime['heure'] .'</h3>
							<div> <i>'.$conf['lieu'].'</i></div>
							<div "class="col">
									<p> '.SPEAKER.': '.$conf['speaker'].'</p>
							</div>
							<div>'.$conf['description'].'</div>
							<div class="spacing"></div>
					 		<h6>'.SHARE.' :</h6>
								<p class="share">
			 					<a href="https://twitter.com/intent/tweet?text=Rejoignez-moi%20à la conf&eacute;rence '.$conf['titre'].' le '.$datetime['date'].' https://www.isima.fr/~alquesseve/devweb/agenda/index.php"><i class="fa fa-twitter"></i></a>
			 					<a href="https://www.facebook.com/sharer/sharer.php?u=https://www.isima.fr/~alquesseve/devweb/agenda/index.php"><i class="fa fa-facebook"></i></a>
			 					<a href="https://plus.google.com/share?url=https://www.isima.fr/~alquesseve/devweb/agenda/index.php"><i class="fa fa-google-plus"></i></a>		 		
			 				</p>
			 			<div class="hline"></div>
				 		<div class="spacing"></div>
						</div>
					';
				}
			}else {
				echo NO_CONF;
			}
		?>
      	</div>
</div>
