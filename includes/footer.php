 <?php
	if(connected())
	{
		$button = '<a href="index.php?page=logout">Logout</a>';
	}
	else
	{
		$button = '<a href="index.php?page=login">Login</a>';
	}
	
	$lvl = (isset($_SESSION['lvl']))? $_SESSION['lvl'] : 0;
	$admin = isAdmin($lvl)? '<a href="index.php?page=admin">Admin</a>' : NULL;
 ?>
 
 <footer class="footer">
	      <div class="container m-auto w-100">
	        <span class="text-muted"><a href="">Item 1</a></span>
	        <span class="text-muted"><a href="">Item 2</a></span>
	        <span class="text-muted"><?=$button?></span>
			<span class="text-muted"><?=$admin?></span>
	      </div>
	    </footer>
	
</body>
</html>