<?php
	$server="localhost";
	$username="root";
	$password="";
	$dbname="db_jkpg";
	$con=mysqli_connect($server,$username, $password, $dbname);
		if(!$con){
			die("connection failed".mysqli_connect_error());
		}
		
