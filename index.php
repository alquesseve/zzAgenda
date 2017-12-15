<?php
	ini_set('display_errors', '1');	
	session_start();
	
	//Get functions
	require_once("fonctions/fonctions.php");
	
	$lang= (isset($_GET['lang']))? secure($_GET['lang']) : NULL;

	$filename="db/".$lang.'.php';

	//if the language required exists
	if(($lang && file_exists($filename)))
	{
		//use it		
		$_SESSION['lang'] = $lang;		
		require($filename);
	}
	else
	{
		//if a language is set in current session	
		if(isset($_SESSION['lang']) && !empty($_SESSION['lang'])){
			require("db/".$_SESSION['lang'].".php");
		}
		else{
			//default language = french		
			$_SESSION['lang'] = 'fr';
			require("db/".$_SESSION['lang'].".php");
		}
	}

	require_once("includes/header.php");
	
	//Definition of the pages ' rights
	/* 3 = admin
	*  2= member
	*  1 = 
	*  0 = everyone
	*/
	$pages=array(
		"home" => 2,
		"login" => 0,
		"confs" => 3,
		"admin" => 3,
		"users" => 3	
	);

	//Get the required page
	$page = (isset($_GET['page']))? secure($_GET['page']) : NULL;
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

			//Managing conferences
			case "confs":
				//if the user got the permission
				if(authorisation($_SESSION['lvl'], 'users')){			
					
					//Get the action performed					
					$action = secure($_GET['action'], 'add');
					$id = (int) secure($_GET['id']);

					switch($action)
					{
						case "add" :
							if(isset($_POST['post_conf'])){
								$callback = addConf($_POST);
							}
						break;
						case "edit" :
							if(isset($_POST['post_conf'])){
								$callback = editConf($id, $_POST);
							}					
						break;
						default :  //Delete						
							if(isset($_POST['post_del'])){						
								deleteConf($id);
							}
						break; 
					}
					require("pages/confs.php");
				}
				else{
					//If not, display home page					
					require("pages/home.php");
				}

			break;

			//Manage users
			case "users":
				if(authorisation($_SESSION['lvl'], 'users')){
					$action = secure($_GET['action'], 'add');
					$id = (int) secure($_GET['id']);

					switch($action)
					{
						case "add" :
							if(isset($_POST['post_user'])){
								$callback= addUser($_POST);
							}
						break;
						case "edit" :
							if(isset($_POST['post_user'])){
								$callback= editUser($id, $_POST);
							}					
						break;
						default :  //Delete						
							if(isset($_POST['post_del_user'])){						
								deleteConf($id, USERS);
							}
						break; 
					}
					require("pages/users.php");
				}
				else{
					require("pages/home.php");
				}

			break;

			//All other page
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
			//Log the user				
			manageConnect($_POST);
		}
		else{
			include("pages/login.php");
		}
	}
	require_once("includes/footer.php");
	

