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
	
	public function testConnect()
	{
		//Variables
		$user = "admin";
		$pwd = "admin";
		
		$res = connect($user, $pwd);
		
		$this->assertTrue($res);
	}
	
	public function testDisconnect(){
		$this->assertTrue(disconnect());
	}

	public function testAdmin(){
		$lvl = 3;

		$this->assertTrue(isAdmin($lvl));
	}

	public function testGetJSON(){
		$file = "/home/etud/alquesseve/public_html/devweb/agenda/db/users.json";

		$this->assertNotNull(getJSON($file));
	}
}
