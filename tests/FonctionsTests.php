<?php
ini_set('display_errors', '1');

require("../fonctions/fonctions.php");

use PHPUnit\Framework\TestCase;

class Test extends TestCase{

	// test de la fonction d'authorisation
	public function testAuthorisation()
	{
		//Variables
		$userlvl = 1;
		$pagelvl = 2;
		
		$res = authorisation($userlvl, $pagelvl);
		
		$this->assertFalse($res);
	}
	
	//test de la fonction de connection
	public function testConnect()
	{
		//Variables
		$user = "admin";
		$pwd = "admin";
		
		$res = connect($user, $pwd);
		
		$this->assertTrue($res);
	}
	
	//test de la fonction de déconnection
	public function testDisconnect(){
		$this->assertTrue(disconnect());
	}

	//test de la fonction administrateur
	public function testAdmin(){
		$lvl = 3;

		$this->assertTrue(isAdmin($lvl));
	}

	//test de la fonction getJSON
	public function testGetJSON(){
		$file = "/home/etud/alquesseve/public_html/devweb/agenda/db/users.json";

		$this->assertNotNull(getJSON($file));
	}
}
