<?php
	session_start();
	ini_set('display_errors', '1');
	
	require_once("fonctions/fonctions.php");
	
	$lang= secure($_GET['lang']);
	$filename="db/".$lang.'.php';
	if(($lang && file_exists($filename)))
	{
		$_SESSION['lang'] = $lang;		
		require($filename);
	}
	else
	{
		if(isset($_SESSION['lang']) && !empty($_SESSION['lang'])){
			require("db/".$_SESSION['lang'].".php");
		}
		else{
			$_SESSION['lang'] = 'fr';
			require("db/".$_SESSION['lang'].".php");
		}
	}

	require_once("includes/header.php");
	
	ini_set('allow_url_fopen', 1);

	$pages=array(
		"home" => 1,
		"login" => 1,
		"add" => 2,
		"admin" => 2
	);

	$page = secure($_GET['page']);
	$filename= "pages/".$page.".php";
	
	if(connected())
	{
		switch($page)
	{
		case "logout":
			if(disconnect()){
				echo LOGOUT_NOTIF;
			}else{
				echo LOGOUT_ERROR;
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
						$id = (int) secure($_GET['id']);						
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
	

