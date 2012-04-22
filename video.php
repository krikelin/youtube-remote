<?php
include("header.php");
$url = "https://gdata.youtube.com/feeds/api/videos/{$_GET['id']}?v=2";
	$data = file_get_contents($url); 
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($data);
	$entry = $xmlDoc->getElementsByTagName("entry")->item(0);
	$title = $entry->getElementsByTagName("title")->item(0)->childNodes->item(0)->nodeValue;
	$description =  $entry->getElementsByTagNameNS("http://search.yahoo.com/mrss/", "description")->item(0)->childNodes->item(0)->nodeValue;
	$thumbnail = $entry->getElementsByTagNameNS("http://search.yahoo.com/mrss/", "thumbnail")->item(0)->getAttribute("url") or die("A");
		
?>
<div class="container">
	<div class="row-fluid">
		<div class="span2">&nbsp;</div>
		<div class="span12">
			<center>
			<div class="btn-group" style="width: 320px">
			  <button class="btn" onclick="rewind('<?php echo $_GET['id'];?>', '<?php echo $_GET['sess_id'];?>')">|&lt;&lt;</button>
			  <button class="btn" onclick="pap('<?php echo $_GET['id'];?>', '<?php echo $_GET['sess_id'];?>')">II</button>
			  <button class="btn" onclick="forward('<?php echo $_GET['id'];?>', '<?php echo $_GET['sess_id'];?>')">&gt;&gt;|</button>
			</div>
			</center>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<h1><?php echo $title;?></h1>
			<img src="<?php echo $thumbnail ?>" style="width: 100%" />
			
			<p><?php echo $description ?></p>