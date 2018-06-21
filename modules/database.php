<?php
class CDatabase extends mysqli
{
	function __construct()
	{
		parent::__construct('localhost', 'skrichtarik', 'janov63', 'skrichtarik');
		
		if ($this->connect_error) 
		{
    			die('Connect Error (' . $this->connect_errno . ') '. $this->connect_error);
		}
	}

	function disconnect()
	{
		$this->close();
	}
}
?>