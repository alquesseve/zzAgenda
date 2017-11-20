<?php
	$session= isset($_SESSION['id'])? $_SESSION['id'] : NULL;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>zzAgenda</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<style type="text/css">
	/* Sticky footer styles
-------------------------------------------------- */
html {
  position: relative;
  min-height: 100%;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 60px;
  background-color : #ecf0f1;
}
h1 a {
	text-decoration : none;
}
h1 a:hover {
	text-decoration : none;
}
header{
	width : 100%;
	margin-bottom: 10%;
}
.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  line-height: 60px; /* Vertically center the text there */
  background-color: #95a5a6;
}
.footer a {
	color : white;
}
.footer a:hover {
	color : orange;
}
</style>

<body>
	<div class="container">
		<header>
			<img src="" class="float-left"/>
			<h1><a href="index.php">zzAgenda</a></h1>
			<div class="float-right">
				<span><?=$session?></span>
				<span><a href="?lang=en">English</a></span>
				<span><a href="?lang=fr">French</a></span>
			</div>
		</header>
	</div>