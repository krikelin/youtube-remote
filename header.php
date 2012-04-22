<?php 
session_start();
?><!DOCTYPE html>
<html>
	<head>	
		<meta name="viewport" content="width=320,user-scalable=false" />
		
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css" type="text/css" />
		<style>
			footer p{
				font-size:11px;
				font-family: "Tahoma";  
				color: #888888;
			}
			.btn-group {
				width:100%;
			}
			.btn {
				padding:20px;
			}
		</style>
		<script type="text/javascript" src="swfobject.js"></script>    
	  

		<script src="bootstrap/js/jquery-1.7.2.min.js" type="text/javascript"></script>
		 <script type="text/javascript">

		

	  </script>
		<script>
var paused = false;
			function checkout (sess_id) {
				$.getJSON("checkout.php?sess_id=" + sess_id, function(data) {	
					var player = document.getElementById("myytplayer");
					if(data.id != "") {
						console.log(data);	
					}
					if(data.id == ":pause") {
						if(paused) {
							player.playVideo();
						} else {
							player.pauseVideo();
						}
						paused = !paused;
						return;
					}
					if(data.id == ":play") {
						
						player.playVideo();
						return;
					}
					if(data.id == ":stop") {
						player.stopVideo();
						return;
					}
					if(data.id == ":forward") {
						player.seekTo(player.getCurrentTime() + 25, true);
						return;
					}
					if(data.id == ":rewind") {
						player.seekTo(player.getCurrentTime() - 25, true);
					}
					if(data.id == "CONNECTED") {
						console.log("connected");
						$("#status").attr("src", "connected.png");
						return;
					}
					if(data.id != "") {
						paused = false;
						console.log("A");
						$("body").html("");
						$("body").append("<div id=\"ytapiplayer\" style=\"width:100%; height:100%\"></div>");
						var params = { allowScriptAccess: "always" };
						var atts = { id: "myytplayer" };
						swfobject.embedSWF("http://www.youtube.com/v/" + data.id + "?autoplay=1&enablejsapi=1&playerapiid=ytplayer&version=3",
										   "ytapiplayer", "100%", "100%", "8", null, null, params, atts);
							document.getElementsByTagName("object")[0].setAttribute("height", window.innerHeight);
					}
				});
			}
			function forward(id, sess_id) {
				play(":forward", sess_id);
			}
			function rewind(id, sess_id) {
				play(":rewind", sess_id);
			}
			
			var firstTime = true;
			function pap(id, sess_id) {	
				console.log("A");
				if(firstTime) {
					firstTime = false;
					play(id, sess_id);
				} else{
					play(":pause", sess_id);
				}
			}
			function play(id, sess_id) {
				$.getJSON("play.php?sess_id=" + sess_id + "&id=" + id, function(data) {
					console.log(data);
				});
			}
			$(window).resize(function() {
				var object = document.getElementsByTagName("object")[0];
				if(object)
					object.setAttribute("height", window.innerHeight);
			});
		</script>
	
		<title>Retube</title>
	</head>
	<body>
		
		<div class="navbar">
		  <div class="navbar-inner">
			<div class="container">
				<a class="brand" href="#">
					Youtube Remote
				</a>
				<?php if(isset($_GET['sess_id'])) {?>
				<form class="navbar-search pull-left" method="GET" action="controller.php">
					<input style="float: left" type="hidden" name="sess_id" value="<?php echo $_GET['sess_id']?>" />
				  <input type="text" class="search-query" name="q" value="<?php echo isset($_GET['q']) ? $_GET['q'] : ""?>" placeholder="Search">
				</form>
				<?php } ?>
			</div>
			
		  </div>
		</div>
		<div class="container">
		
