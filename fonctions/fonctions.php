<?php
//Global link to files
define("CONFERENCES", "db/conf.json");
define("USERS", "db/users.json");
//Check if the user is connected
function connected(){
	return (isset($_SESSION['id']));
}
//check if the user has the right to enter in a page
function authorisation($userlvl, $pagelvl)
{
	return ($userlvl >= $pagelvl);
}
//Connect the user (if no error)
function connect($pseudo, $pwd)
{
	$authenticated = false;
	
	//salt used to store passwords
	$salt = "bb764938100a6ee139c04a52613bd7c1";
	//get users list
	$users = getJSON(USERS);
		
	if($users){
		$i = 0;
		while($i < count($users) && $users[$i]['username'] != $pseudo){			
			$i++;	
		}
		
		//if the $pseudo has been found
		if($i < count($users)){
			$name= $users[$i]['username'];
			$mdp = $users[$i]['password'];
			$lvl = $users[$i]['level'];
			if(md5($pwd.$salt) == $mdp)
			{
				$_SESSION['id'] = $pseudo;
				$_SESSION['lvl'] = $lvl;
				$authenticated = true;
				setcookie("username", $pseudo);	
			}
		}	
	}	
	return 	$authenticated;
}
//Check if the user is an administrator
function isAdmin($lvl){
	return ($lvl >= 3);
}
//Disconnect the user
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
//Get JSON content of the $file
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
//Redirect user to the specific $page
function redirect($page, $params = NULL){
	$url = "Location:index.php?page=".$page;
	if($params){
		$url .= $params;
	}
	header($url);
}
//Get data from url or form and secure it to avoid undesired scripts execution
function secure($data, $default =  NULL){
	$data = (isset($data) && !empty($data))? htmlspecialchars($data) : $default;
	return $data;
}
//Separate date and time from a timestamp
function formatDate($datetime){
	$obj= new DateTime($datetime);
	$date = $obj->format('d/m/Y');
	$heure = $obj->format('H:i');
	return array('date' => $date, 'heure' => $heure);
}
//handle submitted data from form and verify it
function manageConnect($data){
	$login = secure($data['login']);
	$pwd = secure($data['pwd']);
		
	//verify characters
	$test= checkChar($login);
	if(!$test){
		//trying to connect the user
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
//Verify the $ch : check if there is no special characters and that the length is between 3 and 16
function checkChar($ch){
	//error code
	$res= "LOGIN_CHECKCHAR_FAILED";
	if(strlen($ch) <= 16 && preg_match ( "$^[a-zA-Z0-9_]{3,16}$" , $ch )){
		$res= NULL;
	}
	return $res;
}
//export JSON data ($array) to $file
function export($array, $file){
	$file =fopen($file, 'w');
	$data = json_encode($array, FILE_USE_INCLUDE_PATH);
	fwrite($file, $data);
	fclose($file);
}
//Compare conferences based on datetime field
function compareConfDate($c1, $c2){
	return ($c1['datetime'] < $c2['datetime']);
}
//Get the ID of a specific entity
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
//add a conference based on $data received from a form
function addConf($data){
	$title = secure($data['title']);
	//No use of secure function to avoid htmlspecialchars()
	$description = (isset($data['description']))? $data['description'] : NULL;
	$place = secure($data['place']);
	$speaker = secure($data['speaker']);
	$hour = secure($data['hour']);
	$date = secure($data['date']);
	$callback = "DATA_CHARCHECK_FAILED";
	//If the fields are OK	
	if(!checkChar($title) && !checkChar($place) && !checkChar($speaker)){
		$when = Date ($date . " ". $hour);
		$confs = getJSON(CONFERENCES);
		$id = getId($confs);
		//create new entity		
		$newConf= array(
			"id" => $id,
			"titre" => $title,
			"datetime" => $when,
			"lieu" => $place,
			"speaker" => $speaker,
			"description" => $description
		);
		array_push($confs,$newConf);
		//sort the new list of conferences
		usort($confs, 'compareConfDate');
		export($confs, CONFERENCES);
		
		$callback="";
	}
	return $callback;
}

//Add a user based on $data received from a form
function addUser($data){
	$username = secure($data['username']);
	$password = secure($data['password']);
	$level = secure($data['level']);
	$users = getJSON(USERS);
	$id = getId($users);
	$callback = "LOGIN_CHECKCHAR_FAILED";
	if(!checkChar($username)){
	
		$salt = "bb764938100a6ee139c04a52613bd7c1";
		//password encryption		
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
	}
	return $callback; 
}
//Search the index of the entity with ID: $id  in $array
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
//Load the conference with the specific $id
function loadConf($id, $file=CONFERENCES)
{
	$confs = getJSON($file);
	$index = searchIndex($confs, $id);
	$result = NULL;
	
	if($index >= 0){
		$result = $confs[$index];
	}
	return $result;
}
//Edit a conf specified by $id, $data contain the new entity
function editConf($id, $data){
	$confs=getJSON(CONFERENCES);
	$index=searchIndex($confs,$id);

	$title = secure($data['title']);
	//No use of secure function to avoid htmlspecialchars()
	$description = (isset($data['description']))? $data['description'] : NULL;
	$place = secure($data['place']);
	$speaker = secure($data['speaker']);
	$hour = secure($data['hour']);
	$date = secure($data['date']);
	$callback = "DATA_CHARCHECK_FAILED";
	//If the fields are OK	
	if(!checkChar($title) && !checkChar($place) && !checkChar($speaker)){
		$when = Date ($date . " ". $hour);
		$confs[$index]= array(
			"id" => $id,
			"titre" => $title,
			"datetime" => $when,
			"lieu" => $place,
			"speaker" => $speaker,
			"description" => $description
		);

		usort($confs, 'compareConfDate');
		export($confs, CONFERENCES);
		
		$callback="";
	}
	return $callback;




}
//Delete an entity (default, a conference)
function deleteConf($id, $file=CONFERENCES){
	$confs = getJSON($file);
	$index = searchIndex($confs, $id);
	array_splice($confs, $index, 1);
	
	export($confs, $file);
}
//Edit a user
function editUser($id, $data){
	
	$username = secure($data['username']);
	$password = secure($data['password']);
	$level = secure($data['level']);
	if(!checkChar($username)){
		$users = getJSON(USERS);
		$index = searchIndex($users,$id);
	
		$users[$index]= array(
			"id" => $id,
			"username" => $username,
			"password" => $password,
			"level" => $level
		);
		export($users, USERS);
		
		$callback="";
	}else{
		$callback = "DATA_CHARCHECK_FAILED";
	}
	return $callback;
}
//prepend "value=" to $ch1
function concatValue($ch1){
	return ("value=".'"'.$ch1.'"');
}
//prepend "placeholder=" to $ch1
function concatPlaceholder($ch1){
	return ("placeholder=".'"'.$ch1.'"');
}
