<div id="blue">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-4">
				<h3>Next Conferences </h3>
			</div>
		</div>
	</div>
</div>
<div class="container mtb">
	 	<div class="row">
		<?php
			$confs = getJSON(CONFERENCES);
			if($confs){
				foreach($confs as $conf){
          $datetime= formatDate($conf['datetime']);
				echo '
					<div class="col-lg-8">
						<h3> '.$conf['titre'].' - '.$datetime['date'] . ' ' . $datetime['heure'] .'</h3>
						<div> <i>'.$conf['lieu'].'</i></div>
						<div "class="col">
								<p> Conférencier: '.$conf['speaker'].'</p>
						</div>
						<div>'.$conf['description'].'</div>
						<div class="spacing"></div>
				 		<h6>SHARE :</h6>
							<p class="share">
		 					<a href="#"><i class="fa fa-twitter"></i></a>
		 					<a href="#"><i class="fa fa-facebook"></i></a>
		 					<a href="#"><i class="fa fa-google-plus"></i></a>		 		
		 				</p>
		 			<div class="hline"></div>
			 		<div class="spacing"></div>
					</div>
				';
				}
				}else {
					echo "Aucune conférence n'est disponible";
				}
		?>
      	</div>
</div>
