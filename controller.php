<?php
include("header.php");
if(!isset($_SESSION['sess_id'])) {
	$_SESSION["sess_id"]=( $_GET['sess_id']);
	include("db.php");
	// Remove flag
	
	$SQL = "INSERT INTO sessions (identifier, movie_id) VALUES('".mysql_real_escape_string($_GET['sess_id'])."', 'CONNECTED');";

	mysql_query($SQL) or die(mysql_error());
}
?>

<div class="container">

	<div class="row-fluid">
		<div class="span12">
<table class="table" width="100%">
	<thead>
		<tr>
			<td></td>
			<td>Title</td>
		</tr>
	</thead>
	<tbody>
	<?php
	$url = "https://gdata.youtube.com/feeds/api/videos?q=".str_replace(" ", "%20", $_GET['q'])."&orderby=published&start-index=11&max-results=50&v=2";
	$data = file_get_contents($url);
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($data);
	$entries = $xmlDoc->getElementsByTagName("entry");
	for($i = 0; $i < $entries->length; $i++) {
		$entry = $entries->item($i);
		$thumbnail = $entry->getElementsByTagNameNS("http://search.yahoo.com/mrss/", "thumbnail")->item(0)->getAttribute("url") or die("A");
		$id = $entry->getElementsByTagName("id")->item(0)->childNodes->item(0)->nodeValue or die("Ae");
		
		$id = explode(":", $id);
		$id = $id[3];
		
	?>	 
	<tr class="item">
		<td width="64px">
			<img src="<?php echo $thumbnail ?>" width="64px" />
		</td>
		
		<td><a href="video.php?id=<?php echo $id;?>&sess_id=<?php echo $_GET["sess_id"];?>"><?php echo $entry->getElementsByTagNameNS("http://search.yahoo.com/mrss/", "title")->item(0)->childNodes->item(0)->nodeValue;?></a>
		</td>
	</tr>
	
	<?php
	}
	?>
	</tbody>
</table>
<?php include("footer.php"); ?>