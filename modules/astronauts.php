<?php
class CAstronauts
{

	function __construct($database)
	{
		$this->database = $database;
	}

	function init()
	{
		$results = $this->database->query("Select * FROM astronauts");

		$i=0;
		while($astronaut = $results->fetch_assoc())
		{
			$astronauts[$i] = $astronaut;
			$i++;
		}
		if($i == 0)
			return false;
		else
			return $astronauts;
	}

	function delete($id)
	{
		return $this->database->query("DELETE FROM astronauts WHERE id='$id'");
	}

	function insert($firstName, $lastName, $born, $superpower)
	{
		return $this->database->query("INSERT INTO astronauts (firstName, lastName, born, superpower) VALUES ('$firstName','$lastName','$born','$superpower')");
	}

	function initAstronaut($id)
	{
		$results = $this->database->query("Select * FROM astronauts WHERE id='$id'");

		return $results->fetch_assoc();
	}

	function editAstronaut($id, $firstName, $lastName, $born, $superpower)
	{
		return $this->database->query("UPDATE astronauts SET firstname='$firstName', lastName='$lastName', born='$born', superpower='$superpower' WHERE id='$id'");
	}
}
?>