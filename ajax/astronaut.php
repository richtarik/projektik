<?php
	include("../modules/database.php");
	$database = new CDatabase();
	mysqli_set_charset($database,"utf8");
	include("../modules/astronauts.php");
	$astronauts = new CAstronauts($database);

	if(!empty($_GET['id']))
	{
		$id = htmlspecialchars($_GET['id'], ENT_QUOTES);
		$result = $astronauts->initAstronaut($id);
		echo json_encode($result);
	}
?>