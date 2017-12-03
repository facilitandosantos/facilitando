<?php

	function connect_DB()
	{
		$database = @mysqli_connect("localhost","root","","hacksantos");
		mysqli_set_charset($database,"utf8");
		return $database;
	}

?>