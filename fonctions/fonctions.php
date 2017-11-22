<?php
define("CONFERENCES", "db/conf.json");

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

function secure($data, $default =  NULL){
	$data = (isset($data) && !empty($data))? htmlspecialchars($data) : $default;

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
	$file =fopen(CONFERENCES, 'w');
	$data = json_encode($array, FILE_USE_INCLUDE_PATH);

	fwrite($file, $data);

	fclose($file);

}

function compareConfDate($c1, $c2){
	return ($c1['datetime'] < $c2['datetime']);
}

function getId($confs){
	$id= 0;
	$length = count($confs);
	if($confs){
		for($i=0; $i< $length; $i++){
			if($id <= $confs[$i]['id']){
				$id = $confs[$i]['id'];
			}
		}
	}
	return ++$id;
}

function addConf($data){
	$title = secure($data['title']);
	$description = secure($data['description']);
	$place = secure($data['place']);
	$speaker = secure($data['speaker']);
	$hour = secure($data['hour']);
	$date = secure($data['date']);

	$when = Date ($date . " ". $hour);

	$confs = getJSON(CONFERENCES);

	$id = getId($confs);

	$newConf= array(
		"id" => $id,
		"titre" => $title,
		"datetime" => $when,
		"lieu" => $place,
		"speaker" => $speaker,
		"description" => $description
	);

	array_push($confs,$newConf);
	usort($confs, 'compareConfDate');
	export($confs);
}

function searchIndex($array, $id){
	$i = 0;
	$length = count($array);
	$result = NULL;

	while ($i < $length && $array[$i]['id'] != $id){
		$i++;
	}

	if($i < $length){
		$result = $i;
	}

	return $result;
}

function loadConf($id)
{
	$confs = getJSON(CONFERENCES);
	$index = searchIndex($confs, $id);

	$result = NULL;

	if($index){
		$result = $confs[$index];
	}

	return $result;
}

function editConf($id, $data){
	deleteConf($id);
	addConf($data);
}

function deleteConf($id){
	$confs = getJSON(CONFERENCES);
	$index = searchIndex($confs, $id);

	unset($confs[$index]);
}
