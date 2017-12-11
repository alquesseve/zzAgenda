 <?php
	if(connected())
	{
		$button = '<a href="index.php?page=logout">'.LOGOUT.'</a>';
	}
	else
	{
		$button = '<a href="index.php?page=login">'.SIGNIN.'</a>';
	}
	
	$lvl = (isset($_SESSION['lvl']))? $_SESSION['lvl'] : 0;
	$admin = isAdmin($lvl)? '<a href="index.php?page=admin">'.ADMIN_BUTTON.'</a>' : NULL;
 ?>
 
<div id="footerwrap">
	<div class="container">
	 	<div class="row">
 		<div class="col-lg-4">
			<h4><?=HOME?></h4>
 			<div class="hline-w"></div>
 		</div>
 		<div class="col-lg-4">
 			<h4><?=$admin?></h4>
 			<div class="hline-w"></div>
 		</div>
 		<div class="col-lg-4">
 			<h4><?=$button?></h4>
 			<div class="hline-w"></div>
 		</div>
	 	</div> <!--ROW-->
 	</div> <!--CONTAINER-->
</div> <!--FOOTERWRAP-->
	
</body>
</html>
