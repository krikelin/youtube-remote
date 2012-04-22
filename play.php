<?php
header("content-type: application/json");
$conn = mysql_connect("localhost", "krakelin_retube", "c%rh&g");
$db = mysql_select_db("krakelin_retube");
$SQL = "INSERT INTO sessions (identifier, movie_id) VALUES('".mysql_real_escape_string($_GET['sess_id'])."', '".mysql_real_escape_string($_GET['id'])."');";
$mysql_result = mysql_query($SQL) or die(mysql_error());
$status = "OK";
?>{
	"status":"<?php echo $status;?>"
}