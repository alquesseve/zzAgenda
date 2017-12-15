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
	$admin = isAdmin($lvl)? '<div class="col-lg-4"><h4><a href="index.php?page=admin">'.ADMIN_BUTTON.'</a></h4><div class="hline-w"></div></div>' : NULL;
 ?>
 
<div id="footerwrap">
	<div class="container">
	 	<div class="row">
 		<div class="col-lg-4">
			<h4><?=HOME?></h4>
 			<div class="hline-w"></div>
 		</div>	
 			<?=$admin?>	
 	<div class="col-lg-4">
 			<h4><?=$button?></h4>
 			<div class="hline-w"></div>
 		</div>
	 	</div> <!--ROW-->
 	</div> <!--CONTAINER-->
</div> <!--FOOTERWRAP-->
	
</body>
<script type="text/javascript" src="styles/assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="styles/assets/js/bbcode.js"></script>
</html>
