<?php
function connected(){
	return (isset($_SESSION['id']));
}

function authorisation($userlvl, $pagelvl)
{
	return ($userlvl >= $pagelvl);
}

function connect($pseudo, $pwd)
{
		$url= "db/users.json";
		$authenticated = false;
		
		$salt = "bb764938100a6ee139c04a52613bd7c1";

		$users = getJSON($url);
		
		if($users){

			foreach($users as $user){			
				$name= $user['username'];
				$mdp = $user['password'];
				$lvl = $user['level'];
				
				if($name == $pseudo)
				{
					if(md5($pwd.$salt) == $mdp)
					{
						$_SESSION['id'] = $pseudo;
						$_SESSION['lvl'] = $lvl;
						$authenticated = true;
						$callback = "Vous avez été connecté avec succès";
					}
				}
			}	
		}			
		return 	$authenticated;
}

function disconnect(){
	$_SESSION['id']= "";
	$disconnect = true;
	try{
	session_destroy();
	}catch(Exception $e){
		$disconnect = false;
	}
	$callback = "Vous avez été déconnecté";
	return $disconnect;
}

function isAdmin($lvl){
	return ($lvl >= 3);
}

function getJSON($file){
	$data = file_get_contents($file);
	if($data){
		$decode = json_decode($data, FILE_USE_INCLUDE_PATH);
	}
	else{
		$decode = NULL;
	}

	return $decode;
}

function redirect($page, $params = NULL){
	$url = "Location:index.php?page=".$page;
	if($params){
		$url .= $params;
	}
	header($url);
}

function secure($data){
	$data = (isset($data) && !empty($data))? htmlspecialchars($data) : NULL;

	return $data;
}

function manageConnect($data){
	$login = secure($data['login']);
	$pwd = secure($data['pwd']);
			
	$connected= connect($login, $pwd);
			
	if($connected){
		redirect("home");	
	}else{
		redirect("login", "&callback=".$connected);
	}
}


function export($array){
	$file =fopen("db/conf.json", 'w');
	$data = json_encode($array, FILE_USE_INCLUDE_PATH);

	fwrite($file, $data);

}

function addConf($data){
	$title = secure($data['title']);
	$description = secure($data['description']);
	$place = secure($data['place']);
	$speaker = secure($data['speaker']);
	$hour = secure($data['hour']);
	$date = secure($data['date']);

	$exploded = explode($date, ':');

	$when = Date ($date . " ". $hour);

	$confs = getJSON("db/conf.json");

	$newConf= array(
		"titre" => $title,
		"datetime" => $when,
		"lieu" => $place,
		"speaker" => $speaker,
		"description" => $description
	);

	array_push($confs,$newConf);
}