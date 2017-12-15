<?php
require("fonctions/fonctions.php");
use PHPUnit\Framework\TestCase;
class Test extends TestCase{
	public function testConnected(){
		$this->assertFalse(connected());
	}
	
	// test de la fonction d'authorisation
	public function testAuthorisation()
	{
		//Variables
		$userlvl = 1;
		$pagelvl = 2;
		
		$res = authorisation($userlvl, $pagelvl);
		
		$this->assertFalse($res);
	}
	
	public function testDisconnect(){
		$this->assertFalse(disconnect());
	}
	
	public function testAdmin(){
		$lvl = 3;
		$this->assertTrue(isAdmin($lvl));
	}
	
	public function testSecure(){
		$data1 = "3";
		$data2 = "</>";
		$this->assertTrue(secure($data1) == "3");
		$this->assertTrue(secure($data2) == "&lt;/&gt;");
	}
	public function testGetJSON(){
		$file = USERS;
		$this->assertNotNull(getJSON($file));
	}
	
	public function testFormatDate(){
		$datetime = "2082-01-01 10:00";
		$array= array('date' => "01/01/2082", 'heure' => "10:00");
		$this->assertNotNull(formatDate($datetime));
	}
	
	public function testCheckChar(){
		$ch1 = "A";
		$ch2 = "blablabla";
		$ch3 = "&éà@!:;%^$";
		$ch4= "abcdefghijklmnopqrstuvwxyz0123456789";
		$this->assertTrue(checkChar($ch1) == "LOGIN_CHECKCHAR_FAILED");
		$this->assertNull(checkChar($ch2));
		$this->assertTrue(checkChar($ch3) == "LOGIN_CHECKCHAR_FAILED");
		$this->assertTrue(checkChar($ch4) == "LOGIN_CHECKCHAR_FAILED");
	}
	
	public function testCompareConfDate(){
		$date1 = array( 'datetime' => "2082-01-01 10:00");
		$date2 = array( 'datetime' => "2083-01-01 10:00");
		$this->assertTrue(compareConfDate($date1, $date2));
	}
	
	public function testGetId(){
		$data = array( 
				array('id' => 1),
				array('id' => 8),
		);
		$this->assertTrue(getId($data) == 9);
	}
	
	public function testConf(){
		$newConf= array(
			"title" => "azerty",
			"description" => "blablabla",
			"place" => "ici",
			"speaker" => "moi",
			"date" => "10/12/2011",
			"hour" => "10:11"
		);
		$id = getId(getJSON(CONFERENCES));
		
		$this->assertTrue(addConf($newConf) == "");
		
		deleteConf($id);
	}
	
	public function testUser(){
		$newUser= array(
			"password" => "njzeafklvuj",
			"username" => "azerty",
			"level" => 2
		);
		$id = getId(getJSON(USERS));
		
		$this->assertTrue(addUser($newUser) == "");
		
		deleteConf($id, USERS);
	}
	
	public function testSearchIndex(){
		$data = array(
			array('id' => 2),
			array('id' => 0),
			array('id' => 1),
			array('id' => 3)
		);
		
		$this->assertTrue(searchIndex($data, 1) == 2);
	}
	
	public function testConcat(){
		$ch1 = "a";
		$ch2 = "b";
		
		$this->assertTrue(concatValue($ch1) == 'value="a"');
		$this->assertTrue(concatPlaceholder($ch1) == 'placeholder="a"');
	}
}
?>
