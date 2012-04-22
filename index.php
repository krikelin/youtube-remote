<?php
include("header.php");
$sess_id = "";

if(!isset($_SESSION["sess_id"])) {
	$sess_id = md5("love://Joy06H#crush::".date("Ymdhis")."::".rand());
	$_SESSION["sess_id"] = ($ses_id);
} else {
	$sess_id = $_SESSION["sess_id"];
}
?>
<div id="prepaid" class="row-fluid">
	<div class="span5">
<script type="text/javascript">
	$(window).ready(function () {
		setInterval("checkout('<?php echo $sess_id;?>')",3000);
	});
</script>
<p>Scan this QR-code. This will open a web page in your mobile phone which opens a search dialog. Do not close this page. When the image has changed into "Phone connected", search for a movie on your phone. When you find a movie, click on it on your phone and the page will start playing movie within 10 seconds. If you want to watch another video, just search again and select a new and the page will automatically play the new video for you within 10 seconds. 
</div>
<div class="span5">
<img id="status" src="http://qrcode.kaywa.com/img.php?s=8&d=<?php echo urlencode("http://segorify.com/youtube_remote/controller.php?sess_id=".$sess_id); ?>" />
</div>
</div>
<div id="content" style="display: none">
<div id="ytapiplayer">
	You need Flash player 8+ and JavaScript enabled to view this video.
</div>
</div>
<?php include("footer.php"); ?>