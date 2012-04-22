<?php
/***
Copyright (C) 2012 Alexander Forselius

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
**/
header("content-type: application/json");
$conn = mysql_connect("localhost", "krakelin_retube", "c%rh&g");
$db = mysql_select_db("krakelin_retube");
$SQL = "SELECT * FROM sessions WHERE identifier = '".mysql_real_escape_string($_GET['sess_id'])."'";

$mysql_result = mysql_query($SQL) or die(mysql_error());

$video_id = "";
if(mysql_num_rows($mysql_result) > 0) {
	$session = mysql_fetch_array($mysql_result);
	$video_id = $session["movie_id"];
	$SQL = "DELETE FROM sessions WHERE id = ".$session["id"];
	
	mysql_query($SQL) or die(mysql_error());
}
?>{
	"id":"<?php echo $video_id;?>"
} 