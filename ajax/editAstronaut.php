<?php
	include("../modules/database.php");
	$database = new CDatabase();
	mysqli_set_charset($database,"utf8");
	include("../modules/astronauts.php");
	$astronauts = new CAstronauts($database);

	if(empty($_GET['id']) || empty($_GET['firstName']) || empty($_GET['lastName']) || empty($_GET['born']) || empty($_GET['superpower']))
		echo "WRONG";
	else
	{
		$id = htmlspecialchars($_GET['id'], ENT_QUOTES);
		$firstName = htmlspecialchars($_GET['firstName'], ENT_QUOTES);
		$lastName = htmlspecialchars($_GET['lastName'], ENT_QUOTES);
		$born = htmlspecialchars($_GET['born'], ENT_QUOTES);
		$superpower = htmlspecialchars($_GET['superpower'], ENT_QUOTES);

		$help = explode('/', $born);
		$born = $help[2] . "-" . $help[0] . "-" . $help[1];

		if($astronauts->editAstronaut($id, $firstName, $lastName, $born, $superpower))
			echo "OK";
		else
			echo "WRONG";
	}

?>