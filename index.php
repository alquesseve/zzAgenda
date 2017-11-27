<?php
	session_start();
	ini_set('display_errors', '1');

	require_once("fonctions/fonctions.php");
	require_once("includes/header.php");
	
	ini_set('allow_url_fopen', 1);

	$pages=array(
		"home" => 1,
		"login" => 1,
		"add" => 2,
		"admin" => 2
	);

	$page = (isset($_GET['page']))? htmlspecialchars($_GET['page']): NULL;
	$filename= "pages/".$page.".php";

	if(connected())
	{
		switch($page)
	{
		case "logout":
			if(disconnect()){
				echo "Vous avez été déconnecté";
			}else{
				echo "Une errreur est survenue";
			}
			redirect("login");
		break;
		case "add":
			$action = secure($_GET['action'], 'add');

			switch($action)
			{
				case "add" :
					if(isset($_POST['post_conf'])){
						addConf($_POST);
					}
				break;
				case "edit" : //Modification
					if(isset($_POST['post_conf'])){
						editConf($id, $_POST);
					}					
				break;
				default :  //Suppression						
					if(isset($_POST['post_del'])){
						deleteConf($id);
					}
				break; 
			}
			require("pages/add.php");

		break;
		default:
			if($page && file_exists($filename) && authorisation($_SESSION['lvl'], $pages[$page]))
			{
				require("pages/".$page.".php");
			}
			else
			{
				require("pages/home.php");
			}
		break;
	}
	}
	else{
		if(isset($_POST['login']))
		{
			manageConnect($_POST);
		}
		else{
			include("pages/login.php");
		}
	}
	require_once("includes/footer.php");
	

