<?php
header("content-type: application/json");
include("db.php");
$identifier = mysql_real_escape_string($_GET['identifier']);
$action = mysql_real_escape_string($_GET['action']);
$SQL = "INSERT INTO sessions(identifier, movie_id) VALUES('$identifier', '$action')";
mysql_query($SQL) or die(mysql_error());
?>{
	"status":"OK"
}