<?php
define("CONFERENCES", "db/conf.json");
define("USERS", "db/users.json");

function connected(){
	return (isset($_SESSION['id']));
}

function authorisation($userlvl, $pagelvl)
{
	return ($userlvl >= $pagelvl);
}

function connect($pseudo, $pwd)
{
		$authenticated = false;
		
		$salt = "bb764938100a6ee139c04a52613bd7c1";

		$users = getJSON(USERS);
		
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
						setcookie("username", $pseudo);	
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

function formatDate($datetime){
	$obj= new DateTime($datetime);
	$date = $obj->format('d/m/Y');
	$heure = $obj->format('H:i');

	return array('date' => $date, 'heure' => $heure);
}

function manageConnect($data){
	$login = secure($data['login']);
	$pwd = secure($data['pwd']);
		
	$test= checkChar($login);

	if(!$test){
		$connected= connect($login, $pwd);
			
		if($connected){
			redirect("home");	
		}else{
			redirect("login", "&callback=DATA_ERROR");
		}
	}
	else{
		redirect("login", "&callback=".$test);
	}
}

function checkChar($ch){
	$res= "LOGIN_CHECKCHAR_FAILED";
	if(preg_match ( "$^[a-zA-Z0-9_]{3,16}$" , $ch )){
		$res= NULL;
	}
	return $res;
}

function export($array, $file){
	$file =fopen($file, 'w');
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

	if(!checkChar($title) && !checkChar($place) && !checkChar($speaker)){
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
		export($confs, CONFERENCES);
		
		$callback="";
	}else{
		$callback = "DATA_CHARCHECK_FAILED";
	}
	return $callback;
}

function addUser($data){
	$username = secure($data['username']);
	$password = secure($data['password']);
	$level = secure($data['level']);

	$users = getJSON(USERS);

	$id = getId($users);

	if(!checkChar($username)){
	
		$salt = "bb764938100a6ee139c04a52613bd7c1";
		$password= md5($password.$salt);

		$newUser= array(
			"id" => $id,
			"username" => $username,
			"password" => $password,
			"level" => $level
		);

		array_push($users,$newUser);
		export($users, USERS);

		$callback="";
	}else{
		$callback = "DATA_CHARCHECK_FAILED";
	}
}

function searchIndex($array, $id){
	$i = 0;
	$length = count($array);
	$result = -1;

	while ($i < $length && $array[$i]['id'] != $id){
		$i++;
	}

	if($i < $length){
		$result = $i;
	}
	
	return $result;
}

function loadConf($id, $data=CONFERENCES)
{
	$confs = getJSON($data);
	$index = searchIndex($confs, $id);

	$result = NULL;
	
	if($index >= 0){
		$result = $confs[$index];
	}

	return $result;
}

function editConf($id, $data){
	deleteConf($id);
	$callback = addConf($data);
}

function deleteConf($id, $data=CONFERENCES){
	$confs = getJSON($data);
	$index = searchIndex($confs, $id);
	array_splice($confs, $index, 1);
	
	export($confs, $data);
}

function editUser($id, $data){
	deleteConf($id, USERS);
	
	$username = secure($data['username']);
	$password = secure($data['password']);
	$level = secure($data['level']);

	if(!checkChar($username)){

		$users = getJSON(USERS);

		$id = getId($users);
	
		$newUser= array(
			"id" => $id,
			"username" => $username,
			"password" => $password,
			"level" => $level
		);

		array_push($users,$newUser);
		export($users, USERS);
		
		$callback="";
	}else{
		$callback = "DATA_CHARCHECK_FAILED";
	}
}

function concatValue($ch1){
	return ("value=".'"'.$ch1.'"');
}

function concatPlaceholder($ch1){
	return ("placeholder=".'"'.$ch1.'"');
}
