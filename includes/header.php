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
	$session= isset($_SESSION['id'])? '<a href="">'.$_SESSION['id'].'</a>' : NULL;
	$admin = isAdmin($lvl)? '<a href="index.php?page=admin">'.ADMIN_BUTTON.'</a>' : NULL;	
	$langues= array("English" => "en", "Français" => "fr");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="./styles/assets/ico/favicon.ico">

	<title><? if(isset($title)){
		echo $title;}
		else
			{echo "Home";}
	?></title>

	<!-- Bootstrap core CSS -->
	<link href="./styles/assets/css/bootstrap.css" rel="stylesheet">
	
	<!-- Custom styles for this template -->
	<link href="./styles/assets/css/style.css" rel="stylesheet">
	<link href="./styles/assets/css/font-awesome.min.css" rel="stylesheet">
</head>

</body>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<img src="https://t3.ftcdn.net/jpg/01/00/81/12/240_F_100811279_PleySq4uQIyhBePf6jSkxhSxLJzBXojm.jpg" height="75" width="125" margin-left="100">
		        <div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">zzAGENDA</a>
			</div>
			<div class="navbar-collapse collapse navbar-right">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php"><?=HOME?></a></li>
					<li> <?=$session?> </li>
					<li> <?=$button?> </li>
					<li> <?=$admin?> </li>
					<li>
						<a href="index.php?lang=<?=$langues[NEXT_LANGUAGE]?>"><?=NEXT_LANGUAGE?></a>
					</li>
          			</ul>
       			</div>
      		</div>
	</div>
<body>
